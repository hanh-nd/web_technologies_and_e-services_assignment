<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'services' . DS . 'ProductService.php';

    $productName=$_GET['productName'];
    $services = new ProductService();
    $filters = new stdClass();
    $filters->searchQuery = $productName;
    $filters->brandFilters = array();
    $products = $services->getPaginatedProducts(1, 1000, $filters);
    foreach($products as $product){
        $productId = $product->getId();
        echo '<div class="product">';
        echo "<div onclick='sc_ct($productId)'>";
        echo '<img src="' . $product->getImageUrl() . '" alt="" width="100%">';
        echo '<p>' . $product->getProductName() . '</p>';
        echo '<p>' . $product->getPrice() . 'Đ</p>';
        echo '</div>';
        echo '<div>';
        echo '<button class="button" onclick="sc_ct(this.value)" value="'. $productId . '">Chi tiết</button>';
        echo '<button class="button" onclick="delete_by_id(this)" value="'. $productId .'">Xoá</button>';
        echo '</div>';
        echo '</div>';        
    }


?>
