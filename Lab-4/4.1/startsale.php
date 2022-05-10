<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
</head>
<body>
<p style="font-size: 25px; color:blue">Select Product We Just Sold:</p>
<form action="sale.php" method="POST">
    <input type="radio" name="name" value="Hammer">Hammer<br>
    <input type="radio" name="name" value="Screwdriver">Screwdriver<br>
    <input type="radio" name="name" value="Wrench">Wrench<br>
    <input type="submit" value="Click to submit">
    <input type="reset" value="Reset">
</form>
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
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td>".$row["ProductID"]."</td><td>".$row["Product_desc"]."</td><td>"
            .$row["Cost"]."</td><td>".$row["Weight"]."</td><td>".$row["Numb"]."</td>";
    }
    ?>
</table>
</body>
</html>
