package BookCatalogueWebService;

import java.sql.DriverManager;
import java.sql.ResultSet;
import java.io.BufferedReader;
import java.io.DataOutputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class BuyBook {
	public static boolean upsert(String id, String[] genres, int sum){
		try{
			Class.forName(Connection.driver);
			java.sql.Connection con = DriverManager.getConnection(Connection.database, Connection.user, Connection.password);
			java.sql.Statement st = con.createStatement();
			ResultSet res = st.executeQuery("SELECT * FROM sold WHERE id = '"+id+"'");
			if(res.next()) {
				int total = res.getInt(2) + sum;
				int sql = st.executeUpdate("UPDATE sold SET Total = '"+total+"' WHERE id='"+id+"'");
			}else{
				int sql = st.executeUpdate("INSERT INTO sold(id, total)" +
						"Values('"+id+"','"+sum+"') ");
				int err;
				for (String genre:genres) {
					try{
						genre = genre.replaceAll(" ","");
						err = st.executeUpdate("INSERT INTO genre(genre) VALUES ('"+genre+"')");
						res = st.executeQuery("SELECT id FROM genre WHERE genre = '"+genre+"'");
						res.next();
						err = st.executeUpdate("INSERT INTO genreSold (id, genre_idx) VALUES ('"+id+"', '"+res.getInt(1)+"')");
					} catch (Exception e){
						res = st.executeQuery("SELECT id FROM genre WHERE genre = '"+genre+"'");
						res.next();
						err = st.executeUpdate("INSERT INTO genreSold (id, genre_idx) VALUES ('"+id+"', '"+res.getInt(1)+"')");
					}

				}
			}
			return true;
		} catch (Exception e){
			System.out.println(e.getMessage());
			return false;
		}
	}

	public static  float getCost(String id){
		try{

			Class.forName(Connection.driver);
			java.sql.Connection con = DriverManager.getConnection(Connection.database, Connection.user, Connection.password);
			java.sql.Statement st = con.createStatement();
			ResultSet res = st.executeQuery("SELECT price FROM bookprices	 WHERE id = '"+id+"'");
			if(res.next()) {
				float total = Float.parseFloat(res.getString(1).split(" ")[0].replaceAll(",",".").replaceAll(".00",""));
				return total;
			}
		} catch(Exception e){
				System.out.println(e);
		}
		return -1;
	}

	public static String sendPost(String senderCardId, float sum) throws Exception {
		String storeCardId = "123123123123";
		String url = "http://localhost:3000/transfer";
		final String USER_AGENT = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko)" +
				" Chrome/60.0.3112.113 Safari/537.36";
		URL obj = new URL(url);
		HttpURLConnection con = (HttpURLConnection) obj.openConnection();

		//add reuqest header
		con.setRequestMethod("POST");
		con.setRequestProperty("User-Agent", USER_AGENT);
		con.setRequestProperty("Accept-Language", "en-US,en;q=0.5");

		String urlParameters = "nomor_pengirim="+ senderCardId + "&jumlah= "+ sum +"&nomor_penerima="+ storeCardId +" ";

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
		StringBuffer response = new StringBuffer();

		while ((inputLine = in.readLine()) != null) {
			response.append(inputLine);
		}
		in.close();

		//print result
		System.out.println(response.toString());
		return response.toString();


	}
}
