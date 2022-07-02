<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'OrderItem.php';

class OrderItemService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'order_items';
    }

    // public function insert($productId, $userId, $rate, $content) {
    //     $query = "INSERT INTO comments (product_id, user_id, rate, content) VALUES ('$productId', '$userId', '$rate', '$content')";
    //     parent::setQuery($query);
    //     parent::executeQuery();
    // }

    public function fromObject($object) {
        return new OrderItem($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new OrderItem($object));
        }
        return $result;
    }

    public function getOrderItem($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }
    public function getAllOrderFormBill($billId) {
        $query = "SELECT * FROM order_items WHERE bill_id = " . $billId;
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }
}
?>