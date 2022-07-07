<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Bill.php';

class BillService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'bills';
    }

    // public function insert($productId, $userId, $rate, $content) {
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
}
?>