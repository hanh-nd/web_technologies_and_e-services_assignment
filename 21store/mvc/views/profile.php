<?php require_once ROOT . DS . 'services' . DS . "UserService.php"; ?>

<!DOCTYPE html>
<html lang="vi">
<?php
$userId = $_COOKIE['userId'];
$userService = new UserService();
if (isset($_POST['password']) && isset($_POST['confirmPassword']) == isset($_POST['password'])) {
    $password = $_POST['password'];
    $userService->updatePassword($userService->getUser($userId)->getId(), $password);
}
if (isset($_POST['address']) && isset($_POST['phoneNumber'])  && isset($_POST['fullname'])) {
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber'];
    $fullname = $_POST['fullname'];
    $userService->updateInfor($userService->getUser($userId)->getId(), $phoneNumber, $address, $fullname);
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
            <h2><?php echo $userService->getUser($userId)->getFullname() ?></h2>
            <a href="#username">Tài khoản của tôi</a><br>
            <a href="#password">Đổi mật khẩu</a><br>
        </div>
        <div>
            <div class="infor-profile" id="#username">
                <header>
                    <h3>Hồ Sơ Của Tôi</h3>
                    <p>Quản lý thông tin hồ sơ để bảo mật tài khoản</p>
                    <div class="divider"></div>
                </header>
                <form method="post" class="content-profile" name="formInfor" onsubmit="return validateFormInfor()">
                    <?php $user = $userService->getUser($userId); ?>
                    <p><label>Tên Đăng Nhập</label><span class="input-text"><?php echo $user->getUserName() ?></span></p>
                    <div class="attribute">
                        <label>Tên&emsp;</label>
                        <input type="text" class="input-text" name="fullname" value="<?php echo $user->getFullname() ?>">
                    </div>
                    <div class="attribute">
                        <label>Số điện thoại&emsp;</label>
                        <input type="text" class="input-text" name="phoneNumber" value="<?php echo $user->getPhoneNumber() ?>">
                    </div>
                    <div class="attribute">
                        <label>Địa chỉ&emsp;</label>
                        <input type="text" class="input-text" name="address" value="<?php echo $user->getAddress() ?>">
                    </div>
                    <div class="submit">
                        <p id="validate2"></p>
                        <input type="submit" value="Lưu thay đổi">
                    </div>
                </form>
            </div>
            <div class="infor-profile" id="password">
                <header>
                    <h3>Đổi mật khẩu</h3>
                    <p>Để bảo mật tài khoản, vui lòng không chia sẻ mật khẩu cho người khác</p>
                    <div class="divider"></div>
                </header>
                <form method="post" class="content-profile" name="myForm" onsubmit="return validateForm()">
                    <div class="attribute">
                        <label>Mật Khẩu Mới</label>
                        <input type="password" class="input-text" name="password">
                    </div>
                    <div class="attribute">
                        <label>Xác Nhận Mật Khẩu</label>
                        <input type="password" class="input-text" name="confirmPassword">
                    </div>
                    <div class="submit">
                        <p id="validate"></p>
                        <input type="submit" value="Lưu thay đổi">
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>

<script type="text/javascript" src=<?php echo "/" . $path_project . "/" . "public/js/profile.js" ?>></script>