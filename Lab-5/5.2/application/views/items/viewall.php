<form action="../items/add" method="post">
    <input type="text" value="Tôi sẽ làm..."
           onclick="this.value=''" name="todo">
    <input type="submit" value="Thêm">
</form>
<br/><br/>
<?php $number = 0 ?>

<?php if (isset($todo)) {
    foreach ($todo as $todoitem): ?>
        <a class="big" href="../items/view/<?php echo $todoitem['Item']['id'] ?>/<?php echo
        strtolower(str_replace(" ", "-", $todoitem['Item']['item_name'])) ?>">
        <span class="item">
        <?php echo ++$number ?>
        <?php echo $todoitem['Item']['item_name'] ?>
        </span>
        </a><br/>
    <?php endforeach;
} ?>