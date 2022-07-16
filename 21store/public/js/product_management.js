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
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xhttp.open("POST", "library/admin/Update.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(str1);

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
    sc_ct(document.getElementById('edit_id').value);
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
    var str = "?type="+type+"&productName="+name;
    var xhttp;
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById('display_s').innerHTML=this.responseText;
    }
    };
    xhttp.open("GET", "library/admin/Search.php"+str, false);
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
                ql_product();
            }
        };
        xhttp.open("GET","library/admin/Delete.php?id="+id, false);
        xhttp.send();
    }
    get_data_search();
}
// chi tiết sp
function sc_ct(x){
    var id = x;
    document.getElementById('ql_sp').style.display='none';
    document.getElementById('ct_sp').style.display='flex';
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
    xhttp.open("GET","library/admin/GetData.php?id="+id, true);
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

    funcPOST("library/admin/Insert.php", get_value_add_product);
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
// UPLOAD IMAGE
function upload_img(id_element){
            let photo = document.getElementById(id_element).files[0];
            let formData = new FormData();
            formData.append("file", photo);
            fetch('library/admin/SaveImage.php', {method: "POST", body: formData});
        }