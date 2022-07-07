<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Cart.php';

class CartService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'cart_sessions';
    }

    public function insert($userId) {
        $query = "INSERT INTO cart_sessions (user_id) VALUES (`$userId`)";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function fromObject($object) {
        return new Cart($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new Cart($object));
        }
        return $result;
    }

    public function getCart($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

}
?>