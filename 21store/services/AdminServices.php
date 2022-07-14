<?php
require_once ROOT . DS . 'services' . DS . 'DatabaseConnect.php';

class AdminServices extends DatabaseConnect {
    public function valid($username, $password, $role){
        $query = "select * from users where username = '$username' and password = '$password' and role = '$role'";

        parent::setQuery($query);
        $result = parent::executeQuery1();
        if(mysqli_fetch_array($result)){
            return True;
        } else {
            return False;
        }
    }

}
