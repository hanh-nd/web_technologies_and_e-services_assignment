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
		<link rel="stylesheet" href="public/css/home.css" type="text/css">
		<link rel="stylesheet" href="public/css/footer.css" type="text/css">
		<link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
		<link rel="stylesheet" href="public/css/detail.css" type="text/css">
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
				<div class="new-arrival title">
					Top mới nhất
				</div>
				<div class="new-arrival product-list">
					<?php
						$service = new ProductService();
						$products = $service->getNewArrivalProducts();
						foreach($products as $product) {
					?>
							<div class="product-item-row">
								<a href="<?php echo  "/" . $path_project . "/" . "detail?id=" .  $product->getId() ?>">
									<img src=<?php echo $product->getImageUrl() ?> width="250">		
									<p><?php echo $product->getProductName() ?></p>
									<p><?php echo $product->getFormattedPrice() ?></p>					
								</a>
							</div>
					<?php
						}
					?>	
				</div>
			</div>
			<div class="brand-container">
				<div class="brand title">
					Danh sách thương hiệu
				</div>
				<div class="brand brand-list">
					<?php
						$service = new BrandService();
						$brands = $service->getAllBrands();
						foreach($brands as $brand) {
					?>
							<div class="brand-item-row">
								<img src=<?php echo $brand->getImageUrl() ?> width="150">
							</div>
					<?php
						}
					?>	
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src = <?php echo "/" . $path_project . "/" . "public/js/home.js" ?>></script>
