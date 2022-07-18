<?php
    global $path_project;
    // check session
    ob_start();
    session_start();
    if (!isset($_SESSION['admin_username']) || empty($_SESSION['admin_username'])) {
        header("Location: login-admin");
    }
    // } else {
    //     header("Location: account-management");

    // }

?>

<body>
    <div class="sidebar">
        <h3 class="title">Menu</h3>
        <a href="account-management" class="sidebar-button">
            <span class="glyphicon glyphicon-user"></span>&emsp;Quản lý tài khoản
        </a>
        <div class="sidebar-button menu" onclick="onMenuClick()">
            <span class="glyphicon glyphicon-shopping-cart"></span>&emsp;Quản lý sản phẩm
        </div>
        <a href="add-product" class="sidebar-button sub-menu">
            <span class="glyphicon glyphicon-plus"></span>&emsp;Thêm sản phẩm
        </a>
        <a href="product-management" class="sidebar-button sub-menu">
            <span class="glyphicon glyphicon-th-list"></span>&emsp;Danh sách sản phẩm
        </a>
        <a href="library/refresh_session.php" class="sidebar-button">
            <span class="glyphicon glyphicon-log-out"></span>&emsp;Đăng xuất
        </a>
    </div>
    <script type="text/javascript" src ="<?php echo '/' . $path_project . '/' . 'public/js/admin.js' ?>"></script>
</body>
