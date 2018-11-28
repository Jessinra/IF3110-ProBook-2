<?php
    require_once 'backend/model/db/db_connection.php';
    class OrderService {
        public function history($user_id) {
            $conn = OpenCon();
            $sql = "SELECT * FROM book_order WHERE user_id = $user_id";
            $result = mysqli_fetch_all($conn->query($sql), MYSQLI_ASSOC);
            CloseCon($conn);
            return $result;
        }

        public function orderBook($username, $book_id, $amount) {
            $conn = OpenCon();
            $username = strval($username);
            $sql = "INSERT INTO book_order(username, book_id, amount) VALUES ('$username', $book_id, $amount);";
            $conn->query($sql);
            $order_id = $conn->insert_id;
            CloseCon($conn);
            return $order_id;
        }




    }
?> 