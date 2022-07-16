<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Brand.php';
    require_once ROOT . DS . 'services'  . DS .'BrandService.php';

    $brandName=$_POST['brandName'];
    $brandImg=$brand_image_url='public/images/brands/' . $_POST['brand_image_url'];

    $service=new BrandService();
    $service->insert($brandName, $brandImg);
    echo "Insert success!";

    
?>
