package BookCatalogueWebService;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import javax.jws.WebService;
import javax.jws.soap.SOAPBinding;
import javax.xml.ws.Endpoint;
import java.util.Arrays;
import java.util.Random;

@WebService()
@SOAPBinding()
public class BookCatalogueImpl implements BookCatalogue {

    private GoogleBookAPI googleBookAPI = new GoogleBookAPI();
    private GoogleBookResultHandler resultHandler = new GoogleBookResultHandler();

    public String searchBook(String title) throws Exception {

        System.out.println(">>> Begin searchBook");

        String result = googleBookAPI.searchBook(title);
        return resultHandler.parseSearch(result);
    }

    public String searchBookWithCategory(String category) throws Exception {

        System.out.println(">>> Begin searchBookWithCategory");

        String result = googleBookAPI.searchBookWithCategory(category);
        return resultHandler.parseSearch(result);
    }

    public String getBookDetail(String bookId) throws Exception {

        System.out.println(">>> Begin getBookDetail");

        String result = googleBookAPI.getBookDetail(bookId);
        return resultHandler.parseBookDetail(result);
    }

    public String buyBook(String bookId, String cardId, int bookAmount, String otpToken) throws Exception {

        System.out.println(">>> Begin buyBook");
        System.out.println("bookId : " + bookId);
        System.out.println("cardId : " + cardId);
        System.out.println("bookAmount : " + bookAmount);
        System.out.println("otpToken : " + otpToken);

        boolean otpAuthorized = BuyBook.validateOtp(cardId, otpToken);
        if (!otpAuthorized){
            System.out.println(">>> exit with un authorized otp");
            return "false";
        }

        String result = getBookDetail(bookId);
        JSONObject jsonResult = new JSONObject(result);

        String[] genres = jsonResult.getString("Category").split("/");
        for (int i = 0; i < genres.length; i++) {
            genres[i] = genres[i].trim();
        }
        float totalBookPrice = BuyBook.getPrice(bookId) * bookAmount;

        System.out.println("genres : " + Arrays.toString(genres));
        System.out.println("totalBookPrice : " + totalBookPrice);

        try {
            if (totalBookPrice < 0) {
                throw new Exception("Cost less than 0");
            }
            String checkoutResponse = BuyBook.checkout(cardId, totalBookPrice);
            JSONObject res = new JSONObject(checkoutResponse);

            if (!res.has("err")) {
                System.out.println("UPDATE");
                Boolean upsertSuccess = BuyBook.upsert(bookId, genres, bookAmount);
                if (upsertSuccess){
                    return "true";
                }
            }
        } catch (Exception e) {
            System.out.println("error in buy book");
            System.out.println(e.getMessage());
        }
        return "false";
    }


    public String getRecommendation(String[] genres) throws Exception {

        System.out.println(">>> Begin getRecommendation");

        // random genre
        Random randGenerator = new Random();
        int randomIdx = randGenerator.nextInt(genres.length);
        String chosenGenre = genres[randomIdx];
        String result = Recommendation.get(chosenGenre);

        String bookDetail = "";
        JSONArray jsonArray;
        JSONObject jsonObject;

        if (result.length() == 2) {
            jsonObject = new JSONObject(searchBookWithCategory(chosenGenre));
            jsonArray = jsonObject.getJSONArray("Result");
            randomIdx = randGenerator.nextInt(jsonArray.length());
            bookDetail = jsonArray.getJSONObject(randomIdx).toString();
        } else {
            try {
                jsonArray = new JSONArray(result);
                jsonObject = jsonArray.getJSONObject(0);
                String bookID = jsonObject.getString("book_id");
                bookDetail = getBookDetail(bookID);
            } catch (JSONException e) {
                System.out.println(e.getMessage());
            }
        }
        return bookDetail;
    }

    // Publisher part
    public static void main(String[] argv) {
        Object implementor = new BookCatalogueImpl();
        String address = "http://localhost:9000/BookCatalogueWebService";
        Endpoint.publish(address, implementor);

        System.out.println("Service is up !");
    }
}
