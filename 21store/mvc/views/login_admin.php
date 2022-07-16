<?php
ob_start();
session_start();
require_once ROOT . DS . 'services' . DS . 'AdminService.php';

if(array_key_exists("username", $_POST)){
    $service = new AdminService();
    $username = $_POST['username'];
    $password = $_POST['password'];
    $isValid = $service->valid($username, $password, "admin");
    if($isValid == True){
        $_SESSION['admin_username'] = $username;
        $_SESSION['admin_password'] = $password;
        $_SESSION['admin'] = "admin";
    } else {
        echo "<script>alert('FALSE')</script>";
    }
}

if (isset($_SESSION['admin_username']) 
    && !empty($_SESSION['admin_username'])
    && isset($_SESSION['admin_password']) 
    && !empty($_SESSION['admin_password'])
    && isset($_SESSION['admin'])
    && !empty($_SESSION['admin'])
) {
    header("Location: account-management");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="public/css/login_admin.css">
    <title>Login Admin</title>
</head>

<body>
    <h4>Trang quản trị hệ thống 21-Store</h4>
    <div class="login-page">
        <div class="form">
            <form action="" method="POST" class="login-form">
                <h2>Login By Admin</h2>
                <input type="text" placeholder="Username" name="username" value="">
                <input type="password" placeholder="Password" name="password" value="">
                <button type="submit" name="login">Đăng nhập</button>
        </div>
        </form>
    </div>
</body>

</html>
