<?php
    require_once 'backend/model/db/db_connection.php';
    class BookService {
        public function searchBook($keyword) {
            $conn = OpenCon();
            $sql = "SELECT book.book_id, book.title, book.author, book.description, book.cover, COUNT(book_review.order_id) AS voters, AVG(book_review.rating) AS rating FROM book LEFT OUTER JOIN book_review ON book.book_id = book_review.book_id WHERE book.title LIKE '%$keyword%' GROUP BY book_id;";
            $result = mysqli_fetch_all($conn->query($sql), MYSQLI_ASSOC);
            CloseCon($conn);
            return $result;
        }

        public function getBookDetail($book_id) {
            $conn = OpenCon();
            $sql = "SELECT book.book_id, book.title, book.author, book.description, book.cover, COUNT(book_review.order_id) AS voters, AVG(book_review.rating) AS rating FROM book LEFT OUTER JOIN book_review ON book.book_id = book_review.book_id WHERE book.book_id = $book_id GROUP BY book_id";
            $result = mysqli_fetch_array($conn->query($sql));
            CloseCon($conn);
            return $result;
        }

        public function getBookReviews($book_id) {
            $conn = OpenCon();
            $sql = "SELECT user.username, user.image_url, book_review.rating, book_review.comment 
                    FROM book INNER JOIN book_review ON book.book_id = book_review.book_id INNER JOIN user ON book_review.username = user.username 
                    WHERE book.book_id = $book_id ORDER BY order_id DESC";
            $result = mysqli_fetch_all($conn->query($sql), MYSQLI_ASSOC);
            CloseCon($conn);
            return $result;
        }
    }
?>