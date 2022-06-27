<?php
	require_once ROOT . DS . 'services' . DS . 'ProductService.php';
?>

<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="public/css/home.css" type="text/css">
		<link rel="stylesheet" href="public/css/footer.css" type="text/css">
		<link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
		<title>Home</title>
	</head>
<body>
	<?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
    <div class="home-container">
		<div class="home-content">
			<div class="slideshow-container">
				<div class="mySlides fade">
					<img src=<?php echo "/" . $path_project . "/" . "public/images/banner/banner-1.jpg" ?> >
				</div>
				<div class="mySlides fade">
					<img src=<?php echo "/" . $path_project . "/" . "public/images/banner/banner-2.jpg" ?> >
				</div>
				<div class="mySlides fade">
					<img src=<?php echo "/" . $path_project . "/" . "public/images/banner/banner-3.jpg" ?> >
				</div>
				<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				<a class="next" onclick="plusSlides(1)">&#10095;</a>
				<div class="dot-container">
					<span class="dot" onclick="currentSlide(1)"></span>
					<span class="dot" onclick="currentSlide(2)"></span>
					<span class="dot" onclick="currentSlide(3)"></span>
				</div>
			</div>
			<div class="new-arrival-container">
				TOP MOI NHAT
			</div>
			<div class="brand-container">
				DANH SACH THUONG HIEU
			</div>
		</div>
	</div>

	<script type="text/javascript" src = <?php echo "/" . $path_project . "/" . "public/js/home.js" ?>></script>
