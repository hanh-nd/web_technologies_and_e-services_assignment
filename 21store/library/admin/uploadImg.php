<?php
$type=$_POST['type'];
if(isset($_POST) && isset($_FILES['file']) && $type = '1'){
	move_uploaded_file($_FILES['file']['tmp_name'], '../../public/images/products/' . $_FILES['file']['name']);
}
if(isset($_POST) && isset($_FILES['file']) && $type = '2'){
	move_uploaded_file($_FILES['file']['tmp_name'], '../../public/images/brands/' . $_FILES['file']['name']);
}
