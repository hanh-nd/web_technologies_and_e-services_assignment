<?php
    global $path_project;
    require_once ROOT . DS . 'services' . DS . 'BrandService.php';
	require_once ROOT . DS . 'services' . DS . 'ProductService.php';
    $service = new ProductService();
    $products = $service->getPaginatedProducts(1, 1000);

    if (array_key_exists("exportProduct", $_POST)) {
        $list = array(array("ID", "Product Name", "Price", "Size", "Color", "Quantity", "Type", "Brand", "Material", "Description"));
        $fp = fopen("data.csv", 'w');
        fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
    
        foreach($products as $product) {
            $_id = $product->getId();
            $_productName = $product->getProductName();
            $_price = $product->getFormattedPrice();
            $_size = $product->getSize();
            $_color = $product->getColor();
            $_quantity = $product->getQuantity();
            $_type = $product->getProductType();
            $_brand = $product->getBrandName();
            $_material = $product->getMaterial();
            $_description = $product->getProductDescription();
    
            $productArray = array("$_id", "$_productName", "$_price", "$_size", "$_color", "$_quantity", "$_type", "$_brand", "$_material", "$_description");
            array_push($list, $productArray);
        }
    
        foreach($list as $fields) {
            fputcsv($fp, $fields);
        }
    
        fclose($fp);
        header("Location: data.csv");
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm | 21store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/product_management.css">
    <link rel="stylesheet" href="public/css/admin.css">
    <link rel="stylesheet" href="public/css/add_product.css">
</head>

<body>
    <div class="wrapper">
        <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'admin.php'; ?>
        <div class="content">
            <div class="form__header">
                <h1 class="form__title">Quản lý sản phẩm | Danh sách sản phẩm </h1>
            </div>
            <div class="divider"></div>
            <div id="main">    
                <!--Tìm kiếm sản phẩm-->
                <div id='ql_sp'>
                    <div class="form__search">
                        <form action="">
                            <input type="text" id="type-search" style="display: none;">
                            <label class="form-left">Tên sản phẩm</label><br>
                            <input class="form-left" type="text" id="name-search">
                            <button class="submit button" onclick="get_data_search()"  type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </form>
                        <form method="post">
                            <button type="submit" class="button" name="exportProduct">Export Product</button>
                        </form>
                    </div>
                    <div class="product-list" id="display_s"></div>
                </div>
                    
                <!--CHI TIẾT SẢN PHẨM -->
                <div id='ct_sp' style="display: none;">
                    <div class="detail-title">
                        <button class="button" onclick="back_qlsp()">Trở về</button>
                        <h4 class="detail-title__text">Chi tiết sản phẩm</h4>
                    </div>
                    <div class="divider"></div>
                    <div class="detail-product__wrapper">
                        <div class="detail-product">
                            <div class="section left">
                                <div>
                                    <label>ID(not edit)</label><br>
                                    <input disabled="" type="number" value="" id="edit_id">
                                    <button class="button" value="edit_id" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div >
                                    <label>Tên sản phẩm</label><br>
                                    <input disabled="" type="text" value="" id="edit_name" >
                                    <button class="button" onclick="edit(this.value)" value="edit_name" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div>
                                    <label>Giá</label><br>
                                    <input disabled="" type="number" value="" id="edit_price" >
                                    <button class="button" onclick="edit(this.value)" value="edit_price" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div>
                                    <label>Size</label><br>
                                    <input disabled="" type="text" value="" id="edit_size" >
                                    <button class="button" onclick="edit(this.value)" value="edit_size" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div >
                                    <label>Màu sắc</label><br>
                                    <input disabled="" type="text" value="" id="edit_color">
                                    <button class="button" onclick="edit(this.value)" value="edit_color" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div >
                                    <label>Số lượng</label><br>
                                    <input disabled="" type="number" value="" id="edit_quantity" >
                                    <button class="button" onclick="edit(this.value)" value="edit_quantity" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div >
                                    <label>Phân loại</label><br>
                                    <input disabled="" type="text" value="" id="edit_type" >
                                    <button class="button" onclick="edit(this.value)" value="edit_type" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div >
                                    <label>Thương hiệu</label><br>
                                    <select disabled="" id="edit_brand">
                                        <?php
                                            $service = new BrandService();
                                            $brands = $service->getAllBrands();
                                            foreach($brands as $brand) {
                                        ?>
                                        <option id="<?php echo $brand->getId()?>" value="<?php echo $brand->getId()?>"> <?php echo $brand->getBrandName() ?></option>
                                        <?php
                                            }
                                        ?>	
                                    </select>
                                    <button class="button" onclick="edit(this.value)" value="edit_brand" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                                <div >
                                    <label>Chất liệu</label><br>
                                    <input disabled="" type="text" value="" id="edit_material" >
                                    <button class="button" onclick="edit(this.value)" value="edit_material" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                </div>
                            </div>

                            <div class="section right">
                                <div>
                                    <label>Description</label><br>
                                    <div class="textarea-wrapper">
                                        <textarea rows="9" id="edit_des"></textarea>
                                        <button class="button" onclick="edit(this.value)" value="edit_des" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                                <div>
                                    <label>Hình ảnh</label><br>
                                    <img src="" alt="anh" width="100%" id="edit_img1">
                                    <input type="file" id="edit_img2">
                                </div>
                            </div>
                        </div>
                        <button class="button update" type="button" onclick="update()"  class="submit">Cập nhật</button>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" src=<?php echo "/" . $path_project . "/" . "public/js/product_management.js" ?>></script>
