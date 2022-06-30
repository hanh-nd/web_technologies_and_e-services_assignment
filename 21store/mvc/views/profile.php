<?php ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/profile.css" type="text/css">
    <link rel="stylesheet" href="public/css/footer.css" type="text/css">
    <link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
    <title>Profile</title>
</head>

<body>
    <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
    <div class="profile-container">
        <div>
            <h2>Hoang Anh</h2>
            <a>Tài khoản của tôi</a><br>
            <a>Đổi mật khẩu</a><br>
            <a>Đơn mua</a><br>
        </div>
        <div class="infor-profile">
            <header>
                <h3>Hồ Sơ Của Tôi</h3>
                <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                <div class="divider"></div>
            </header>
            <div class="content-profile">
                <p><label>Tên Đăng Nhập</label> &emsp;<span>hoanganh</span></p>
                <div class="attribute" style="margin-left: 18px;">
                    <label>Số điện thoại&emsp;</label>
                    <input type="text" class="input-text">
                </div>
                <div class="attribute" style="margin-left: 65px;">
                    <label>Địa chỉ&emsp;</label>
                    <input type="text" class="input-text">
                </div>
                <input type="submit" value="Lưu thay đổi">            
            </div>
        </div>
    </div>
</body> 