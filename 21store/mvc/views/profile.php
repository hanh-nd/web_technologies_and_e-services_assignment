<?php require_once ROOT . DS . 'services' . DS . "UserService.php"; ?>

<!DOCTYPE html>
<html lang="vi">
<?php 
    $userService = new UserService();
    if(isset($_POST['password']) && isset($_POST['confirmPassword']) == isset($_POST['password'])){
        $password = $_POST['password'];
        $userService->updatePassword($userService->getUser(1)->getId(), $password);
    }
    if(isset($_POST['address']) && isset($_POST['phoneNumber'])  && isset($_POST['fullname'] )){
        $address = $_POST['address'];
        $phoneNumber = $_POST['phoneNumber'];
        $fullname = $_POST['fullname'];
        $userService->updateInfor($userService->getUser(1)->getId(), $phoneNumber, $address, $fullname);
    }
?>
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
                <form method="post" class="content-profile" style="padding-left: 70px;" name="formInfor" onsubmit="return validateFormInfor()">
                <?php    $user = $userService->getUser(1);?>
                    <p><label>Tên Đăng Nhập</label> &emsp;<span><?php echo $user->getUserName() ?></span></p>
                    <div class="attribute" style="margin-left: 90px;">
                        <label>Tên&emsp;</label>
                        <input type="text" class="input-text" name="fullname"
                        value="<?php echo $user->getFullname() ?>">
                    </div>
                    <div class="attribute" style="margin-left: 18px;">
                        <label>Số điện thoại&emsp;</label>
                        <input type="text" class="input-text" name="phoneNumber"
                        value="<?php echo $user->getPhoneNumber() ?>">
                    </div>
                    <div class="attribute" style="margin-left: 65px;">
                        <label>Địa chỉ&emsp;</label>
                        <input type="text" class="input-text" name="address"
                            value="<?php echo $user->getAddress() ?>">
                    </div>
                    <p id="validate2"></p>
                    <input type="submit" value="Lưu thay đổi">
                </form>
            </div>
            <div class="infor-profile" id="password">
                <header>
                    <h3>Đổi mật khẩu</h3>
                    <p>Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>
                    <div class="divider"></div>
                </header>
                <form method="post" class="content-profile" name="myForm" onsubmit="return validateForm()">
                    <div class="attribute" style="margin-left: 45px;">
                        <label>Mật Khẩu Mới&emsp;</label>
                        <input type="text" class="input-text" name="password">
                    </div>
                    <div class="attribute" style="margin-left: 4px;">
                        <label>Xác Nhận Mật Khẩu&emsp;</label>
                        <input type="text" class="input-text" name="confirmPassword">
                    </div>
                    <p id="validate"></p>
                    <input type="submit" value="Lưu thay đổi" style="margin-left: 168px">
                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src = <?php echo "/" . $path_project . "/" . "public/js/profile.js" ?>></script>
