<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
<body>
<p style="font-size: 25px; color:blue">Update Result for Table Products:</p>
<?php
include "conn.php";
$name = $_POST['name'];
$sql = "UPDATE Products SET Numb = Numb - 1 WHERE Product_desc = '".$name."'";
$result = mysqli_query($conn, $sql);
echo "The QUERY is $sql";
?>
<table border="1">
    <tr>
        <th>Num</th>
        <th>Product</th>
        <th>Cost</th>
        <th>Weight</th>
        <th>Count</th>
    </tr>
    <?php
    $sql = "SELECT * FROM Products";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["ProductID"]."</td><td>".$row["Product_desc"]."</td><td>"
            .$row["Cost"]."</td><td>".$row["Weight"]."</td><td>".$row["Numb"]."</td>";
    }
    ?>
</table>
</body>
</html>
