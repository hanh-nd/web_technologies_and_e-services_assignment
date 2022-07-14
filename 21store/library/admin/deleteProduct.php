<?php
    require_once '../library_config.php';

    require_once ROOT . DS . 'services' . DS .'ProductService.php';

    $id=$_GET['id'];
    $service = new ProductService();
    $service->delete($id);
    echo "Delete success!";
?>
