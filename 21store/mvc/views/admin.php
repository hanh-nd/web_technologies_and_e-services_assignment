<?php
// check session
ob_start();
session_start();
if (!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username'])) {
    header("Location: login-admin");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/admin/admin.css">
</head>

<body>
    <div class="sidebar">
        <h3 class="title">Menu</h3>
        <a href="account-management" class="sidebar-button">
            <span class="glyphicon glyphicon-user"></span>&emsp;Quản lý tài khoản
        </a>
        <a href="product-management" class="sidebar-button">
            <span class="glyphicon glyphicon-shopping-cart"></span>&emsp;Quản lý sản phẩm
        </a>
        <a href="library/refresh_session.php" class="sidebar-button">
            <span class="glyphicon glyphicon-log-out"></span>&emsp;Đăng xuất
        </a>
    </div>
</body>

</html>