<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Brand.php';
    require_once ROOT . DS . 'services' . DS .'ProductService.php';


    $type=$_POST['type'];
    $id=$_POST['id'];
    $name=$_POST['name'];
    $price=$_POST['price'];
    $des=$_POST['des'];
    $color=$_POST['color'];
    $size=$_POST['size'];
    $material=$_POST['material'];
    $brand=$_POST['brand'];
    $product_type=$_POST['product_type'];
    $quantity=$_POST['quantity'];
    $image_url= $_POST['image_url'];



    $service= new ProductService();
    $service->update($id,$name,$des, $price, $image_url,
    $size, $color, $material, $brand, $product_type, $quantity);
    echo "Update success!";


?>
