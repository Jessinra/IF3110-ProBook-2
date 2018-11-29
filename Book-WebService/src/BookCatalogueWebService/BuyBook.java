package BookCatalogueWebService;

import java.io.IOException;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class BuyBook {
    static boolean upsert(String bookId, String[] genres, int bookAmount) {
        try {
            Class.forName(Connection.driver);
            java.sql.Connection con = DriverManager.getConnection(Connection.database, Connection.user, Connection.password);
            java.sql.Statement st = con.createStatement();
            ResultSet res = st.executeQuery("SELECT * FROM sold WHERE id = '" + bookId + "'");
            if (res.next()) {
                int total = res.getInt(2) + bookAmount;
                int sql = st.executeUpdate("UPDATE sold SET Total = '" + total + "' WHERE id='" + bookId + "'");
            } else {
                int sql = st.executeUpdate("INSERT INTO sold(id, total)" +
                        "Values('" + bookId + "','" + bookAmount + "') ");
                int err;
                for (String genre : genres) {
                    try {
                        genre = genre.replaceAll(" ", "");
                        err = st.executeUpdate("INSERT INTO genre(genre) VALUES ('" + genre + "')");
                        res = st.executeQuery("SELECT id FROM genre WHERE genre = '" + genre + "'");
                        res.next();
                        err = st.executeUpdate("INSERT INTO genreSold (id, genre_idx) VALUES ('" + bookId + "', '" + res.getInt(1) + "')");
                    } catch (Exception e) {
                        res = st.executeQuery("SELECT id FROM genre WHERE genre = '" + genre + "'");
                        res.next();
                        err = st.executeUpdate("INSERT INTO genreSold (id, genre_idx) VALUES ('" + bookId + "', '" + res.getInt(1) + "')");
                    }

                }
            }
            return true;
        } catch (Exception e) {
            System.out.println(e.getMessage());
            return false;
        }
    }

    static float getPrice(String id) {

        java.sql.Connection con = null;
        java.sql.Statement st = null;
        ResultSet res = null;

        try {

            Class.forName(Connection.driver);
            con = DriverManager.getConnection(Connection.database, Connection.user, Connection.password);
            st = con.createStatement();
            res = st.executeQuery("SELECT price FROM bookprices	 WHERE id = '" + id + "'");
            if (res.next()) {

                String price = res.getString(1).toLowerCase();

                switch (price) {
                    case "free": {
                        return 0;
                    }
                    case "not available": {
                        return -1;
                    }
                    default: {
                        price = price.split(" ")[0].replaceAll(",", ".");
                        price = price.replaceAll(".00", "");
                        return Float.parseFloat(price);
                    }
                }
            }
        } catch (Exception e) {
            System.out.println("Exception in getPrice");
        }

        return -1;
    }

    static boolean validateOtp(String senderCardId, String otpToken) throws Exception {
        String url = "http://localhost:3000/verifyOtp/" + senderCardId + "/" + otpToken;
        try{
            HttpURLConnection connection = HttpConnection.getHttpConnection(url);
            String otpAuthorized = HttpConnection.parseHttpResponseText(connection);
            return otpAuthorized.equals("true");
        }
        catch(Exception e) {
            return false;
        }
    }

    static String checkout(String senderCardId, float transferAmount) throws Exception {
        String storeCardId = "123123123123";
        String url = "http://localhost:3000/transfer";

        final String USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)" +
                " Chrome/60.0.3112.113 Safari/537.36";

        URL obj = new URL(url);
        HttpURLConnection con = (HttpURLConnection) obj.openConnection();

        //add reqest header
        con.setRequestMethod("POST");
        con.setRequestProperty("User-Agent", USER_AGENT);
        con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");

        String urlParameters = "nomor_pengirim=" + senderCardId + "&jumlah=" + transferAmount + "&nomor_penerima=" + storeCardId + " ";

        // Send post request
        con.setDoOutput(true);
        DataOutputStream wr = new DataOutputStream(con.getOutputStream());
        wr.writeBytes(urlParameters);
        wr.flush();
        wr.close();

        int responseCode = con.getResponseCode();
        System.out.println("\nSending 'POST' request to URL : " + url);
        System.out.println("Post parameters : " + urlParameters);
        System.out.println("Response Code : " + responseCode);

        BufferedReader in = new BufferedReader(
                new InputStreamReader(con.getInputStream()));
        String inputLine;
        StringBuilder response = new StringBuilder();

        while ((inputLine = in.readLine()) != null) {
            response.append(inputLine);
        }
        in.close();

        //print result
        System.out.println(response.toString());
        return response.toString();
    }
}
