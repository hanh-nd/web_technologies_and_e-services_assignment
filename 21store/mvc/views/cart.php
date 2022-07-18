<?php
require_once ROOT . DS . 'services' . DS . 'CartItemService.php';
require_once ROOT . DS . 'services' . DS . 'CartService.php';
require_once ROOT . DS . 'services' . DS . 'ProductService.php';

$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
$url_components = parse_url($url);
$userId = $_COOKIE['userId'];
if (isset($url_components['query'])) {
    parse_str($url_components['query'], $params);
}

?>

<?php
$cartItemService = new CartItemService();
$productService = new ProductService();
$allCartItems = $cartItemService-> getAllCartItemsFormCart($userId);

if (isset ($_POST['quantity'])) {
    foreach ($allCartItems as $index=>$cartItem) {
        if ($cartItem->getQuantity() != $_POST['quantity'][$index]) {
            $cartItemService->updateQuantity($cartItem->getId(), $_POST['quantity'][$index]);
        }
    }
} else if (isset ($_POST['decrease'])){
    $cartItemService->update($_POST['decrease'][0], false);
} else if (isset ($_POST['increase'])){
    $cartItemService->update($_POST['increase'][0], true);
} 
if (isset ($_POST['buy'])){
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
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/footer.css" type="text/css">
    <link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
    <link rel="stylesheet" href="public/css/detail.css" type="text/css">
    <title>Detail</title>
</head>

<body>
    <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
    <div class="detail-container">

        <h1>GIỎ HÀNG CỦA BẠN</h1>
        <?php 
        if (empty($allCartItems)){
        echo "<div class='not-buy'>Không có sản phẩm để hiển thị</div>";
    }
        ?>
        <form method="post">
            <table id="cart-table">
                <tbody>
                    <tr>
                        <th></th>
                        <th>Sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                    <?php

        $sum  = 0;
        $allCartItems = $cartItemService-> getAllCartItemsFormCart($userId);
        foreach($allCartItems as $item){
            $productId = $item -> getProductId();
            $product = $productService->getProduct($productId);
            $id = $item -> getId();
            $currentQuantity = $item->getQuantity();
            $sum = $sum + $currentQuantity * $product->getPrice();
        ?>
                    <tr>
                        <td><img src=<?php echo $product->getImageUrl(); ?> /></td>
                        <td><?php echo $product->getProductName() ?></td>
                        <td>
                            
                            <button onclick="" type="submit" name="decrease[]" value='<?php echo $id?>'>-</button>
                            <input type="number" name="quantity[]" value="<?php echo$currentQuantity; ?>" />
                            <input type="submit" name="quantity[]" hidden/>
                            <button onclick="" type="submit" name="increase[]" value='<?php echo $id?>' >+</button>
                        </td>
                        <td><?php echo ($currentQuantity * $product -> getPrice())?></td>
                    </tr>
                    <?php
        }
?>
                </tbody>
            </table>
            TỔNG: <label name = "totalAmount"><?php echo $sum?></label>
            <input type="submit" value = "Đặt hàng" name="buy"></input>
        </form>
    </div>


</body>

<script type="text/javascript" src="public/javascript/cart.js"></script>