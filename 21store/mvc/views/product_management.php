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
            <div style="background-color: rgb(94, 117, 139);" class="main">
                <center>
                <img src="images/admin/pc.jpg" alt="" class="img-icon">
                <h1 style="color: white">Thương hiệu</h1>
                <div>
                    <button class="btn-icon" onclick="sc_brand()">Thêm thương hiệu</button>
                </div>
                <div>
                    <button class="btn-icon"  onclick="ql_brand()">Quản lý thương hiệu</button>
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
        <!--ADD-BRAND-->
        <div id='add_brand' style=" display: none;">
            <div style="display: flex; background-color: rgb(97, 182, 133); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <div style="width: 10%;">
                    <center><button class="btn-back" onclick="back_main()">&lt&lt&lt</button></center>
                </div>
                <div  style="width: 80%;">
                    <center><h2 style="color:white;">Thêm thương hiệu</h2></center>
                </div>
            </div>
            <div >
                <div id="" class="form-add" style="border-bottom-left-radius: 20px; border-bottom-right-radius: 20px; margin-bottom: 50px;">
                    <div>
                        <form action="">
                            <div style="float: left; width: 50%;">
                                <p class="form-left">Tên Thương hiệu</p>
                                <input class="form-left" type="number" id="brand-name">
                                <p class="form-left">Hình ảnh</p>
                                <input class="form-left" type="text" id="brand-img">
                            </div>
                        </form>
                        <center><button  class="submit" onclick="add_brand('brand-img')" style="width: 70%;">ADD</button></center>
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
                    <div style="float: left; width: 25%;">
                        <p class="form-left">Phân loại</p>
                        <input class="form-left" type="text" id="type-product-search">
                    </div>
                    <div style="float: left; width: 25%;">
                        <p class="form-left">Thương hiệu</p>
                        <select style="width:70%;" class="form-left" id="brand-search">
                            <option>Gucci</option>
                            <option>LV</option>
                            <option>Dolce</option>
                        </select>
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
      <!--CHI TIẾT THƯƠNG HIỆU -->
      <div id='ct_th' style=" display: none;">
        <div style="display: flex; background-color: rgb(97, 182, 133); border-top-left-radius: 20px; border-top-right-radius: 20px;">
            <div style="width: 10%;">
                <center><button class="btn-back" onclick="back_qlsp()">&lt&lt&lt</button></center>
            </div>
            <div  style="width: 80%;">
                <center><h2 style="color:white;">Chi tiết thương hiệu</h2></center>
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
                    <p style="margin: 20px; padding:0px; color:dodgerblue; font-size: 25px;">Tên thương hiệu</p>
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
    <script>
    // update sp
    function check_img(s){
        imgs=s.split(".");
        if(imgs[1]=='jpg' || imgs[1]=='png' || imgs[1]=='gif'|| imgs[1]=='tiff' || imgs[1]=='bmp'){
        return true;
        }
        return false;
    }
    function update(){
        var type = document.getElementById('type-search').value;
        var id = document.getElementById('edit_id').value;
        var name =document.getElementById('edit_name').value;
        var img =document.getElementById('edit_img2').value;
        var price =document.getElementById('edit_price').value;
        var size =document.getElementById('edit_size').value;
        var color =document.getElementById('edit_color').value;
        var quantity =document.getElementById('edit_quantity').value;
        var brand =document.getElementById('edit_brand').value;
        var material =document.getElementById('edit_material').value;
        var typeProduct =document.getElementById('edit_type').value;
        var description =document.getElementById('edit_des').value;

        var str="";
        if(id<=0){
            str+="productID must be greater than 0\n";
        }
        if(price<=0){
            str+="price must be greater than 0\n";
        }
        if(quantity<0){
            str+="(product number must be greater than 0 or equal to 0\n";
        }
        if(str!=""){
            alert(str);
            return;
        }
        var img_text;
        if(img==""){
            img_text=document.getElementById('edit_img1').src;
        }else{
            var imgs = img.split("\\");
            img_text='public/images/products/' +imgs[2];
            if(check_img(img_text)){
                upload_img('edit_img2');
            }else{
                alert("Wrong image format!");
                return;
            }
        }
        var str1= "type="+type+"&id="+id+"&name="+name+"&image_url="+img_text+"&price="+price+"&size="+size+
        "&color="+color+"&quantity="+quantity+"&material="+material+"&brand="+brand+"&product_type="+typeProduct+"&des="+description;
        var str2 =  "type="+type+"&id="+id+"&name="+name+"&image_url="+img_text;
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
            }
        };
        xhttp.open("POST", "library/admin/update.php", false);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        if(type == 1) xhttp.send(str1);
        else xhttp.send(str2);
        var id = document.getElementById('edit_id').style.border='none';
        var name =document.getElementById('edit_name').style.border='none';
        var img =document.getElementById('edit_img2').style.border='none';
        var price =document.getElementById('edit_price').style.border='none';
        var size =document.getElementById('edit_size').style.border='none';
        var color =document.getElementById('edit_color').style.border='none';
        var number =document.getElementById('edit_quantity').style.border='none';
        var brand =document.getElementById('edit_brand').style.border='none';
        var typeProduct =document.getElementById('edit_type').style.border='none';
        var description =document.getElementById('edit_des').style.border='none';
        sc_ct_sp(document.getElementById('edit_id').value);
    }
    // cho phép sửa trong chi tiết sp
    function edit(x){
        document.getElementById(x).removeAttribute("disabled");
        document.getElementById(x).style.border='red solid 3px';
    }
    // product
    function sc_product(){
        var div_main = document.getElementById('main');
        var div_add_product=document.getElementById('add_product');
        div_main.style.display='none';
        div_add_product.style.display='inherit';
    }
    //brand
    function sc_brand(){
        var div_main = document.getElementById('main');
        var div_add_brand=document.getElementById('add_brand');
        div_main.style.display='none';
        div_add_brand.style.display='inherit';
    }
    // quay lại main
    function back_main(){
        var div_main = document.getElementById('main');
        var div_add_product=document.getElementById('add_product');
        var div_add_brand=document.getElementById('add_brand');
        var ql_sp=document.getElementById('ql_sp');
        div_main.style.display='flex';
        div_add_product.style.display='none';
        div_add_brand.style.display='none';
        ql_sp.style.display='none';
    }
    // quản lý product
    function ql_product(){
        var div_main = document.getElementById('main');
        var ql_sp=document.getElementById('ql_sp');
        var type=document.getElementById('type-search');
        var text=document.getElementById('ql_sp_text');
        type.value='1';
        text.innerHTML="Quản lý sản phẩm";
        div_main.style.display='none';
        ql_sp.style.display='inherit';
        get_data_search();
    }
    // quản lý brand
    function ql_brand(){
        var div_main = document.getElementById('main');
        var ql_sp=document.getElementById('ql_sp');
        var type=document.getElementById('type-search');
        var text=document.getElementById('ql_sp_text');
        type.value='2';
        text.innerHTML="Quản lý thương hiệu";
        div_main.style.display='none';
        ql_sp.style.display='inherit';
        get_data_search();
    }

    // post data
    function funcPOST(url, cFunction) {
        var xhttp;
        var str=cFunction();
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                if(this.responseText=="Add success!") {
                    remove_add_product();
                    remove_add_brand();
                }
            }
        };
        xhttp.open("POST", url, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send(str);
    }
    function get_data_search(){
        var type=document.getElementById('type-search').value;
        var name = document.getElementById('name-search').value;
        var brandName = document.getElementById('brand-search').value;
        var productType = document.getElementById('type-product-search').value;
        var str = "?type="+type+"&productName="+name+"&brandName="+brandName+"&productType="+productType;
        var xhttp;
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById('display_s').innerHTML=this.responseText;
        }
        };
        xhttp.open("GET", "library/admin/getDataSearch.php"+str, false);
        xhttp.send();
    }
    // xóa sp theo id
    function delete_by_id(x){
        var id = x.value;
        if(confirm("Are you sure you want to delete?")==true){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                    var type=document.getElementById('type-search').value;
                    if(value=='1'){
                        ql_product();
                    }
                    if(value=='2'){
                        ql_brand();
                    }

                }
            };
            xhttp.open("GET","library/admin/deleteProduct.php?id="+id, false);
            xhttp.send();
        }
        get_data_search();
    }
    // chi tiết sp
    function sc_ct_sp(x){
        var id = x;
        document.getElementById('ql_sp').style.display='none';

        var type = document.getElementById('type-search').value;
        if(type=='1'){
            document.getElementById('ct_sp').style.display='flex';
        }
        if(type=='2'){
            document.getElementById('ct_th').style.display='flex';
        }
    
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var s = this.responseText.split("&");
                document.getElementById('edit_id').value=s[0];
                document.getElementById('edit_name').value=s[1];
                document.getElementById('edit_img1').src=s[2];
                document.getElementById('edit_img1').value=s[2];
                document.getElementById('edit_price').value=s[3];
                document.getElementById('edit_size').value=s[4];
                document.getElementById('edit_color').value=s[5];
                document.getElementById('edit_quantity').value=s[6];
                document.getElementById('edit_type').value=s[7];
                document.getElementById('edit_brand').value=s[8];
                document.getElementById('edit_material').value=s[9];
                document.getElementById('edit_des').value=s[10];
                
            }
        };
        xhttp.open("GET","library/admin/getById.php?id="+id+'&type='+type, true);
        xhttp.send();
    }
    // quay lại trang quản lý sp
    function back_qlsp(){
        document.getElementById('ql_sp').style.display='inherit';
        document.getElementById('ct_sp').style.display='none';
        get_data_search();
    }

    function get_value_add_product() {
        var name = document.getElementById('pd-name').value;
        var img = document.getElementById('pd-img').value;
        var price = document.getElementById('pd-price').value;
        var size = document.getElementById('pd-size').value;
        var color = document.getElementById('pd-color').value;
        var number= document.getElementById('pd-quantity').value;
        var brand = document.getElementById('pd-brand').value;
        var des = document.getElementById('pd-des').value;
        var material = document.getElementById('pd-material').value;
        var type = document.getElementById('pd-type').value;
        var imgs = img.split("\\");
        var img_text=imgs[2];
        //$productName,$productDescription, $price, $image_url, $size, $color, $material, $brand_id, $product_type, $quantity
        var str="&productName="+name+
        "&productDescription="+des+
        "&price="+price+
        "&image_url="+img_text+
        "&size="+size+
        "&color="+color+
        "&material="+material+
        "&brand_id="+brand+
        "&product_type="+type+
        "&quantity="+number;
        return str;
    }
    function add_product(id_element) {
        str = check_add_product();
        if(str!=""){
            alert(str);
            return;
        }
        var img =document.getElementById('pd-img').value;
        var imgs = img.split("\\");
        var img_text=imgs[2];
        if(check_img(img_text)){
            upload_img(id_element);
        }else{
            alert("Wrong image format!");
            return;
        }

        funcPOST("library/admin/addProduct.php", get_value_add_product);
    }
    function check_add_product(){
        var name = document.getElementById('pd-name').value;
        var img = document.getElementById('pd-img').value;
        var price = document.getElementById('pd-price').value;
        var size = document.getElementById('pd-size').value;
        var color = document.getElementById('pd-color').value;
        var number= document.getElementById('pd-quantity').value;
        var brand = document.getElementById('pd-brand').value;
        var des = document.getElementById('pd-des').value;
        var material = document.getElementById('pd-material').value;
        var type = document.getElementById('pd-type').value;
        var str="";
        if(name=="" || number=="" || price=="" || size=="" || color=="" || type=="" || brand=="" || material==""
        || des=="" || img ==""){
            str+= "Fields cannot be null!";
        }else{
            if(size<=0){
                str+="size must be greater than 0\n";
            }
            if(price<=0){
                str+="price must be greater than 0\n";
            }
            if(number<0){
                str+="(numOfProduct must be greater than 0 or equal to 0\n";
            }
        }
        return str;
    }
    function remove_add_product(){
        document.getElementById('pd-name').value="";
        document.getElementById('pd-img').value="";
        document.getElementById('pd-price').value="";
        document.getElementById('pd-size').value="";
        document.getElementById('pd-color').value="";
        document.getElementById('pd-quantity').value="";
        document.getElementById('pd-brand').value="";
        document.getElementById('pd-des').value="";
        document.getElementById('pd-material').value="";
        document.getElementById('pd-type').value="";
    }
    // ADD brand
    function get_value_add_brand() {
        var name=document.getElementById('brand-name').value;
        var img =document.getElementById('brand-img').value;
        var imgs = img.split("\\");
        var img_text=imgs[2];
        var str="producName="+name+
        "&brandImg="+img_texl;
        return str;
    }
    function add_brand(id_element) {
        str = check_add_brand();
        if(str!=""){
            alert(str);
            return;
        }
        var img =document.getElementById('brand-img').value;
        var imgs = img.split("\\");
        var img_text=imgs[2];
        if(check_img(img_text)){
            upload_img(id_element);
        }else{
            alert("Wrong image format!");
            return;
        }
        funcPOST("library/admin/addBrand.php", get_value_add_brand);
    }
    function check_add_brand(){
        var name=document.getElementById('brand-name').value;
        var img =document.getElementById('brand-img').value;
        var str="";
        if(name=="" || img ==""){
            str+= "Fields cannot be null!";
        }
        return str;
    }
    function remove_add_brand(){
    document.getElementById('brand-name').value="";
    document.getElementById('brand-img').value="";
    }
    
    // UPLOAD IMAGE
    function upload_img(id_element){
                let photo = document.getElementById(id_element).files[0];
                let formData = new FormData();
                formData.append("file", photo);
                fetch('library/admin/uploadImg.php', {method: "POST", body: formData});
            }
    </script>
</body>
</html>
