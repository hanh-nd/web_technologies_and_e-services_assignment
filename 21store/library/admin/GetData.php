<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Brand.php';
    require_once ROOT . DS . 'services' . DS .'ProductService.php';
    require_once ROOT . DS . 'services' . DS .'BrandService.php';


    $id=$_GET['id'];

    //product_name, product_description, price, image_url, size, color, material, brand_id, product_type, quantity
    $service=new ProductService();
    $product = $service->getProduct($id);

    echo $product->getId() . "&"
    . $product->getProductName() . '&'
    . $product->getImageUrl() . '&'
    .  $product->getPrice() . '&'
    . $product->getSize() . '&'
    . $product->getColor() . '&'
    . $product->getQuantity() . '&'
    . $product->getProductType() . '&'
    .  $product-> getBrandId() . '&'
    .  $product->getMaterial() . '&'
    .  $product->getProductDescription() . '&' 
    . " "  . '&'
    . ' '  . '&'
    . ' '  . '&'
    . ' ' . '&'
    . ' ';

        
    
?>
