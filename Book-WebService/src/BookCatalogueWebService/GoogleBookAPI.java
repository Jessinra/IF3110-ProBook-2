package BookCatalogueWebService;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;


class GoogleBookAPI {

    private final String GOOGLE_API_KEY = "AIzaSyArcL_wLDUdT3I8ryhyYvWRGc-yo5WlwAk";

    String searchBook(String title) throws Exception {

        String url = getSearchUrl(title);
        HttpURLConnection connection = getHttpConnection(url);
        return parseHttpResponseText(connection);
    }

    String searchBookWithCategory(String category) throws Exception{

        String url = getSearchUrlWithCategory(category);
        System.out.println(url);
        HttpURLConnection connection = getHttpConnection(url);
        return parseHttpResponseText(connection);
    }

    String getBookDetail(String bookId) throws Exception {

        String url = getBookDetailsUrl(bookId);
        HttpURLConnection connection = getHttpConnection(url);
        return parseHttpResponseText(connection);
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

    private HttpURLConnection getHttpConnection(String requestUrl) throws IOException {

        final String USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)" +
                " Chrome/60.0.3112.113 Safari/537.36";

        URL url = new URL(requestUrl);
        HttpURLConnection connection = (HttpURLConnection) url.openConnection();
        connection.setRequestMethod("GET");
        connection.setRequestProperty("User-Agent", USER_AGENT);
        return connection;
    }

    private String parseHttpResponseText(HttpURLConnection connection) throws IOException {

        InputStreamReader reader = new InputStreamReader(connection.getInputStream());
        BufferedReader in = new BufferedReader(reader);

        String inputLine;
        StringBuilder response = new StringBuilder();

        while ((inputLine = in.readLine()) != null) {
            response.append(inputLine);
        }
        in.close();
        return response.toString();
    }
}