package BookCatalogueWebService;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

class HttpConnection {

    static HttpURLConnection getHttpConnection(String requestUrl) throws IOException {

        final String USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)" +
                " Chrome/60.0.3112.113 Safari/537.36";

        URL url = new URL(requestUrl);
        HttpURLConnection connection = (HttpURLConnection) url.openConnection();
        connection.setRequestMethod("GET");
        connection.setRequestProperty("User-Agent", USER_AGENT);
        return connection;
    }

    static String parseHttpResponseText(HttpURLConnection connection) throws IOException {

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
