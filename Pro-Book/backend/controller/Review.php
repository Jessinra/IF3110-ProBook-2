<?php

class Review {
	private $model;
	private $view;
	private $auth;
	private $order_record;

	public function __construct(){
		require_once("backend/model/Review_model.php");
		require_once("backend/model/Auth/Auth_service.php");
		require_once("backend/model/db/db_connection.php");
		require_once("backend/view/Review_view.php");

		$this->model = new Review_model();
		$this->auth = new AuthService();
		$this->view = new Review_view();		
	}

	public function show_review_page(){
		$username = $GLOBALS['user']->getUserName();

		if(!$username){
			header("Location: http://localhost/tugasbesar2_2018/Pro-Book/index.php/Auth/index");
			exit();
		}

		$order_id = $_GET['order_id'];
		$book_id = $_GET['book_id'];
		$book = $this->model->get_book_details($book_id);
		$order_details = $this->model->get_order_details($order_id);

		if($order_details['username'] == $username) {
			if($order_details['is_commented']){
				exit("unauthorized request");
			} else {
				$this->view->render_review_page($book, $order_id);
			}
		}
		exit("unauthorized request");
	}

	private function get_username_from_cookie(){
		$user_access_token = $_COOKIE["accessToken"];
		$user = $this->auth->checkAccessToken($user_access_token);
		$username = $user->getUsername();

		return $username;
	}

	public function insert_review(){
		if(!isset($GLOBALS['user'])){
			header("Location: http://localhost/tugasbesar2_2018/Pro-Book/index.php/Auth/index");
			exit();
		}

		$parameter = $_POST;
		$parameter['username'] = $this->get_username_from_cookie();
		
		foreach($parameter as $key => $val){
			$parameter[$key] = escape($val);
		}

		var_dump($parameter);

		$status = $this->model->insert_review($parameter);

		var_dump($status);
	}
}

?>