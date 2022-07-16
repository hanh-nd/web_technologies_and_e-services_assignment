<?php
require_once ROOT . DS . 'services' . DS . 'CartItemService.php';
require_once ROOT . DS . 'services' . DS . 'CartService.php';
require_once ROOT . DS . 'services' . DS . 'ProductService.php';

$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
$url_components = parse_url($url);
$userId = $_COOKIE['userId'];
if (isset($url_components['query'])) {
    parse_str($url_components['query'], $params);
    if (isset($params['product_id'])) {
        $product_id = $params['product_id'];
    }
    if (isset($params['quantity'])) {
        $quantity = $params['quantity'];
    }
}
$cartService = new CartService();
$cartSession = $cartService->getCartSessionByUserId($userId);
$cartItemService = new CartItemService();
$cartItemService->insert($cartSession->getId(), $product_id, $quantity);
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
        $cartItemService = new CartItemService();
        $productService = new ProductService();
        $allCartItems = $cartItemService-> getAllCartItemsFormCart($userId);
        foreach($allCartItems as $item){
            $productId = $item -> getProductId();
            $product = $productService->getProduct($productId);
            print_r($product);
        ?>
                    <tr>
                        <td><img src=<?php echo $product->getImageUrl(); ?> /></td>
                        <td><?php echo $product->getProductName() ?></td>
                        <td>
                            <?php $currentQuantity = $item->getQuantity();
                        ?>
                            <button onclick="<?php $currentQuantity = $currentQuantity +1 ?>">+</button>
                            <?php echo $currentQuantity; ?>
                            <button onclick="<?php $currentQuantity = $currentQuantity -1 ?>">-</button>
                        </td>
                        <td><?php echo ($currentQuantity * $product -> getPrice())?></td>
                    </tr>
                    <?php
        }
?>
                </tbody>
            </table>
            <input type="submit" value = "Đặt hàng"></input>
        </form>
    </div>


</body>

<script type="text/javascript" src="public/javascript/cart.js"></script>