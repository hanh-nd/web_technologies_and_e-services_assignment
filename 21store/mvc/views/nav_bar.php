<?php
    global $path_project;
?>

<div class="nav-container">
    <div class="nav-bar">
        <div class="logo">
            <a href=<?php echo "/" . $path_project . "/" ?>><img src=<?php echo "/" . $path_project . "/" . "images/logo/logo-notext-transparent.png" ?> width="50px"></a>
        </div>
        <div class="search-field">
            <input id="search-input" type="text" placeholder="Nhập nội dung tìm kiếm" />
        </div>
        <nav id = "nav">
            <ul>
                <li><a href=<?php echo "/" . $path_project . "/" . "#" ?>>Theo dõi đơn hàng</a></li>
                <li><a href=<?php echo "/" . $path_project . "/" . "#" ?>>Giỏ hàng</a></li>
                <li><a href=<?php echo "/" . $path_project . "/" . "#" ?>>Tài khoản</a></li>
            </ul>
        </nav>	
    </div>
    <div class="category-bar">
        <nav>
            <ul>
                <li><a href=<?php echo "/" . $path_project . "/" ?>>Trang chủ</a></li>
                <li><a href=<?php echo "/" . $path_project . "/" . "#" ?>>Thời trang</a></li>
            </ul>
        </nav>
    </div>
</div>
<script type="text/javascript" src = <?php echo "/" . $path_project . "/" . "public/js/nav_bar.js" ?>></script>
