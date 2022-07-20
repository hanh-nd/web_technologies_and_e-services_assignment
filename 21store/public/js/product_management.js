function check_img(s) {
    extension = s.split(".").pop();
    if (extension == "jpg" || extension == "png" || extension == "gif" || extension == "tiff" || extension == "bmp") {
        return true;
    }
    return false;
}
function update() {
    const type = document.getElementById("type-search").value;
    const id = document.getElementById("edit_id").value;
    const name = document.getElementById("edit_name").value;
    const img = document.getElementById("edit_img2").value;
    const price = document.getElementById("edit_price").value;
    const size = document.getElementById("edit_size").value;
    const color = document.getElementById("edit_color").value;
    const quantity = document.getElementById("edit_quantity").value;
    const brandId = document.getElementById("edit_brand").value;
    const material = document.getElementById("edit_material").value;
    const typeProduct = document.getElementById("edit_type").value;
    const description = document.getElementById("edit_des").value;

    const str = "";
    if (id <= 0) {
        str += "productID must be greater than 0\n";
    }
    if (price <= 0) {
        str += "price must be greater than 0\n";
    }
    if (quantity < 0) {
        str += "(product number must be greater than 0 or equal to 0\n";
    }
    if (str != "") {
        alert(str);
        return;
    }
    let img_text;
    if (img == "") {
        img_text = document.getElementById("edit_img1").src;
    } else {
        const imgs = img.split("\\");
        img_text = "public/images/products/" + imgs[2];
        if (check_img(img_text)) {
            upload_img("edit_img2");
        } else {
            alert("Wrong image format!");
            return;
        }
    }
    const str1 =
        "type=" +
        type +
        "&id=" +
        id +
        "&name=" +
        name +
        "&image_url=" +
        img_text +
        "&price=" +
        price +
        "&size=" +
        size +
        "&color=" +
        color +
        "&quantity=" +
        quantity +
        "&material=" +
        material +
        "&brand_id=" +
        brandId +
        "&product_type=" +
        typeProduct +
        "&des=" +
        description;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
        }
    };
    xhttp.open("POST", "library/admin/Update.php", false);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(str1);

    document.getElementById("edit_id").style.outline = "none";
    document.getElementById("edit_name").style.outline = "none";
    document.getElementById("edit_img2").style.outline = "none";
    document.getElementById("edit_price").style.outline = "none";
    document.getElementById("edit_size").style.outline = "none";
    document.getElementById("edit_color").style.outline = "none";
    document.getElementById("edit_quantity").style.outline = "none";
    document.getElementById("edit_brand").style.outline = "none";
    document.getElementById("edit_type").style.outline = "none";
    document.getElementById("edit_des").style.outline = "none";
    sc_ct(document.getElementById("edit_id").value);
}
// cho phép sửa trong chi tiết sp
function edit(x) {
    document.getElementById(x).removeAttribute("disabled");
    document.getElementById(x).style.outline = "red solid 3px";
}
// product
function sc_product() {
    const div_main = document.getElementById("main");
    const div_add_product = document.getElementById("add_product");
    div_main.style.display = "none";
    div_add_product.style.display = "inherit";
}

// quản lý product
function ql_product() {
    const div_main = document.getElementById("main");
    const ql_sp = document.getElementById("ql_sp");
    const type = document.getElementById("type-search");
    const text = document.getElementById("ql_sp_text");
    type.value = "1";
    text.innerHTML = "Quản lý sản phẩm";
    div_main.style.display = "none";
    ql_sp.style.display = "inherit";
    get_data_search();
}

// post data
function funcPOST(url, cFunction) {
    const str = cFunction();
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            alert(this.responseText);
            if (this.responseText == "Add success!") {
                remove_add_product();
                remove_add_brand();
            }
        }
    };
    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(str);
}
function get_data_search() {
    const type = document.getElementById("type-search")?.value || -1;
    const name = document.getElementById("name-search")?.value || "";
    const str = "?type=" + type + "&productName=" + name;
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            if (document.getElementById("display_s")) {
                document.getElementById("display_s").innerHTML = this.responseText;
            }
        }
    };
    xhttp.open("GET", "library/admin/Search.php" + str, false);
    xhttp.send();
}
get_data_search();

