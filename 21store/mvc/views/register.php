<?php
require_once ROOT . DS . 'services' . DS . 'UserService.php';
?>

<?php 
	$userService = new UserService();
	if (isset($_POST['password']) && isset($_POST['username'])) {
		$password = $_POST['password'];
		$username = $_POST['username'];
        $fullname = $_POST['fullname'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];

        $userService->register($username, $password, $fullname, $phoneNumber, $address);
        
        // Login after register
		$login = $userService->login($username, $password);
		if(count($login) == 1){
			setcookie('userId', $login[0]->getId(), time() + (86400 * 30), "/");
			header("Location: home");
			exit();
		}
	}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="public/css/register.css" type="text/css">
	<title>Đăng ký</title>
</head>

<body>
	<div class="register-page">
		<img src="https://cdn.haitrieu.com/wp-content/uploads/2021/07/Hinh-anh-fast-fashion-la-gi.png" alt="img">
		<div class="form">
			<form class="register-form" method="post" name="formRegister" onsubmit="return validateRegister()">
				<input type="text" placeholder="Tên đăng ký" name="username"/>
				<input type="password" placeholder="Mật khẩu" name="password"/>
                <input type="password" placeholder="Nhập lại mật khẩu" name="rePassword"/>
                <input type="text" placeholder="Tên của bạn" name="fullname"/>
				<input type="text" placeholder="Số điện thoại" name="phoneNumber"/>
				<input type="text" placeholder="Địa chỉ" name="address"/>

				<p id="validateRegister"></p>
				<button type="submit">Đăng ký</button>
			</form>
		</div>
	</div>
</body>

<script>
    function validateRegister() {
        const username = document.forms["formRegister"]["username"].value;
        const password = document.forms["formRegister"]["password"].value;
        const rePassword = document.forms["formRegister"]["rePassword"].value;
        if (username === "" || password === "") {
            document.getElementById("validateRegister").innerHTML = "Hãy điền đủ thông tin !!";
            return false;
        }
        if (username.length < 5) {
            document.getElementById("validateRegister").innerHTML = "Tên đăng nhập phải lớn hơn 4 ký tự !!";
            return false;
        }
        if (password.length < 6) {
            document.getElementById("validateRegister").innerHTML = "Mật khẩu phải nhiều hơn 6 kí tự!!";
            return false;
        }
        if (password !== rePassword) {
            document.getElementById("validateRegister").innerHTML = "Mật khẩu nhập lại không khớp!!";
            return false;
        }
    }
</script>