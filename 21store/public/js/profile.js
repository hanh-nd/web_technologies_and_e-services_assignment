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
  }