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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="public/css/admin/product_management.css">
        <script src="public/javascript/admin/product_management.js"></script>
    </head>
<body>
    <div>
        <div style="float: left; width: 20%; height: 150px;">
            <center><img src="images/admin/admin.jpg" alt="" width="50%" height="100%"></center>
        </div>
        <div style="width: 80%; height: 150px;">
            <center><h1 style="color: rgb(50, 158, 98); padding: 20px;">Quản lý sản phẩm</h1></center>
        </div>
    </div>
    <div id="main" style="display: flex;">
        <div style="background-color: rgb(212, 188, 109);" class="main">
            <center>
            <img src="images/admin/laptop.jpg" alt="" class="img-icon">
            <h1 style="color: white">Sản phẩm</h1>
            <div>
                <button class="btn-icon" onclick="sc_product()">Thêm sản phẩm</button>
            </div>
            <div>
                <button class="btn-icon" onclick="ql_product()">Quản lý sản phẩm</button>
            </div>
            </center>
        </div>
    </div>
    <!--ADD-PRODUCT-->
    <div id='add_product' style=" display: none;">
        <div style="display: flex; background-color: rgb(97, 182, 133); border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <div style="width: 10%;">
                <center><button class="btn-back" onclick="back_main()">&lt&lt&lt</button></center>
            </div>
            <div  style="width: 80%;">
                <center><h2 style="color:white;">Thêm sản phẩm</h2></center>
            </div>
        </div>
        <div >
            <div id="" class="form-add" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; margin-bottom: 50px;">
                <div class="form" id="form">
                    <form action="">
                    <!-- product_name, product_description, price, image_url, size, color, material, brand_id, product_type, quantity -->
                        <div style="float: left; width: 50%;">
                            <p class="form-left p-add">Tên sản phẩm</p>
                            <input class="form-left" type="text" id="pd-name">
                            <p class="form-left">Size</p>
                            <input class="form-left" type="text" id="pd-size">
                            <p class="form-left" >Màu sắc</p>
                            <input class="form-left" type="text" id="pd-color">
                            <p class="form-left">Chất liệu</p>
                            <input class="form-left" type="text" id="pd-material">
                            <p class="form-left">Số lượng</p>
                            <input class="form-left" type="number" id="pd-quantity">
                            <p class="form-left">Phân loại</p>
                            <input class="form-left" type="text" id="pd-type">
                        </div>
                        <div style="float: left; width: 50%;">
                            <p class="form-left">Giá</p>
                            <input class="form-left" type="number" id="pd-price">
                            <p class="form-left">Brand</p>
                            <input class="form-left" type="text" id="pd-brand">
                            <p class="form-left">Hình ảnh</p>
                            <input style="margin-left: 20px;" type="file" id="pd-img">
                            <p class="form-left">Miêu tả về sản phẩm</p>
                            <textarea cols="70" rows="20" id="pd-des"></textarea>
                        </div>
                        <!--center><input type="submit" class="submit" value="ADD" onclick="lt_add()"></center>-->
                    </form>
                    <center><button  class="submit" onclick="add_product('pd-img')" style="width: 70%;">Thêm</button></center>
                </div>
            </div>
        </div>
    </div>
    

    <!--Tìm kiếm sản phẩm-->
    <div id='ql_sp' style=" display: none;">
        <div style="display: flex; background-color: rgb(97, 182, 133); border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <div style="width: 10%;">
                <center><button class="btn-back" onclick="back_main()">&lt&lt&lt</button></center>
            </div>
            <div  style="width: 80%;">
                <center><h2 style="color:white;" id="ql_sp_text"></h2></center>
            </div>
        </div>
        <div class="form-add">
            <form action="">
                <input type="text" id="type-search" style="display: none;">
                <div style="float: left; width: 25%;">
                    <p class="form-left">Tên sản phẩm</p>
                    <input class="form-left" type="text" id="name-search">
                </div>
                <div style="float: left; width: 10%;">
                    <button  class="submit" onclick="get_data_search()" style="width: 70%;" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
                </div>
            </form>
        </div>
        <div class="" id="display_s">
    </div>
</div>


    <!--CHI TIẾT SẢN PHẨM -->
    <div id='ct_sp' style=" display: none;">
        <div style="display: flex; background-color: rgb(97, 182, 133); border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <div style="width: 10%;">
                <center><button class="btn-back" onclick="back_qlsp()">&lt&lt&lt</button></center>
            </div>
            <div  style="width: 80%;">
                <center><h2 style="color:white;">Chi tiết sản phẩm</h2></center>
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
</body>
    <script type="text/javascript" src=<?php echo "/" . $path_project . "/" . "public/js/product_management.js"?>></script>


