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


if (isset($_POST['decrease'])) {
    $cartItemService->update($_POST['decrease'][0], false);
} 
if (isset($_POST['increase'])) {
    $cartItemService->update($_POST['increase'][0], true);
}
if (isset($_POST['quantity'])) {
    foreach ($allCartItems as $index => $cartItem) {
        if ($cartItem->getQuantity() != $_POST['quantity'][$index]) {
            $cartItemService->updateQuantity($cartItem->getId(), $_POST['quantity'][$index]);
        }
    }
}
if (isset($_POST['buy'])) {
    $cartService = new CartService();
    $cartService->buy($_COOKIE['userId']);
    header("Location: purchase");
}
?>

<?php
$cartItemService = new CartItemService();
if (isset($_POST['delete'])){
    $cartItemService->deleteItem($_POST['delete'][0]);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/footer.css" type="text/css">
    <link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
    <link rel="stylesheet" href="public/css/purchase.css" type="text/css">
    <title>CONFIRM ORDER</title>
</head>

<body>
    <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
    <?php
            $cartItemService = new CartItemService();
            $allCartItems = $cartItemService->getAllCartItemsFormCart($userId);
            if (empty($allCartItems)) {
                echo "<div class='not-buy' style='text-align: center'>Không có sản phẩm để hiển thị</div>";
            } else { ?>
    <div class="container">
        <form method="post">
            <div class="col">
                <div class="row">
                    Thông tin nhận hàng
                    <a href="<?php echo  "/" . $path_project . "/" . "profile"?>">Chỉnh sửa</a>
                </div>
                <div><?php echo $user->getFullName()?></div>;
                <div><?php echo $user->getPhoneNumber()?></div>
                <div><?php echo $user->getAddress()?></div>
                <div class="row">
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
                                <div style="display: flex; flex-direction: row; justify-content: space-between;">
                                    <p style="margin-left: 0px;"><?php echo $product->getProductName() ?></p>
                                    <p id="cart-price">
                                        <?php echo number_format(($currentQuantity * $product->getPrice()), 0, '', ',') . " VND" ?>
                                    </p>
                                </div>
                                <div class="change-quantity">
                                    <input type="number" name="quantity[]" value="<?php echo $currentQuantity; ?>"
                                        max="<?php echo $product->getQuantity() ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <?php
                    } 
                    ?>
                    </div>
                </div>
            </div>
    </div>
    <div class="col">
        <p>Tổng số tiền sản phẩm:
            &emsp;<span><?php echo number_format($sum, 0, '', ',') . " VND" ?></span></p>
        <p>Phí giao hàng: 20000 VND</p>
        <p>Số tiền cần thanh toán: <?php echo number_format($sum+20000, 0, '', ',') . " VND" ?> </p>
        <div class="list-button">
            <button id="evaluate" type="submit" name="buy">
                Đặt hàng
            </button>
            <h4>Bằng cách đặt hàng, bạn đã đồng ý với <a href="<?php echo "/" . $path_project . "/" . "policy" ?>">
            Chính sách</a> của chúng tôi
        </h4>
        </div>
        </form>
    </div>
    <?php 
    }
 ?>
</body>