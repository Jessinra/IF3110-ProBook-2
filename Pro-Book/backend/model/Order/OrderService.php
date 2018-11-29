<?php
    require_once 'backend/model/db/db_connection.php';

    class OrderService
    {

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

<<<<<<< HEAD
        public function orderBook($username, $cardId, $bookId, $bookAmount) {
            $params = array("arg0" => $bookId, "arg1" => $cardId, "arg2" => $bookAmount);
            $isPurchaseSuccess = $this->client->buyBook($params)->return;
=======
        public function orderBook($username, $cardId, $bookId, $bookAmount, $otpToken) {

            $params = array("arg0" => $bookId, "arg1" => $cardId, "arg2" => $bookAmount, "arg3" => $otpToken);
            $isPurchaseSuccess = $this->client->buyBook($params);
            $isPurchaseSuccess = $isPurchaseSuccess == "true";

>>>>>>> f3e00ddc3711122d35633cbd9f0c6b7320823ff1
            if ($isPurchaseSuccess) {
                $conn = OpenCon();
                $username = strval($username);

                $stmt = $conn->prepare("INSERT INTO book_order (username, book_id, amount) VALUES (?, ?, ?)");
                $stmt->bind_param("ssi", $username, $bookId, $bookAmount);
                try{
                    $stmt->execute();
                }catch(Exception $e){
                    var_dump($e);
                    return false;
                }
                $order_id = $stmt->insert_id;
                $stmt->close();
                $conn->close();
                return $order_id;
            }

            // TODO: what happen if it failed ?
            return $isPurchaseSuccess;
        }
    }

?>