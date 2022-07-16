<?php
ob_start();
session_start();

if(array_key_exists("username", $_POST)){
    echo "hello world";
    require_once ROOT . DS . 'services' . DS . 'AdminServices.php';
    $service = new AdminServices();

    $username = $_POST['username'];
    $password = $_POST['password'];
    $checker = $service->valid($username, $password, "admin");
    if($checker === True){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['admin'] = "admin";
    } else {
        echo "<script>alert('FALSE')</script>";
    }
}

if(isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['admin'])){
		if($_SESSION['username'] != '' && $_SESSION['password'] != '' && $_SESSION['admin'] != '') {
				header("Location: admin");
		}
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
    <p style="text-align : center">Chú ý : Bạn đang đăng nhập vào trang quản trị của hệ thống</p>
    <form action="" method="POST">
        <div class="login-box">
            <h1>Login Admin</h1>
            <div class="textbox">
                <i class="fa fa-user" aria-hidden="true"></i>
                <input type="text" placeholder="Username" name="username" value="">
            </div>
            <div class="textbox">
                <i class="fa fa-lock" aria-hidden="true"></i>
                <input type="password" placeholder="Password" name="password" value="">
            </div>
            <input class="button" type="submit" name="login" value="Đăng nhập">
        </div>
    </form>
</body>

</html>
