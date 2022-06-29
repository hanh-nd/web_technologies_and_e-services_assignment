<?php
	require_once ROOT . DS . 'services' . DS . 'ProductService.php';
	require_once ROOT . DS . 'services' . DS . 'BrandService.php';

    $url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
    $url_components = parse_url($url);
    if (isset($url_components['query'])) {
        parse_str($url_components['query'], $params);
        if (isset($params['page'])) {
            $page = $params['page'];
        } else {
            $page = 1;
        }
        if (isset($params['q'])) {
            $searchQuery = $params['q'];
        } else {
            $searchQuery = '';
        }
    } else {
        $page = 1;
        $searchQuery = '';
    }

?>

<!DOCTYPE html>
<html lang="vi">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="public/css/products.css" type="text/css">
		<link rel="stylesheet" href="public/css/footer.css" type="text/css">
		<link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
		<title>Products</title>
	</head>
<body>
	<?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
    <div class="product-list-container">
        <div class="product-list-content">
            Danh sách sản phẩm: <?php 
                $service = new ProductService();
                $totalRows = $service->getTotalProducts($searchQuery);
                $totalPages = ceil($totalRows / 4);
                echo $totalRows . ' sản phẩm';
            ?>
            <div class="product-list">
                <?php
                    $products = $service->getPaginatedProducts($page, 4, $searchQuery);
                    foreach($products as $product) {
                ?>
                    <div class="product-item-row">
                        <img src=<?php echo $product->getImageUrl() ?> width="250">
                        <p><?php echo $product->getProductName() ?></p>
                        <p><?php echo $product->getFormattedPrice() ?></p>
                    </div>
                <?php
                    }
                ?>	
            </div>
            <div class="pagination">
                <a 
                    style="<?php if ($page <= 1) echo 'display: none' ?>" 
                    href="<?php if ($searchQuery) {
                            echo 'products?page=' . $page - 1 . '&q=' . $searchQuery;
                        } else {
                            echo 'products?page=' . $page - 1;
                        }
                    ?>"
                >
                    &laquo;
                </a>
                <?php
                    for ($i = 1; $i <= $totalPages; $i++) {
                ?>
                    <a 
                        class="<?php if ($page == $i) echo 'active' ?>" 
                        href="<?php if ($searchQuery) {
                                echo 'products?page=' . $i . '&q=' . $searchQuery;
                            } else {
                                echo 'products?page=' . $i;
                            }
                        ?>"
                    >
                        <?php echo $i ?>
                    </a>
                <?php
                    }
                ?>
                <a 
                    style="<?php if ($page >= $totalPages) echo 'display: none' ?>" 
                    href="<?php if ($searchQuery) {
                            echo 'products?page=' . $page + 1 . '&q=' . $searchQuery;
                        } else {
                            echo 'products?page=' . $page + 1;
                        }
                    ?>"
                >
                    &raquo;
                </a>
            </div>
        </div>
	</div>
    <script type="text/javascript" src = <?php echo "/" . $path_project . "/" . "public/js/products.js" ?>></script>