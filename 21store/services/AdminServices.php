<?php
require_once ROOT . DS . 'services' . DS . 'DatabaseConnect.php';

class AdminServices extends DatabaseConnect {
    public function valid($username, $password){
        $query = "select * from admin where admin_username = '$username' and admin_password = '$password'";

        parent::setQuery($query);
        $result = parent::executeQuery1();
        if(mysqli_fetch_array($result)){
            return True;
        } else {
            return False;
        }
    }

    public function create($username, $password){
        $query = "insert admin (admin_username, admin_password)
                  value('$username', '$password')";

        parent::setQuery($query);
        parent::updateQuery();
    }
}
