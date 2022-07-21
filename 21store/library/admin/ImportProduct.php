<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Product.php';
    require_once ROOT . DS . 'services' . DS .'ProductService.php';
    require_once ROOT . DS . 'services' . DS .'BrandService.php';


    $csvPath= $_POST['path'];
    $file = fopen("../../$csvPath", 'r');
    $header = true;
    $productService = new ProductService();
    $brandService = new BrandService();
    while (($line = fgetcsv($file)) !== FALSE) {
        if ($header == true) {
            $header = false;
            continue;
        }

        $id = $line[0];
        $productName = $line[1];
        $price = $line[2];
        $size = $line[3];
        $color = $line[4];
        $quantity = $line[5];
        $type = $line[6];
        $brand = $line[7];
        $material = $line[8];
        $description = $line[9];
        $imageUrl = $line[10];

        $parsedPrice = substr(str_replace(',', '', $price), 0, -4);
        $brandId = $brandService->findByName($brand)->getId();

        $productService->insert($productName,$description, $price, $imageUrl,
        $size, $color, $material, $brandId, $type, $quantity);
    }
    fclose($file);
    echo "Import successfully";
    

?>
