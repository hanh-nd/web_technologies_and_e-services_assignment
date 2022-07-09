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
        $products = $service->getAllProducts();
        foreach($products as $product){
            if($product->getId() != $id){
                continue;
            }
            echo $product->getId() . "&"
            . $product->getProductName() . '&'
            . $product->getImageUrl() . '&'
            .  $product->getPrice() . '&'
            . $product->getProductType() . '&'
            . $product->getColor() . '&'
            .  $product-> getBrandName() . '&'
            . $product->getSize() . '&'
            .  $product->getMaterial() . '&'
            .  $product->getDescription() . '&'
            . $product->getQuantity() . '&'
            . " "  . '&'
            . ' '  . '&'
            . ' '  . '&'
            . ' ' . '&'
            . ' ';

        }
    }elseif($type=='2'){
            $service=new BrandService();
            $brands = $service->getAllBrands();
            foreach($brands as $brand){
                if($brand->getId() != $id){
                    continue;
                }
                echo $brand->getId() . "&"
            . $brand->getBrandName() . '&'
            . $brand->getImageUrl() . '&'
            . ' '  . '&'
            . ' '  . '&'
            . ' ' . '&'
            . ' ';


            }
    }
?>
