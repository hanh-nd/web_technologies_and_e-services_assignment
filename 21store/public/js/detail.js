function validateComment() {
    let x = document.forms["commentForm"]["content"].value;
    if (x === "" ) {
        document.getElementById("validateComment").innerHTML = "Bạn chưa nhập bình luận!!";
        return false;
    }
}