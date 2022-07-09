<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'services'  . DS .'ProductService.php';

    $service=new ProductService();
    $all_pd=$service->getAllProducts();
    //product_name, product_description, price, image_url, size, color, material, brand_id, product_type, quantity

    $type=$_POST['type'];

    $producName=$_POST['productName'];
    $price=$_POST['price'];
    $productDescription=$_POST['productDescription'];
    $color=$_POST['color'];
    $size=$_POST['size'];
    $material=$_POST['material'];
    $brand_id=$_POST['brand_id'];
    $product_type=$_POST['product_type'];
    $quantity=$_POST['quantity'];
    $image_url='public/images/products/' . $_POST['image_url'];


    $service= new ProductService();
    $product=new Product($producName,$productDescription, $price, $image_url,
    $size, $color, $material, $brand_id, $product_type, $quantity);

    $service->insert($product);
    echo "Insert success!";

?>
