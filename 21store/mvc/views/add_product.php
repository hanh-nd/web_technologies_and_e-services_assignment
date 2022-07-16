<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/account_management.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/admin.css">
    <link rel="stylesheet" href="public/css/add_product.css">
    <title>Thêm sản phẩm | 21store</title>

</head>

<body>
    <div class="wrapper">
        <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'admin.php'; ?>
        <div id='add_product' class="content">
            <div class="form__header">
                <h1 class="form__title">Quản lý sản phẩm | Thêm sản phẩm</h1>
            </div>
            <div class="divider"></div>
            <div class="form__add" >
                <div class="form" id="form">
                    <form action="" class="form-content">
                        <div class="section left">
                            <label class="form-left p-add">Tên sản phẩm</label><br>
                            <input class="form-left" type="text" id="pd-name"><br>
                            <label class="form-left">Size</label><br>
                            <input class="form-left" type="text" id="pd-size"><br>
                            <label class="form-left">Màu sắc</label><br>
                            <input class="form-left" type="text" id="pd-color"><br>
                            <label class="form-left">Chất liệu</label><br>
                            <input class="form-left" type="text" id="pd-material"><br>
                            <label class="form-left">Số lượng</label><br>
                            <input class="form-left" type="number" id="pd-quantity"><br>
                            <label class="form-left">Phân loại</label><br>
                            <input class="form-left" type="text" id="pd-type"><br>
                        </div>
                        <div class="section right">
                            <label class="form-left">Giá</label><br>
                            <input class="form-left" type="number" id="pd-price"><br>
                            <label class="form-left">Brand</label><br>
                            <input class="form-left" type="text" id="pd-brand"><br>
                            <label class="form-left">Hình ảnh</label><br>
                            <input type="file" id="pd-img"><br>
                            <label class="form-left">Miêu tả về sản phẩm</label><br>
                            <textarea id="pd-des"></textarea><br>
                        </div>
                    </form>
                    <button class="submit-btn" onclick="add_product('pd-img')" >Thêm</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src=<?php echo "/" . $path_project . "/" . "public/js/product_management.js" ?>></script>
</body>

</html>