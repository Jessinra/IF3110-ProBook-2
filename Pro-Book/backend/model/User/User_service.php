<?php
require_once 'backend/model/User/User_model.php';

class User_service {
    public function register($name, $username, $email, $password, $address, $phone, $card) {
        $url = 'http://localhost:3000/validateCard/'.$card;
        $contents = file_get_contents($url);
        if($contents == "\"True\"") {
            $conn = OpenCon();
            $sql = "SELECT name FROM user WHERE username = '$username' or email = '$email'";
            $result = $conn->query($sql);
            $defaultProfilePath = "/tugasbesar2_2018/Pro-Book/frontend/img_resource/default-profile.jpg";
            if($result->num_rows === 0) {
                $hashedPassword =  $this->hashPassword($password);
                $user = new User_model($name, $username, $email, $hashedPassword, $address, $phone, $defaultProfilePath, $card);
                $user->save($conn, $user);
                return $user;
            } else {
                return NULL;
            }
            CloseCon($conn);
        }else{
            echo "<script>
                alert('Invalid number');
                </script>";
        }
    }

    public function edit($user, $name, $address, $phone, $imageUrl, $card) {
        $conn = OpenCon();
        $user->setName($name);
        $user->setAddress($address);
        $user->setPhone($phone);
        $url = 'http://localhost:3000/validateCard/'.$card;
        $contents = file_get_contents($url);
        if($contents == "\"True\"") {
            $user->setCard($card);
        }else {
            echo "<script>
                alert('Invalid number');
                </script>";
            return false;
        }
        if($imageUrl){

            $user->setImageUrl($imageUrl);
        }
        $user->update($conn);
        if(!$user){
            echo "<script>
                alert('ERROR');
                </script>";
            return false;
        }
        CloseCon($conn);
        return $user;
    }

    public function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function checkUsernameAvailability($username) {
        $conn = OpenCon();
        $sql = "SELECT name FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows === 0) {
            echo "true";
        } else {
            echo "false";
        }
    }

    public function checkEmailAvailability($email) {
        $conn = OpenCon();
        $sql = "SELECT name FROM user WHERE email = '$email'";
        $result = $conn->query($sql);
        if($result->num_rows === 0) {
            echo "true";
        } else {
            echo "false";
        }
    }
    public function getUserProfile($username) {
        $conn = OpenCon();
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows === 1) {
            $val = mysqli_fetch_assoc($result);
            CloseCon($conn);
            return new User_model($val['name'], $val['username'], $val['email'], $val['hashedPassword'], $val['address'], $val['phone'], $val['image_url']);
        } else {
            CloseCon($conn);
            return NULL;
        }
    }
}
?>
