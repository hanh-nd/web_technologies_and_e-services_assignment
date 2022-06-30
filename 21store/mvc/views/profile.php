<?php ?>

<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="public/css/about.css" type="text/css">
		<link rel="stylesheet" href="public/css/footer.css" type="text/css">
		<link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
		<title>About</title>
	</head>
	<body>
		<?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
		<div class="about-container" >
            <div class="about-content">
                <div class="introduction">
                    <h1>Giới thiệu</h1>
                    <p>Thành lập vào tháng 6 năm 2022, 21Strore đã khẳng định được chỗ đứng vững chắc trên thị trường và trở thành thương hiệu thời trang có tốc độ tăng trưởng nhanh nhất tại Việt Nam với hệ thống cửa hàng với gần 90 showrooms trên toàn quốc; Hàng triệu khách hàng thân thiết; Là nhà bán số 1 về ngành hàng thời trang trên các sàn Thương mại điện tử phổ biến nhất trong nước như: Tiki, Lazada, Shopee, Sendo,… và sắp có mặt tại sàn Thương Mại điện tử lớn nhất Thế Giới Amazon.</p>
                    <q>21STORE PHÁT TRIỂN MÔ HÌNH SIÊU THỊ THỜI TRANG HẠNH PHÚC</q>
                </div>
                <div class="images">
                    <div>
                        <img src=<?php echo "/" . $path_project . "/" . "images/about/for-women.jpg" ?> width="1120">
                        <img src=<?php echo "/" . $path_project . "/" . "images/about/for-men.jpg" ?> width="1120">
                        <img src=<?php echo "/" . $path_project . "/" . "images/about/for-teen.jpg" ?> width="1120">
                        <br><br>
                    </div>
                </div>
            </div>
		</div>