package WebServiceTemplate;

import javax.jws.WebMethod;
import javax.jws.WebService;

@WebService()
public interface HelloWorld {

    @WebMethod
    String sayHelloWorldFrom(String from);

}
