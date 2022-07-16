<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Brand.php';
    require_once ROOT . DS . 'services' . DS .'ProductService.php';
    require_once ROOT . DS . 'services' . DS .'BrandService.php';


    $type=$_GET['type'];
    $id=$_GET['id'];

    if($type=='1'){
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
        .  $product-> getBrandName() . '&'
        .  $product->getMaterial() . '&'
        .  $product->getProductDescription() . '&' 
        . " "  . '&'
        . ' '  . '&'
        . ' '  . '&'
        . ' ' . '&'
        . ' ';

        
    }else if($type=='2'){
        $service=new BrandService();
        $brand = $service->getBrand($id);
        echo $brand->getId() . "&"
        . $brand->getBrandName() . '&'
        . $brand->getImageUrl() . '&'
        . ' '  . '&'
        . ' '  . '&'
        . ' ' . '&'
        . ' ';
    }
?>
