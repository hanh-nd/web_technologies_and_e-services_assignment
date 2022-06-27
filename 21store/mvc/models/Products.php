<?php

class Products {
    private $product_name;

    public function __construct($product_name) {
        $this->product_name = $product_name;
    }

    public function getProductName() {
        return $this->product_name;
    }
}
?>