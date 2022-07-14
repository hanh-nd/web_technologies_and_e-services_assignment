<?php
require_once 'library_config.php';

if(array_key_exists("bill_id", $_POST) && array_key_exists("status", $_POST) ){
    $bill_id = $_POST['bill_id'];
    $status = $_POST['status'];

    require_once ROOT . DS . 'services' . DS . 'BillService.php';
    $service = new BillService();

    $service->updateStatus($bill_id, $status);
}

header("Location: ../account-management");
