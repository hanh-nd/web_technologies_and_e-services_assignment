<?php
    global $path_project;

    if (array_key_exists("search_request", $_POST)) {
		if(isset($_POST['search_request'])) {
            $search_keys = $_POST['search_request'];
            header("Location: " . "products?q=" . $search_keys);
            exit();
        }
    }

    $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
    $url_components = parse_url($url);
    if (isset($url_components['query'])) {
        parse_str($url_components['query'], $params);
        if (isset($params['q'])) {
            $searchQuery = $params['q'];
        } else {
            $searchQuery = '';
        }
    } else {
        $searchQuery = '';
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
                    <input name="search_request" id="search_request" type="text" placeholder="Nhập nội dung tìm kiếm" value="<?php echo $searchQuery ?>" />
                    <input type="submit" hidden />
                </form>
            </div>
            <nav id = "nav">
                <ul>
                    <li><a href=<?php
                        if(isset($_COOKIE['userId'])){
                            echo "/" . $path_project . "/" . "purchase"; 
                        }else{
                            echo "/" . $path_project . "/" . "login" ;
                        }
                    ?>>Theo dõi đơn hàng</a></li>
                    <li><a href=<?php echo "/" . $path_project . "/" . "#" ?>>Giỏ hàng</a></li>
                    <li><a href=<?php 
                        if(isset($_COOKIE['userId'])){
                            echo "/" . $path_project . "/" . "profile"; 
                        }else{
                            echo "/" . $path_project . "/" . "login" ;
                        }
                    ?>>Tài khoản</a></li>
                </ul>
            </nav>	
        </div>
        <div class="category-bar">
            <nav>
                <ul>
                    <li><a href=<?php echo "/" . $path_project . "/" ?>>Trang chủ</a></li>
                    <li><a href=<?php echo "/" . $path_project . "/" . "products" ?>>Danh sách sản phẩm</a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script type="text/javascript" src = <?php echo "/" . $path_project . "/" . "public/js/nav_bar.js" ?>></script>
