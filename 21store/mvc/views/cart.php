<?php
require_once ROOT . DS . 'services' . DS . 'CartItemService.php';

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
        <table>
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
        $allCartItems = $cartItemService-> getAllCartItemsFormCart($userId);
        foreach($allCartItems as $item){
            $product = $item -> getProduct();
        ?>
                <tr>
                    <td><img src=<?php $product->getImageUrl(); ?> /></td>
                    <td><?php $product->getProductName() ?></td>
                    <td>
                        <input value = <?php $item->getQuantity()?>/>
                    </td>
                    <td><?php $item -> getQuantity() * $product -> getPrice()?></td>
                </tr>
                <?php
        }
?>
            </tbody>
        </table>
        <button type="button">Đặt hàng</button>
    </div>


</body>

<script type="text/javascript" src = "public/javascript/cart.js"></script>
