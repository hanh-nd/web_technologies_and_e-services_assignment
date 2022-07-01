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
        <div class="side-bar">
            <h2>Hoang Anh</h2>
            <a href="#username">Tài khoản của tôi</a><br>
            <a href="#password">Đổi mật khẩu</a><br>
        </div>
        <div style="width: 60%;">
            <div class="infor-profile" id="#username">
                <header>
                    <h3>Hồ Sơ Của Tôi</h3>
                    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    <div class="divider"></div>
                </header>
                <div class="content-profile" style="padding-left: 70px;">
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
            <div class="infor-profile" id="password">
                <header>
                    <h3>Đổi mật khẩu</h3>
                    <p>Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>
                    <div class="divider"></div>
                </header>
                <div class="content-profile">
                    <div class="attribute" style="margin-left: 45px;">
                        <label>Mật Khẩu Mới&emsp;</label>
                        <input type="text" class="input-text">
                    </div>
                    <div class="attribute" style="margin-left: 4px;">
                        <label>Xác Nhận Mật Khẩu&emsp;</label>
                        <input type="text" class="input-text">
                    </div>
                    <input type="submit" value="Lưu thay đổi" style="margin-left: 168px">
                </div>
            </div>
        </div>
    </div>
</body>