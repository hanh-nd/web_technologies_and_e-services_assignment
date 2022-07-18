<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Bill.php';

class BillService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'bills';
    }

    // public function insert($userId) {
    //     $query = "INSERT INTO comments (product_id, user_id, rate, content) VALUES ('$productId', '$userId', '$rate', '$content')";
    //     parent::setQuery($query);
    //     parent::executeQuery();
    // }

    public function fromObject($object) {
        return new Bill($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new Bill($object));
        }
        return $result;
    }

    public function getBill($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

    public function getFilterBillFormUser($userID, $status) {
        if($status != 'Tất cả')
            $query = "SELECT * FROM bills WHERE user_id = " . $userID . " AND status LIKE '$status' ";
        else
            $query = "SELECT * FROM bills WHERE user_id = " . $userID;
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }
    public function getAllBill() {
        $query = "SELECT * FROM bills";
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }

    public function updateStatus($id, $status){
        $query = "UPDATE bills SET status = '$status' WHERE id = '$id'";
        parent::setQuery($query);
        parent::updateQuery($query);
    }

    public function getLatestBill($userId){
        $query = "SELECT * FROM bills WHERE user_id = '$userId' ORDER BY created_at DESC LIMIT 1";
        parent::setQuery($query);
        $res = parent::executeQuery();
        $res = $this->fromObjectArray($res);
        $bill = $res[0];
        return $bill;
    }
}
?>