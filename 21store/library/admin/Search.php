<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'services' . DS .'ProductService.php';

    $productName=$_GET['productName'];

    
    $services = new ProductService();
    $products= $services->getAllProducts();
    foreach($products as $product){
        if(($product->getProductName()== $productName || $productName=="")){
            echo '<div class="product">';
            echo ' <div>';
            echo '<img src="' . $product->getImageUrl() . '" alt="" width="200px;" height="200px">';
            echo '<p style="margin-left: 5px;">' . $product->getProductName() . '</p>';
            echo '<p style="margin-top: 0px; margin-right: 0px;">' . $product->getPrice() . 'Đ</p>';
            echo '</div>';
            echo '<div>';
            echo '<button class="btn-ql-xx" onclick="sc_ct(this.value)" value="'. $product->getId() . '">Detail</button>';
            echo '<button class="btn-ql-xx" onclick="delete_by_id(this)" value="'. $product->getId() .'">Delete</button>';
            echo '</div>';
            echo '</div>';
        }
    }


?>
