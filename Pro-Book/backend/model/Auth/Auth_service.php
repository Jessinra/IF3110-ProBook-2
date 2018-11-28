<?php
require_once 'backend/model/Auth/Auth_model.php';
require_once 'backend/model/User/User_model.php';


class AuthService {
    public function createAccessToken($username, $password, $browser, $ip) {
        $conn = OpenCon();
        $sql = "SELECT * FROM user WHERE username = '$username'";
        $result = $conn->query($sql);
        if($result->num_rows === 1) {
            $val = mysqli_fetch_assoc($result);
            $user = new User_model($val['name'], $val['username'], $val['email'], $val['hashedPassword'], $val['address'], $val['phone'],$val['image_url'], $val['card']);
            if($user->checkPassword($password)) {
                $accessToken = new Auth_model($username,$browser,$ip);
                $accessToken->save($conn);
                CloseCon($conn);
                return $accessToken;
            } else{
                CloseCon($conn);
                return false;
            }
        } else {
            CloseCon($conn);
            return false;
        }
    }

    public function checkAccessToken($token,$browser,$ip) {
        $conn = OpenCon();
        $currentTimestamp = date("Y-m-d H:i:s",strtotime("now"));
        $sql = "SELECT * FROM auth NATURAL JOIN user WHERE token = '$token' AND browser = '$browser' AND ip = '$ip' AND expiredAt > '$currentTimestamp'";
        $result = $conn->query($sql);
        if($result->num_rows === 1){
            $val = mysqli_fetch_assoc($result);
            CloseCon($conn);
            return new User_model($val['name'], $val['username'], $val['email'], $val['hashedPassword'], $val['address'], $val['phone'],$val['image_url'], $val['card']);
        }
        CloseCon($conn);
        return false;
    }

    public function deleteAccessToken($username) {
        $conn = OpenCon();
        $sql = "DELETE FROM auth WHERE username='$username'";
        $conn->query($sql);
        CloseCOn($conn);
    }


}


?>