<?php
ob_start();
session_start();


if(array_key_exists("admin_username", $_SESSION)){
    unset($_SESSION['admin_username']);
    unset($_SESSION['admin_password']);
    unset($_SESSION['admin']);
    header("Location: ../login-admin");
}

?>
