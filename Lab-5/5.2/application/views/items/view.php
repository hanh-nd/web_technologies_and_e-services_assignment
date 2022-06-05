<h2><?php if (isset($todo)) {
        echo $todo['Item']['item_name'];
    } ?></h2>

<a class="big" href="../../../items/delete/<?php echo $todo['Item']['id'] ?>">
     <span class="item">
 Xoá Todo này
</span>
</a>