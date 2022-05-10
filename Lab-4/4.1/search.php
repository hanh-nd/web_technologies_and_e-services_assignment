<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table</title>
</head>
<body>
<h2>Products Data</h2>
<table border="1">
    <?php
    include "conn.php";
    $product = $_POST['name'];
    $sql = "SELECT * FROM Products WHERE Product_desc = '$product'";
    $result = mysqli_query($conn, $sql);
    echo "The QUERY is $sql";
    if ($result){
        echo "<tr>
                <th>Num</th>
                <th>Product</th>
                <th>Cost</th>
                <th>Weight</th>
                <th>Count</th>
            </tr>";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["ProductID"]."</td><td>".$row["Product_desc"]."</td><td>"
                .$row["Cost"]."</td><td>".$row["Weight"]."</td><td>".$row["Numb"]."</td>";
        }
    }
    else echo "404!"
    ?>
</table>
</body>
</html>
