function validateForm() {
    let x = document.forms["myForm"]["password"].value;
    let y = document.forms["myForm"]["confirmPassword"].value;
    if (x === "" || y === "") {
        document.getElementById("validate").innerHTML = "Hãy điền đủ thông tin!!";
        return false;
    }
    if (x !== y) {
        document.getElementById("validate").innerHTML = "Xác minh mật khẩu không chính xác!!";
        return false;
    }
    if (x.length < 6) {
        document.getElementById("validate").innerHTML = "Mật khẩu phải nhiều hơn 6 kí tự!!";
        return false;
    }
    alert('Đổi mật khẩu thành công')
}

function validateFormInfor() {
    let x = document.forms["formInfor"]["address"].value;
    let y = document.forms["formInfor"]["phoneNumber"].value;
    let z = document.forms["formInfor"]["fullname"].value;

    if (x === "" || y === "" || z === "") {
        document.getElementById("validate2").innerHTML = "Hãy điền đủ thông tin!!";
        return false;
    }
    else{
        alert('Lưu thay đổi')
    }
}