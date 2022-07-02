<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'user.php';

class UserService extends DatabaseConnect implements IMapper { 
    public function __construct() {
        parent::__construct();
        $this->table = 'users';
    }

    public function insert($username, $password, $fullname, $phoneNumber, $address) {
        $query = "INSERT INTO users(username, password, phone_number, address) 
            VALUES (`$username`, `$password`, `$fullname`, `$phoneNumber`, `$address`)";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function fromObject($object) {
        return new User($object);
    }

    public function fromObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new User($object));
        }
        return $result;
    }

    public function getUser($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

    // public function getAllUserFormProduct($productId) {
    //     $query = "SELECT * FROM users WHERE product_id = " . $productId;
    //     parent::setQuery($query);
    //     $objArr = parent::executeQuery();
    //     return $this->fromObjectArray($objArr);
    // }
}
?>