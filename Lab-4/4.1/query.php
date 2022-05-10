<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Table</title>
</head>
<body>
    <h2>Products Data</h2>
    <table border="1">
        <tr>
            <th>Num</th>
            <th>Product</th>
            <th>Cost</th>
            <th>Weight</th>
            <th>Count</th>
        </tr>
        <?php
        include "conn.php";
        $sql = "SELECT * FROM Products";
        $result = mysqli_query($conn, $sql);
        echo "The QUERY is $sql";
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr><td>".$row["ProductID"]."</td><td>".$row["Product_desc"]."</td><td>"
            .$row["Cost"]."</td><td>".$row["Weight"]."</td><td>".$row["Numb"]."</td>";
        }
        ?>
    </table>
</body>
</html>
