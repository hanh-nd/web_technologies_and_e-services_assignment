<?php

class Cart {
    private $username;          // String
    private $listProducts;      // array
    private $date;              // date
    private $quantity;          // int
    
    public function __construct($username, $listProducts, $quantity) {
        $this->username = $username;
        $this->listProducts = $listProducts;
        $this->date = date("Y-m-d");
        $this->quantity = $quantity;
    }
    
    
    public function getUsername(){
        return $this->username;
    }


    public function getListProduct(){
        return $this->listProduct;
    }


    public function getDate(){
        return $this->date;
    }

    public function getQuantity(){
        return $this->quantity;
    }
    
}