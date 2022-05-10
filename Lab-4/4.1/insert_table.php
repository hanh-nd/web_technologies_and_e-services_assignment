<?php
include "conn.php";
$description = $_POST['description'];
$weight = $_POST['weight'];
$cost = $_POST['cost'];
$number = $_POST['number'];
$table_name = 'Products';
$sql = "INSERT INTO Products (Product_desc, Cost, Weight, Numb) 
    VALUES ('$description', '$weight', '$cost', '$number')";
$insert = mysqli_query($conn, $sql);
echo "The Query is $sql <br>";
echo "Insert into $table_name is ";
if($insert)
    echo "successful";
else
    echo "error";
