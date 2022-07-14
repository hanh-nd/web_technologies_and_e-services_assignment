<?php
require_once ROOT . DS . 'services' . DS . 'UserService.php';
?>


<?php 
	$userService = new UserService();
	if (isset($_POST['password']) && isset($_POST['username'])) {
		$password = $_POST['password'];
		$username = $_POST['username'];
		$login = $userService->login($username, $password);
		if(count($login) == 1){
			setcookie('userId', $login[0]->getId(), time() + (86400 * 30), "/");
			header("Location: home");
			exit;
		}else {
			echo "<script>alert('Wrong username or password')</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="public/css/login.css" type="text/css">
	<title>Login</title>
</head>

<body>
	<div class="login-page">
		<img src="https://cdn.haitrieu.com/wp-content/uploads/2021/07/Hinh-anh-fast-fashion-la-gi.png" alt="img">
		<div class="form">
			<form class="login-form" method="POST">
				<input type="text" placeholder="username" name="username"/>
				<input type="password" placeholder="password" name="password"/>
				<button type="submit">login</button>
				<p class="message">Not registered? <a href="#">Create an account</a></p>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript" src=<?php echo "/" . $path_project . "/" . "public/js/login.js" ?>></script>