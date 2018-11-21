<?php
require_once 'backend/model/User/User_service.php';
require_once 'backend/view/User_view.php';
require_once 'backend/model/db/db_connection.php';
require_once 'backend/model/Auth/Auth_service.php';
require_once 'backend/view/Book_view.php';
require_once 'backend/view/Auth_view.php';
class User {
    private $us;
    private $view;
    private $auth_view;
    private $as;
    private $book_view;
    function __construct(){
        $this->us = new User_service;
        $this->view = new User_view;
        $this->auth_view = new Auth_view;
        $this->as = new AuthService;
        $this->book_view = new Book_view;
    }

    function index(){
        $this->view->render_register_page();
    }

    function register(){
        $name = $_POST["name"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];
        $user = $this->us->register($name, $username, $email, 
            $password, $address, $phone);
        $this->createAccessToken($username,$password);
        header("Location: http://localhost/tugasbesar2_2018/Pro-Book/index.php/Book/index");
    }
    function checkAvailability(){
        if(isset($_GET['username'])) {
            $this->us->checkUsernameAvailability($_GET['username']);
        }elseif(isset($_GET['email'])) {
            $this->us->checkEmailAvailability($_GET['email']);
        }
    }
    public function showUserProfile(){
        if(isset($_COOKIE["accessToken"])){
            $user_access_token = $_COOKIE["accessToken"];
            $user = $this->as->checkAccessToken($user_access_token);
            if($user){
                $this->view->render_profile_page($user);
            }else{
                $this->auth_view->render_login_page();
            }
        }else{
            $this->auth_view->render_login_page();

        }
    }

    function createAccessToken($username, $password){
        $authToken = $this->as->createAccessToken($username,$password);
        setcookie("accessToken",$authToken->getToken(),0, "/");
    }
    
    public function showEditProfile() {
        if(isset($_COOKIE["accessToken"])){
            $user_access_token = $_COOKIE["accessToken"];
            $user = $this->as->checkAccessToken($user_access_token);

            if($user){
                $this->view->render_edit_profile_page($user);
            }else{
                $this->auth_view->render_login_page();
            }
        } else {
            $this->auth_view->render_login_page();
        }
    }



    public function editProfile(){
        $user_access_token = $_COOKIE["accessToken"];
        $user = $this->as->checkAccessToken($user_access_token);

        $base =  getcwd();
        $target_dir = $base."/frontend/img_resource/"; 
        if($_FILES["profile-img-hidden-input"]["name"]){
            $target_file = $target_dir . $user->getUsername().strtotime("now").basename($_FILES["profile-img-hidden-input"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $imageUrl = false;

            if (move_uploaded_file($_FILES["profile-img-hidden-input"]["tmp_name"], $target_file)) {
                $imageUrl = "/tugasbesar2_2018/Pro-Book/frontend/img_resource/".$user->getUsername().strtotime("now").basename($_FILES["profile-img-hidden-input"]["name"]);
                $user = $this->us->edit($user, $name, $address, $phone, $imageUrl);
                $this->view->render_profile_page($user);
            }else{
                echo "<script>alert('image not valid');window.location='http://localhost/tugasbesar2_2018/Pro-Book/index.php/User/showEditProfile';</script>";
            }
        }else{
            $this->view->render_profile_page($user);
        }

    }
    public function get_username_from_cookie(){
		$user_access_token = $_COOKIE["accessToken"];
		$user = $this->as->checkAccessToken($user_access_token);
		$username = $user->getUsername();

		return $username;
    }
    
}


?>