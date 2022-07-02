<?php

class User {
    private $id;                    // int
    private $username;             // string
    private $password;              // string
    private $phoneNumber;              // string
    private $createdAt;             // string
    private $address;               //string
    private $role;               // string
    private $fullname;               // string

    public function __construct($user) {
        $this->createdAt = $user->createdAt;
        $this->username = $user->username;
        $this->password = $user->password;
        $this->phoneNumber = $user->phoneNumber;
        $this->id = $user->id;
        $this->address = $user->address;
        $this->role = $user->role;
        $this->fullname = $user->fullname;
    }

    public function getId() {
        return $this->id;
    }
    public function getFullname() {
        return $this->fullname;
    }

    public function getUserName() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function getCreatedAt() {
        return $this->createdAt;
    }
    public function getAddress() {
        return $this->address;
    }
    public function getRole() {
        return $this->role;
    }
}
?>