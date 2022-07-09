<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Brand.php';
    require_once ROOT . DS . 'services'  . DS .'BrandService.php';

    $service=new BrandService();
    $all_br=$service->getAllBrands();

    $brandID=$_POST['brandID'];
    $producName=$_POST['brandName'];
    $brandImg=$brand_image_url='public/images/brands/' . $_POST['brand_image_url'];

    $service=new BrandService();
    $brand=new Brand($producName, $brandImg);

    $service->insert($brand);
    echo "Insert success!";

    
?>
