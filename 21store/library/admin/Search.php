<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'services' . DS . 'ProductService.php';

    $productName=$_GET['productName'];
    $services = new ProductService();
    $filters = new stdClass();
    $filters->searchQuery = $productName;
    $products = $services->getPaginatedProducts(1, 1000, $filters);
    foreach($products as $product){
        echo '<div class="product">';
        echo ' <div>';
        echo '<img src="' . $product->getImageUrl() . '" alt="" width="100%">';
        echo '<p>' . $product->getProductName() . '</p>';
        echo '<p>' . $product->getPrice() . 'Đ</p>';
        echo '</div>';
        echo '<div>';
        echo '<button class="button" onclick="sc_ct(this.value)" value="'. $product->getId() . '">Chi tiết</button>';
        echo '<button class="button" onclick="delete_by_id(this)" value="'. $product->getId() .'">Xoá</button>';
        echo '</div>';
        echo '</div>';        
    }


?>
