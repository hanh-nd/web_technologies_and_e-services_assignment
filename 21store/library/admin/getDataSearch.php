<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Brand.php';
    require_once ROOT . DS . 'services' . DS .'ProductService.php';
    require_once ROOT . DS . 'services' . DS .'BrandService.php';

    $type=$_GET['type'];
    $productName=$_GET['productName'];
    $productType=$_GET['productType'];
    $brandName = $_GET['brandName'];

    if($type=='1'){
        $services = new ProductService();
        $products= $services->getAllProducts();
        foreach($products as $product){
            if(($product->getProductName()== $productName || $productName=="") && ($product->getProductType()==$productType || $productType=="") && ($product->getBrandName()==$brandName || $brandName=="")){
                echo '<div class="product">';
                echo ' <div>';
                echo '<img src="' . $product->getImageUrl() . '" alt="" width="200px;" height="200px">';
                echo '<p style="margin-left: 5px;">' . $product->getProductName() . '</p>';
                echo '<p style="margin-top: 0px; margin-right: 0px;">' . $product->getPrice() . 'Đ</p>';
                echo '</div>';
                echo '<div>';
                echo '<button class="btn-ql-xx" onclick="sc_ct_sp(this.value)" value="'. $product->getId() . '">Detail</button>';
                echo '<button class="btn-ql-xx" onclick="delete_by_id(this)" value="'. $product->getId() .'">Delete</button>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
    if($type=='2'){
        $services = new BrandService();
        $brands= $services->getAllBrands();
        foreach($brands as $brand){
            if($brand->getBrandName()==$brandName || $brandName==""){
                echo '<div class="brand">';
                echo ' <div>';
                echo '<img src="' . $brand->getImageUrl() . '" alt="" width="200px;" height="200px">';
                echo '<p style="margin-left: 5px;">' . $brand->getBrandName() . '</p>';
                echo '</div>';
                echo '<div>';
                echo '<button class="btn-ql-xx" onclick="sc_ct_sp(this.value)" value="'. $brand->getId() . '">Detail</button>';
                echo '<button class="btn-ql-xx" onclick="delete_by_id(this)"  value="'. $brand->getId() .'">Delete</button>';
                echo '</div>';
                echo '</div>';
            }
        }
    }
?>
