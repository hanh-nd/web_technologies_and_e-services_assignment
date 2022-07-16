<?php
require_once ROOT . DS . 'services' . DS . 'DatabaseConnect.php';

class AdminService extends DatabaseConnect {
    public function valid($username, $password, $role){
        $query = "select * from users where username = '$username' and password = '$password' and role = '$role'";

        parent::setQuery($query);
        $result = parent::executeQuery();
        if(!empty($result[0])){
            return True;
        } else {
            return False;
        }
    }

}
