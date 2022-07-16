<?php
global $path_project;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm | 21store</title>
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
            <div id="main">       
                <!--Tìm kiếm sản phẩm-->
                <div id='ql_sp'>
                    <div style="display: flex; background-color: rgb(97, 182, 133); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                        <div style="width: 10%;">
                            <center><button class="btn-back" onclick="back_main()">&lt&lt&lt</button></center>
                        </div>
                        <div style="width: 80%;">
                            <center>
                                <h2 style="color:white;" id="ql_sp_text"></h2>
                            </center>
                        </div>
                    </div>
                    <div class="form-add">
                        <form action="">
                            <input type="text" id="type-search">
                            <div style="float: left; width: 25%;">
                                <p class="form-left">Tên sản phẩm</p>
                                <input class="form-left" type="text" id="name-search">
                            </div>
                            <div style="float: left; width: 10%;">
                                <button class="submit" onclick="get_data_search()" style="width: 70%;" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                    <div class="" id="display_s"></div>
                </div>
                    
                    
                <!--CHI TIẾT SẢN PHẨM -->
                <div id='ct_sp' style="display: none;">
                    <div style="display: flex; background-color: rgb(97, 182, 133); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                        <div style="width: 10%;">
                            <center><button class="btn-back" onclick="back_qlsp()">&lt&lt&lt</button></center>
                        </div>
                        <div style="width: 80%;">
                            <center>
                                <h2 style="color:white;">Chi tiết sản phẩm</h2>
                            </center>
                        </div>
                    </div>
                    <div>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">ID(not edit)</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="number" value="" id="edit_id" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" value="edit_id" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Tên sản phẩm</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="text" value="" id="edit_name" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_name" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Giá</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="number" value="" id="edit_price" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_price" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Size</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="text" value="" id="edit_size" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_size" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Màu sắc</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="text" value="" id="edit_color" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_color" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Số lượng</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="number" value="" id="edit_quantity" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_quantity" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Phân loại</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="text" value="" id="edit_type" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_type" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Thương hiệu</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="text" value="" id="edit_brand" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_brand" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Chất liệu</p>
                            </div>
                            <div style="width:40%;">
                                <input disabled="" type="text" value="" id="edit_material" style="margin: 20px; font-size: 25px; border: none;  border-radius: 5px; color:dodgerblue;">
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_material" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Description</p>
                            </div>
                            <div style="width:40%;">
                                <textarea cols="60" rows="10" id="edit_des"></textarea>
                            </div>
                            <div style="width:10%;">
                                <button style="margin: 20px; font-size: 25px;" onclick="edit(this.value)" value="edit_des" type="button"><i class="fa fa-pencil" aria-hidden="true"></i></button>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex;">
                            <div style="width:50%;">
                                <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Hình ảnh</p>
                            </div>
                            <div style="width:30%;">
                                <img src="" alt="anh" width="70%" id="edit_img1">
                            </div>
                            <div style="width:20%;">
                                <input type="file" id="edit_img2">
                            </div>
                        </div>
                        <hr>
                        <center><button type="button" onclick="update()" style="width: 70%;" class="submit">Cập nhật</button></center>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script type="text/javascript" src=<?php echo "/" . $path_project . "/" . "public/js/product_management.js" ?>></script>
