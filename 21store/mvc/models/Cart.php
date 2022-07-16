<?php

class Cart {
    private $id;                    // int
    private $userId;               // int
    private $totalAmount;          // int
    private $createdAt;            // datetime
    
    public function __construct($cart) {
        $this->id = $cart->id;
        $this->userId = $cart->userId;
        $this->totalAmount = $cart->totalAmount;
        $this->createdAt = $cart->createdAt;

    }

    public function getId(){
        return $this->id;
    }
    
    
    public function getUserId(){
        return $this->userId;
    }


    public function getTotalAmount(){
        return $this->totalAmount;
    }


    public function getCreatedAt(){
        return $this->createdAt;
    }
    
}