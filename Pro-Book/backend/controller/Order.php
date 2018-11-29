<?php

    class Order
    {
        private $orderService;

        function __construct() {
            require_once('backend/model/Order/OrderModel.php');
            require_once('backend/model/Order/OrderService.php');

            $this->orderService = new OrderService();
        }

        function orderHistory() {
            $user_id = $_GET["user_id"];
            $result = $this->orderService->history($user_id);
            return $result;
        }

        function orderBook() {
            $username = $GLOBALS['user']->getUserName();
            if (!$username) {
                echo "false";
                exit();
            } else {
                $bookId = $_POST["book_id"];
                $cardNum = $GLOBALS['user']->getCard();
                $bookAmount = $_POST["amount"];
                $otpToken = $_POST["otp"];

                $order_id = $this->orderService->orderBook($username, $cardNum, $bookId, $bookAmount, $otpToken);
                if(!$order_id){
                    echo "failed";
                }else{
                    echo $order_id;
                }
            }
        }
    }

?>