// xóa sp theo id
function delete_by_id(x) {
    const id = x.value;
    if (confirm("Are you sure you want to delete?") == true) {
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                alert(this.responseText);
                ql_product();
            }
        };
        xhttp.open("GET", "library/admin/Delete.php?id=" + id, false);
        xhttp.send();
    }
    get_data_search();
}
// chi tiết sp
function sc_ct(x) {
    const id = x;
    document.getElementById("ql_sp").style.display = "none";
    document.getElementById("ct_sp").style.display = "unset";
    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const s = this.responseText.split("&");
            document.getElementById("edit_id").value = id;
            document.getElementById("edit_name").value = s[1];
            document.getElementById("edit_img1").src = s[2];
            document.getElementById("edit_img1").value = s[2];
            document.getElementById("edit_price").value = s[3];
            document.getElementById("edit_size").value = s[4];
            document.getElementById("edit_color").value = s[5];
            document.getElementById("edit_quantity").value = s[6];
            document.getElementById("edit_type").value = s[7];
            document.getElementById("edit_brand").value = s[8];
            document.getElementById("edit_material").value = s[9];
            document.getElementById("edit_des").value = s[10];
        }
    };
    xhttp.open("GET", "library/admin/GetData.php?id=" + id, true);
    xhttp.send();
}
// quay lại trang quản lý sp
function back_qlsp() {
    document.getElementById("ql_sp").style.display = "inherit";
    document.getElementById("ct_sp").style.display = "none";
    get_data_search();
}

function get_value_add_product() {
    const name = document.getElementById("pd-name").value;
    const img = document.getElementById("pd-img").value;
    const price = document.getElementById("pd-price").value;
    const size = document.getElementById("pd-size").value;
    const color = document.getElementById("pd-color").value;
    const number = document.getElementById("pd-quantity").value;
    const brandId = document.getElementById("pd-brand").value;
    const des = document.getElementById("pd-des").value;
    const material = document.getElementById("pd-material").value;
    const type = document.getElementById("pd-type").value;
    const imgs = img.split("\\");
    const img_text = imgs[2];
    //$productName,$productDescription, $price, $image_url, $size, $color, $material, $brand_id, $product_type, $quantity
    const str =
        "&productName=" +
        name +
        "&productDescription=" +
        des +
        "&price=" +
        price +
        "&image_url=" +
        img_text +
        "&size=" +
        size +
        "&color=" +
        color +
        "&material=" +
        material +
        "&brand_id=" +
        brandId +
        "&product_type=" +
        type +
        "&quantity=" +
        number;
    return str;
}
function add_product(id_element) {
    str = check_add_product();
    if (str != "") {
        alert(str);
        return;
    }
    const img = document.getElementById("pd-img").value;
    const imgs = img.split("\\");
    const img_text = imgs[2];
    if (check_img(img_text)) {
        upload_img(id_element);
    } else {
        alert("Wrong image format!");
        return;
    }

    funcPOST("library/admin/Insert.php", get_value_add_product);
}
function check_add_product() {
    const name = document.getElementById("pd-name").value;
    const img = document.getElementById("pd-img").value;
    const price = document.getElementById("pd-price").value;
    const size = document.getElementById("pd-size").value;
    const color = document.getElementById("pd-color").value;
    const number = document.getElementById("pd-quantity").value;
    const brandId = document.getElementById("pd-brand").value;
    const des = document.getElementById("pd-des").value;
    const material = document.getElementById("pd-material").value;
    const type = document.getElementById("pd-type").value;
    const str = "";
    if (
        name == "" ||
        number == "" ||
        price == "" ||
        size == "" ||
        color == "" ||
        type == "" ||
        brandId == "" ||
        material == "" ||
        des == "" ||
        img == ""
    ) {
        str += "Fields cannot be null!";
    } else {
        if (size <= 0) {
            str += "size must be greater than 0\n";
        }
        if (price <= 0) {
            str += "price must be greater than 0\n";
        }
        if (number < 0) {
            str += "(numOfProduct must be greater than 0 or equal to 0\n";
        }
    }
    return str;
}
function remove_add_product() {
    document.getElementById("pd-name").value = "";
    document.getElementById("pd-img").value = "";
    document.getElementById("pd-price").value = "";
    document.getElementById("pd-size").value = "";
    document.getElementById("pd-color").value = "";
    document.getElementById("pd-quantity").value = "";
    document.getElementById("pd-brand").value = "";
    document.getElementById("pd-des").value = "";
    document.getElementById("pd-material").value = "";
    document.getElementById("pd-type").value = "";
}
// UPLOAD IMAGE
function upload_img(id_element) {
    let photo = document.getElementById(id_element).files[0];
    let formData = new FormData();
    formData.append("file", photo);
    fetch("library/admin/SaveImage.php", { method: "POST", body: formData });
}
