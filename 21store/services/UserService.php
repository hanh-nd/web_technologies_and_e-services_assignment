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
        return $result;// co loi khi doi thong tin tai khoan
    }

    public function getUser($id) {
        $obj = $this->select($id);
        return $this->fromObject($obj);
    }

    public function getUserByUserName($username) {
        $query = "select * from users where username = '$username'";
        parent::setQuery($query);
        $result = parent::executeQuery();
        return $this->fromObject($result);
    }
    public function getAll(){
        $listUser = array();
        $query = "select * from users";
        parent::setQuery($query);
        $result = parent::executeQuery();

        while($row = mysqli_fetch_array($result)){
            $username = $row["user_name"];
            $password = $row["password"];
            $phoneNumber = $row["phone_number"];
            $address = $row["address"];

            $user = new User($username, $password, $phoneNumber, $address);

            array_push($listUser, $user);
        }

        return $listUser;
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
}
?>