<?php
    global $path_project;

    if(isset($_COOKIE['userId']) && !empty($_COOKIE['userId'])) {
        unset($_COOKIE['userId']);
        setcookie('userId', "", time() - 3600, "/");
    } 
    header('Location: ' . "/" . $path_project . "/");
?>