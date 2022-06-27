<?php

require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Products.php';

class ProductService extends DatabaseConnect { 
    public function __construct() {
        parent::__construct();
        $this->table = 'products';
    }

    public function insert($product) {
        $query = "INSERT INTO products(product_name) VALUES (" . $product->getProductName() . ")";
        parent::setQuery($query);
        parent::executeQuery();
    }
}
?>