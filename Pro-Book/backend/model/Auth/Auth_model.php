<?php


class Auth_model{
    private $username;
    private $token; 
    private $expiredAt;


    function __construct($username) {
        $this->setUsername($username);
        $this->generateAccessToken();
        $this->refreshToken();

    }

    function getUsername(){
        return $this->username;
    }

    function getToken(){
        return $this->token;
    }

    function setUsername($username) {
        $this->username = $username;
    }
    function refreshToken() {
        $timestamp = strtotime("+120 minute");
        $this->expiredAt = date("Y-m-d H:i:s",$timestamp);
    }
    function generateAccessToken() {
        $this->token=password_hash($this->username, PASSWORD_DEFAULT);
    }
    
    function save($conn) { 
        $sql = "INSERT INTO auth (username,token,expiredAt) VALUES ('$this->username','$this->token','$this->expiredAt')";
        if ($conn->query($sql)) {
            return true;
        } else {
            $sql = "UPDATE auth SET token = '$this->token', expiredAt = '$this->expiredAt' WHERE username = '$this->username'";
            if ($conn->query($sql) === TRUE) {
                return true;
            }else{
                return false;
            }
        }
    }

}


?>