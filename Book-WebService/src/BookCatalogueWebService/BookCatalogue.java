package BookCatalogueWebService;

import javax.jws.WebMethod;
import javax.jws.WebService;

@WebService()
public interface BookCatalogue {

    @WebMethod
    String searchBook(String title) throws Exception;

    @WebMethod
    String searchBookWithCategory(String category) throws Exception;

    @WebMethod
    String getBookDetail(String bookId) throws Exception;

    @WebMethod
    String buyBook(String bookId, String cardId, int bookAmount, String otpToken) throws  Exception;

    @WebMethod
    String getRecommendation(String[] genres) throws Exception;
}
