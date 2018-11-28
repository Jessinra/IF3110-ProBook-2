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

    public String searchBook(String title) throws Exception{
        String result = googleBookAPI.searchBook(title);
        return resultHandler.parseSearch(result);
    }

    public String searchBookWithCategory(String category) throws Exception{
        String result = googleBookAPI.searchBookWithCategory(category);
        return resultHandler.parseSearch(result);
    }

    public String getBookDetail(String bookId) throws Exception{
        String result = googleBookAPI.getBookDetail(bookId);
        return resultHandler.parseBookDetail(result);
    }

    public boolean buyBook(String bookId, String cardId, int bookAmount) throws Exception {

        System.out.println("bookId : " + bookId);
        System.out.println("cardId : " + cardId);
        System.out.println("bookAmount : " + bookAmount);

        String result = getBookDetail(bookId);
        JSONObject jsonResult = new JSONObject(result);

        String[] genres = jsonResult.getString("Category").replaceAll(" ","").split("/");
        float totalBookPrice = BuyBook.getPrice(bookId) * bookAmount;

        System.out.println("genres : " + Arrays.toString(genres));
        System.out.println("totalBookPrice : " + totalBookPrice);

        boolean response = false;
        try{
            if (totalBookPrice < 0){
                throw new Exception("Cost less than 0");
            }
            String checkoutResponse = BuyBook.checkout(cardId, totalBookPrice);
            JSONObject res = new JSONObject(checkoutResponse);

            // is this the way to hceck for success ?
            if(! res.has("err")) {
                System.out.println("UPDATE");
                response = BuyBook.upsert(bookId, genres, bookAmount);
            }

        } catch (Exception e){
            System.out.println("error in buy book");
            System.out.println(e.getMessage());
        }
        return response;
    }



    public String getRecommendation(String[] genres) throws Exception{
        // random genre
        Random r = new Random();
        int idx = r.nextInt(genres.length);
        String genre = genres[idx];
        
        String result = Recommendation.get(genre);
        String bookDetail = "";
        System.out.println(result);
        if (result.length() == 2) {
										return searchBookWithCategory(genre);
        } else {
            JSONArray jsonArray;
            JSONObject jsonObject;
            String bookID = "";
            try {
                jsonArray = new JSONArray(result);
                jsonObject = jsonArray.getJSONObject(0);
                bookID = jsonObject.getString("book_id");
            } catch (JSONException e) {
                System.out.println(e);
            }

            bookDetail = getBookDetail(bookID);
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
