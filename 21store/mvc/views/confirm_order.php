<?php
require_once ROOT . DS . 'services' . DS . 'OrderItemService.php';
require_once ROOT . DS . 'services' . DS . 'UserService.php';
require_once ROOT . DS . 'services' . DS . 'BillService.php';
require_once ROOT . DS . 'services' . DS . 'ProductService.php';
require_once ROOT . DS . 'services' . DS . 'CartItemService.php';

$userService = new UserService();
$userId = $_COOKIE['userId'];
$user = $userService->getUser($userId);


$cartItemService = new CartItemService();
$productService = new ProductService();
$allCartItems = $cartItemService->getAllCartItemsFormCart($userId);


if (isset($_POST['buy'])) {
    $cartService = new CartService();
    $cartService->buy($_COOKIE['userId']);
    header("Location: purchase");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/footer.css" type="text/css">
    <link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
    <link rel="stylesheet" href="public/css/purchase.css" type="text/css">
    <title>CONFIRM ORDER</title>
</head>

<body>
    <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
    <div class="bill-container" style="margin-top: 3%; min-height: 50vh">
        <form method="post">
            <?php
            $cartItemService = new CartItemService();
            $allCartItems = $cartItemService->getAllCartItemsFormCart($userId);
            if (empty($allCartItems)) {
                echo "<div class='not-buy' style='text-align: center'>Không có sản phẩm để hiển thị</div>";
            } else { ?>
                <div>
                    <div class="col">
                        <div class="delivery-infor">
                            <span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10zm0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6z" />
                                </svg>
                                Địa chỉ nhận hàng:
                            </span>
                            <br><br>
                            <p><b><?php echo $user->getFullName() ?>&emsp;
                                    <?php echo $user->getPhoneNumber() ?>&emsp;</b>
                                <?php echo $user->getAddress() ?>&emsp;
                                <a href="<?php echo  "/" . $path_project . "/" . "profile" ?>">Chỉnh sửa</a>
                            </p>
                        </div>
                        <div class="infor-bill" id="#username">
                            <header>
                                <h3>Giỏ hàng của bạn</h3>
                                <p>Hiện đang có: <?php echo count($allCartItems) ?> sản phẩm</p>
                                <div class="divider"></div>
                            </header>
                            <?php $sum  = 0;
                            $allCartItems = $cartItemService->getAllCartItemsFormCart($userId);
                            foreach ($allCartItems as $item) {
                                $productId = $item->getProductId();
                                $product = $productService->getProduct($productId);
                                $id = $item->getId();
                                $currentQuantity = $item->getQuantity();
                                $sum = $sum + $currentQuantity * $product->getPrice();
                            ?>
                                <div class="purchase-infor">
                                    <a href="<?php echo  "/" . $path_project . "/" . "detail?id=" .  $item->getProductId() ?>">
                                        <img src=<?php echo $product->getImageUrl(); ?> />
                                    </a>
                                    <div class="name-price">
                                        <p><?php echo $product->getProductName() ?></p>
                                        <p class="quantity">X<?php echo $currentQuantity ?>
                                            <span><?php echo number_format(($currentQuantity * $product->getPrice()), 0, '', ',') . " VND" ?></span>
                                        </p>
                                    </div>
                                </div>
                                <div class="divider"></div>
                            <?php
                            }
                            ?>
                            <div class="order">
                                <p>Tổng số tiền sản phẩm: <?php echo number_format($sum, 0, '', ',') . " VND" ?></p>
                                <p>Phí giao hàng: 20,000 VND</p>
                                <p>Giảm giá : -20,000 VND (phí giao hàng)</p>
                                <p>Số tiền cần thanh toán: <span><?php echo number_format($sum, 0, '', ',') . " VND" ?></span> </p>
                                <h5>&emsp;Bằng cách đặt hàng, bạn đã đồng ý với <a href="<?php echo "/" . $path_project . "/" . "policy" ?>">
                                        Chính sách</a> của chúng tôi
                                </h5>
                                <div class="list-button">
                                    <button id="evaluate" type="submit" name="buy">
                                        Đặt hàng
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </form>
    </div>
</body>