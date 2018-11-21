<?php
require_once 'backend/model/Auth/Auth_service.php';
require_once 'backend/model/db/db_connection.php';
require_once 'backend/model/User/User_model.php';
require_once 'backend/view/Auth_view.php';
require_once 'backend/view/Book_view.php';
class Auth{
    private $as;
    private $view;
    private $book_view;
    function __construct(){
        $this->as = new AuthService;
        $this->view = new Auth_view;
        $this->book_view = new Book_view;
    }
    function index(){
        $this->view->render_login_page();
    }
    function checkAccessToken(){
        if (isset($_COOKIE['accessToken'])){
            $user = $this->as->checkAccessToken($_COOKIE['accessToken']);
            if($user) {
                return true;
            }else{
                return false;
            }
        } else{
            return false;
        }
    }

    function login(){
        $username = $_POST["username"];
        $password = $_POST["password"];
        if($this->createAccessToken($username,$password)){
            header("Location: http://localhost/tugasbesar1_2018/index.php/Book/index");
        }else{
            echo "<script>
                alert('Wrong username or password');
                </script>";
            $this->view->render_login_page();
            
        }
    }

    function logout(){
        if(isset($_COOKIE["accessToken"])){
            $user_access_token = $_COOKIE["accessToken"];
            $user = $this->as->checkAccessToken($user_access_token);
            if($user){
                $this->as->deleteAccessToken($user->getUsername());
                setcookie('accessToken',null);
            }
        }
        unset($_COOKIE['accessToken']);
        setcookie('accessToken',null,-1,'/');
        $this->view->render_login_page();
    }

    function createAccessToken($username, $password){
        $authToken = $this->as->createAccessToken($username,$password);
        if($authToken){
            setcookie("accessToken",$authToken->getToken(),time()+86400, "/");
            return true;
        }else{
            return false;
        }
    }

}


?>