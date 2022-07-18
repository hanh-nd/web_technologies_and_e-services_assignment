<?php
require_once ROOT . DS . 'services' . DS . "IMapper.php";
require_once ROOT . DS . 'services' . DS . "DatabaseConnect.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'User.php';
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Bill.php';
require_once ROOT . DS . 'services' . DS . "BillService.php";
require_once ROOT . DS . 'mvc' . DS . 'models' . DS . 'Cart.php';
require_once ROOT . DS . 'services' . DS . "CartService.php";

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

    public function fromBillObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new Bill($object));
        }
        return $result;
    }

    public function fromCartObjectArray($objectArray) {
        $result = array();
        foreach ($objectArray as $object) {
            array_push($result, new Cart($object));
        }
        return $result;
    }

    public function getUser($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

    public function getUserByUserName($username) {
        $query = "SELECT * FROM users WHERE username = '$username'";
        parent::setQuery($query);
        $result = parent::executeQuery();
        if (empty($result)) {
            return false;
        }
        return $this->fromObject($result[0]);
    }
    public function getAll(){
        $objArr = $this->selectAll();
        return $this->fromObjectArray($objArr);
    }

    public function updateInfor($id, $newPhoneNumber, $newAddress, $newFullname) {
        $query = "UPDATE users SET address = '$newAddress', phone_number = '$newPhoneNumber', fullname = '$newFullname' WHERE id = '$id'";
        parent::setQuery($query);
        parent::updateQuery($query);
    }

    public function updatePassword($id, $newPassword) {
        $query = "UPDATE users SET password = '$newPassword' WHERE id = '$id'";
        parent::setQuery($query);
        parent::updateQuery($query);
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE password LIKE '$password' AND username LIKE '$username'";
        parent::setQuery($query);
        $objArr = parent::executeQuery();
        return $this->fromObjectArray($objArr);
    }

    public function register($username, $password, $fullname = '', $phoneNumber = '', $address = '') {
        $query = "INSERT INTO users (username, password, fullname, phone_number, address) VALUES ('$username', '$password', '$fullname', '$phoneNumber', '$address')";
        parent::setQuery($query);
        parent::executeQuery();
    }

    public function delete($userId) {
        // delete comments
        $query = "DELETE FROM comments WHERE user_id = '$userId'";
        parent::setQuery($query);
        parent::executeQuery();

        // delete cart
        $query = "SELECT * from cart_sessions WHERE user_id = '$userId'";
        parent::setQuery($query);
        $carts = $this->fromCartObjectArray(parent::executeQuery());
        
        foreach ($carts as $cart) {
            $cartId = $cart->getId();
            $query = "DELETE FROM cart_items WHERE cart_session_id = '$cartId'";
            parent::setQuery($query);
            parent::executeQuery();
        }

        $query = "DELETE FROM cart_sessions WHERE user_id = '$userId'";
        parent::setQuery($query);
        parent::executeQuery();

        // delete bill
        $query = "SELECT * from bills WHERE user_id = '$userId'";
        parent::setQuery($query);
        $bills = $this->fromBillObjectArray(parent::executeQuery());
        
        foreach ($bills as $bill) {
            $billId = $bill->getId();
            $query = "DELETE FROM order_items WHERE bill_id = '$billId'";
            parent::setQuery($query);
            parent::executeQuery();
        }

        $query = "DELETE FROM bills WHERE user_id = '$userId'";
        parent::setQuery($query);
        parent::executeQuery();

        // delete user
        $query = "DELETE FROM users WHERE id = '$userId'";
        parent::setQuery($query);
        parent::executeQuery();
    }
}
?>