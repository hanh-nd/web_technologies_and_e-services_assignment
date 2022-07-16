<?php
	global $path_project;
	require_once ROOT . DS . 'services' . DS . 'UserService.php';
?>

<?php 
	$userService = new UserService();
	if (isset($_POST['password']) && isset($_POST['username'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $phoneNumber = $_POST['phoneNumber'];
        $address = $_POST['address'];

		$existedUser = $userService->getUserByUserName($username);

		if ($existedUser) {
			header('Location: ' . "/" . $path_project . "/" . "register?error=duplicated_username");
			exit();
		}

        $userService->register($username, $password, $fullname, $phoneNumber, $address);
        
        // Login after register
		$login = $userService->login($username, $password);
		if(count($login) == 1){
			setcookie('userId', $login[0]->getId(), time() + (86400 * 30), "/");
			header("Location: home");
			exit();
		}
	}

	$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
    $url_components = parse_url($url);

    if (isset($url_components['query'])) {
        parse_str($url_components['query'], $params);
        if (isset($params['error'])) {
			$error = $params['error'];
			if ($error == "duplicated_username") {
				echo "<script>alert('Tên đăng nhập đã tồn tại. Vui lòng chọn tên đăng nhập khác')</script>";
			}
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
	<link rel="stylesheet" href="public/css/logo.css" type="text/css">
	<title>Đăng ký</title>
</head>

<body>
	<div class="logo-3">
		<a href="<?php echo "/" . $path_project . "/" . "home" ?>">
			<h3>21Store</h3>
			<p>Fast Fashion</p>
		</a>
	</div>
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
				<p class="message">Đã có tài khoản? <a href="<?php echo "/" . $path_project . "/" . "login"?>">Trở về trang đăng nhập</a></p>
			</form>
		</div>
	</div>
</body>

<script>
    function validateRegister() {
        const username = document.forms["formRegister"]["username"].value;
        const password = document.forms["formRegister"]["password"].value;
        const rePassword = document.forms["formRegister"]["rePassword"].value;
        const fullname = document.forms["formRegister"]["fullname"].value;
        const phoneNumber = document.forms["formRegister"]["phoneNumber"].value;
        const address = document.forms["formRegister"]["address"].value;

        if (username === "" || password === "" || fullname === "" || phoneNumber === "" || address === "" ) {
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