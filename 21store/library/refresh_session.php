<?php
ob_start();
session_start();


if(array_key_exists("username", $_SESSION)){
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['admin']);
    header("Location: ../login-admin");
}

?>
