<?php require_once ROOT . DS . 'services' . DS . "UserService.php"; ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/purchase.css" type="text/css">
    <link rel="stylesheet" href="public/css/footer.css" type="text/css">
    <link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
    <link rel="stylesheet" href="public/css/profile.css" type="text/css">
    <title>Purchase</title>
</head>

<body>
    <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
    <div class="profile-container">
        <div class="side-bar">
            <h2>Đơn Mua</h2>
            <a>Tất cả</a><br>
            <a>Chờ xác nhận</a><br>
            <a>Đang giao</a><br>
            <a>Đã mua</a><br>
        </div>
        <div style="width: 60%;">
            <div class="infor-profile" id="#username">
                <header>
                    <h3>Trạng thái đơn hàng</h3>
                    <p>Chờ xác nhận</p>
                    <div class="divider"></div>
                </header>
                <div class="purchase-infor">
                    <img src="https://cdn.gumac.vn/image2/bo-suu-tap-web/2022/t0622/0-den-qc06068-fix060620221309474960.jpg?width=450">
                    <div class="name-price">
                        <p>QUầN SUôNG ốNG RộNG</p>
                        <p>X2 <span>348,000 VND</span></p>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="sum-price">
                    <p>Tổng số tiền: &emsp;<span>694,000 VND</span></p>
                    <div class="list-button">
                        <a href="<?php echo  "/" . $path_project . "/" . "detail?id=" .  '1' . "#rateProduct" ?>" style="color: white;">
                            <button id="evaluate">
                                Đánh giá
                            </button>
                        </a>
                        <!-- van dang fix cung -->
                        <a href="<?php echo  "/" . $path_project . "/" . "detail?id=" .  '1' . "#buy" ?>">
                            <button>Mua lại</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>