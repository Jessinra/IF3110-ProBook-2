package BookCatalogueWebService;
import java.net.HttpURLConnection;


class GoogleBookAPI {

    private final String GOOGLE_API_KEY = "AIzaSyArcL_wLDUdT3I8ryhyYvWRGc-yo5WlwAk";

    String searchBook(String title) throws Exception {

        String url = getSearchUrl(title);
        HttpURLConnection connection = HttpConnection.getHttpConnection(url);
        return HttpConnection.parseHttpResponseText(connection);
    }

    String searchBookWithCategory(String category) throws Exception{

        String url = getSearchUrlWithCategory(category);
        HttpURLConnection connection = HttpConnection.getHttpConnection(url);
        return HttpConnection.parseHttpResponseText(connection);
    }

    String getBookDetail(String bookId) throws Exception {

        String url = getBookDetailsUrl(bookId);
        HttpURLConnection connection = HttpConnection.getHttpConnection(url);
        return HttpConnection.parseHttpResponseText(connection);
    }


    private String getSearchUrl(String title) {

        // Pre process title
        title = title.replaceAll("\\s", "+");

        String url = "https://www.googleapis.com/books/v1/volumes";
        String getParameter = "key=" + GOOGLE_API_KEY + "&q=" + title + "&maxResults=40" +"&printType=books";
        return url + "?" + getParameter;
    }

    private String getSearchUrlWithCategory(String category) {

        // Pre process title
        category = category.replaceAll("\\s", "+");

        String url = "https://www.googleapis.com/books/v1/volumes";
        String getParameter = "key=" + GOOGLE_API_KEY + "&q=subject:" + category + "&maxResults=40";
        return url + "?" + getParameter;
    }

    private String getBookDetailsUrl(String bookId) {

        String url = "https://www.googleapis.com/books/v1/volumes/" + bookId;
        String getParameter = "key=" + GOOGLE_API_KEY ;
        return url + "?" + getParameter;
    }


}