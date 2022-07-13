<?php
require_once ROOT . DS . 'services' . DS . 'ProductService.php';
require_once ROOT . DS . 'services' . DS . 'BrandService.php';
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
			<form class="login-form">
				<input type="text" placeholder="username" />
				<input type="password" placeholder="password" />
				<button>login</button>
				<p class="message">Not registered? <a href="#">Create an account</a></p>
			</form>
		</div>
	</div>
</body>
<script type="text/javascript" src=<?php echo "/" . $path_project . "/" . "public/js/login.js" ?>></script>