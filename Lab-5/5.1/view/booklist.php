<!DOCTYPE html>
<html lang="en">
<head></head>

<body>
<table>
    <tbody>
    <tr>
        <td>Title</td>
        <td>Author</td>
        <td>Description</td>
    </tr>
    </tbody>
    <?php
    if (isset($books)) {
        foreach ($books as $title => $book) {
            echo '<tr><td><a href="index.php?book=' . $book->title . '">' . $book->title . '</a></td><td>' . $book->author . '</td><td>' . $book->description . '</td></tr>';
        }
    }
    ?>
</table>

</body>
</html>