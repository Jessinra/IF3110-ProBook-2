<?php
    require_once 'backend/model/db/db_connection.php';
    class OrderService {

        private $client;

        public function __construct() {
            $this->client = connectToBookWebService();
        }

        public function history($user_id) {
            $conn = OpenCon();
            $sql = "SELECT * FROM book_order WHERE user_id = $user_id";
            $result = mysqli_fetch_all($conn->query($sql), MYSQLI_ASSOC);
            CloseCon($conn);
            return $result;
        }

        public function orderBook($username, $book_id, $amount) {
            $params = array("arg0" => $username, "arg1" => $book_id, "arg2" => $amount);
            return $this->client->buyBook($params);
        }
    }
?> 