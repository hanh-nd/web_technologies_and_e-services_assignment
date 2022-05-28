<!DOCTYPE html>

<html lang="en">
<head><title>ViewBook</title></head>

<body>
<?php
if (isset($book)) {
    echo 'Title:' . $book->title . '<br/>';
    echo 'Author:' . $book->author . '<br/>';
    echo 'Description:' . $book->description . '<br/>';
}
?>

</body>
</html>
