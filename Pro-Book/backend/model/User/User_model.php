<?php

class User_model{
    private $name;
    private $username;
    private $email;
    private $hashedPassword;
    private $address;
    private $phone;
    private $imageUrl;
    private $card;

    function __construct($name, $username, $email, $hashedPassword, $address, $phone, $imageUrl, $card) {
        $this->setName($name);
        $this->setUsername($username);
        $this->setEmail($email);
        $this->setHashedPassword($hashedPassword);
        $this->setAddress($address);
        $this->setPhone($phone);
        $this->setImageUrl($imageUrl);
        $this->setCard($card);
    }

    function setName($name) {
        $this->name = $name;
    }

    function getName() {
        return $this->name ;
    }

    function setUsername($username) {
        $this->username = $username;
    }

    function getUserName() {
        return $this->username ;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function getEmail() {
        return $this->email ;
    }

    function setHashedPassword($hashedPassword) {
        $this->hashedPassword = $hashedPassword;
    }

    function getHashedPassword() {
        return $this->hashedPassword ;
    }

    function setAddress($address) {
        $this->address = $address;
    }

    function getAddress() {
        return $this->address ;
    }

    function setPhone($phone) {
        $this->phone = $phone;
    }

    function getPhone() {
        return $this->phone ;
    }

    function setImageUrl($imageUrl) {
        $this->imageUrl = $imageUrl;
    }

    function getImageUrl(){
        return $this->imageUrl;
    }

    function setCard($card) {
        $this->card = $card;
    }

    function getCard(){
        return $this->card;
    }

    function save($conn) {
        $sql = "INSERT INTO user (name, username, email, hashedPassword, address, phone, image_url, card) VALUES ('$this->name','$this->username','$this->email','$this->hashedPassword', '$this->address','$this->phone','$this->imageUrl', '$this->card')";
        if ($conn->query($sql) === TRUE) {
            header('Content-Type: application/json');
            header('Status: Success');
            return json_encode(array(
                'status' => "success",
                ));
        } else {
            header('Content-Type: application/json');
            header('Status: Error');
            return json_encode(array(
                'status' => "error",
                'message' => "sql error"
                ));
        }
    }

    function update($conn) {
        $sql = "UPDATE user SET name='$this->name', address='$this->address', phone='$this->phone', image_url='$this->imageUrl', card = '$this->card' WHERE username='$this->username'";   
        if ($conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    function checkPassword($password) {
        return password_verify($password, $this->hashedPassword );
    }

}

?>