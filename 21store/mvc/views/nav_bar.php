<?php
    global $path_project;

    if (array_key_exists("search_request", $_POST)) {
		if($_POST['search_request'] != "") {
            $search_keys = $_POST['search_request'];
            $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
            header("Location: " . $url . "search?q=" . $search_keys);
            exit();
        }
    }
?>

<div class="nav-container">
    <div class="nav-content">
        <div class="nav-bar">
            <div class="logo">
                <a href=<?php echo "/" . $path_project . "/" ?>><img src=<?php echo "/" . $path_project . "/" . "images/logo/logo-notext-transparent.png" ?> width="50px"></a>
            </div>
            <div class="search-field">
                <form action="" method="POST">
                    <input name="search_request" id="search_request" type="text" placeholder="Nhập nội dung tìm kiếm" />
                    <input type="submit" hidden />
                </form>
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
</div>

<script type="text/javascript" src = <?php echo "/" . $path_project . "/" . "public/js/nav_bar.js" ?>></script>
