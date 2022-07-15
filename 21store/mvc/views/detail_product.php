<?php
require_once ROOT . DS . 'services' . DS . 'ProductService.php';
require_once ROOT . DS . 'services' . DS . 'BrandService.php';
require_once ROOT . DS . 'services' . DS . 'CommentService.php';


$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : "/";
$url_components = parse_url($url);
if (isset($url_components['query'])) {
    parse_str($url_components['query'], $params);
    if (isset($params['id'])) {
        $id = $params['id'];
    } else {
        $id = 1;
    }
} else {
    $id = 1;
}
?>

<?php
if (isset($_POST['content'])) {
    $content = $_POST['content'];
    $rate =  $_POST['rate'];
    $commentService = new CommentService();
    $commentService->insert($id, 2, $rate, $content);
} //van dang hard code user
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="public/css/footer.css" type="text/css">
    <link rel="stylesheet" href="public/css/nav_bar.css" type="text/css">
    <link rel="stylesheet" href="public/css/detail.css" type="text/css">
    <title>Detail</title>
</head>

<body>
    <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'nav_bar.php'; ?>
    <div class="detail-container">
        <?php
        $service = new ProductService();
        $product = $service->getProduct($id);
        $description = $product->getProductDescription();
        ?>
        <div>
            <img src="<?php echo $product->getImageUrl() ?>">
        </div>
        <div class="infor-product">
            <h1>THÔNG TIN SẢN PHẨM</h1>
            <p><?php echo $product->getProductName() ?></p>
            <p>-Loại sản phẩm: <?php echo $product->getProductType() ?></p>
            <p>-Thương hiệu: <?php echo $product->getBrandName() ?></p>
            <p>-Tên Sản Phẩm: <?php echo $product->getProductName() ?></p>
            <p>-Giá Bán: <?php echo $product->getFormattedPrice() ?></p>
            <p>-Màu Sắc: <?php echo $product->getColor() ?></p>
            <p>-Chất liệu vải: <?php echo $product->getMaterial() ?></p>
            <p>-Kích cỡ: <?php echo $product->getSize() ?></p>
            <p>*<?php echo $product->getProductDescription() ?>*</p>
        </div>
        <div class="buy-product">
            <h2 id="buy"><?php echo strtoupper($product->getProductName()) ?></h2>
            <p> <?php echo $product->getProductType() ?></p>
            <p class="price"> <?php echo $product->getFormattedPrice() ?></p>
            <h4>Số lượng</h4>
            <input type="number" value="1" min="1" max="<?php echo $product->getQuantity() ?>"></input><br />
            <span style="color: red; font-size:0.9rem; font-weight:550;">
                Còn lại <?php echo $product->getQuantity() ?> sản phẩm
            </span>
            <?php
            if ($product->getQuantity() <= 0)
                echo "<button class='out-of-stock'><span>ĐÃ HẾT HÀNG!!</span><p>Hàng mới về sau 5 - 10 ngày</p></button>";
            else
                echo "<button class='buy-now'><span>MUA NGAY</span><p>Giao hàng từ 3- 7 ngày (Trừ T7 CN)</p></button>";
            ?>
            <?php
            if ($product->getQuantity() > 0)
                echo "
                <button class='add-to-cart'>
                    <img src='https://gumac.vn/Content/Image/WebImage/addcart.png'' />
                    <span>THÊM VÀO GIỎ HÀNG</span>
                    </a>
                </button>";
            ?>

            <h3 style="margin-top: 20px">TỔNG ĐÀI HỖ TRỢ</h3>
            <div class="row-container hotline">
                <img src="https://gumac.vn/Content/Image/WebImage/iconphone.png" style="width:25px; height:25px" />
                <span>Hotline Mua Hàng: <b>18006013 </b>(Miễn phí)</span>
            </div>
            <div class="row-container hotline">
                <img src="https://gumac.vn/Content/Image/WebImage/iconphone.png" style="width:25px; height:25px" />
                <span>Hotline Hỗ trợ, khiếu nại: <b> 0972 333 444</b></span>
            </div>
        </div>
        <div class="guide">
            <h2>Hướng dẫn bảo quản</h2>
            <div>
                <p><i>ĐỐI VỚI QUẦN ÁO MỚI </i></p>
                <div class="divider"></div>
                <ul>
                    <li>Những sản phẩm sáng/đậm màu được khuyên giặt riêng.</li>
                    <li>Quần áo trơn 1 màu mới không nên giặt ngay, để tránh bay màu và mòn vải, nên cuộn lại cho vào ngăn đá qua đêm và giặt xả với sữa tắm cho lần giặt đầu tiên để sản phẩm được cầm màu và mềm sớ vải.</li>
                    <li>Lần giặt tiếp theo: Nên sử dụng các loại xà phòng (không có độ tẩy hoặc độ tẩy nhẹ): như dầu gội đầu, sữa tắm, bánh xà phòng thơm… sản phẩm sẽ ít bị phai màu và giặt rất nhanh.</li>
                    <li>Với các mẫu có phối vải màu khác nhau trên cùng 1 sản phẩm (nhất là màu tối).</li>
                </ul>
            </div>
            <div>
                <p><i>LƯU Ý</i></p>
                <div class="divider"></div>
                <ul>
                    <li>Không giặt tẩy bằng các chất tẩy rửa mạnh, KHÔNG ngâm nước quá lâu. KHÔNG nên ngâm và giặt chung với sản phẩm khác - tránh trường hợp màu đậm sẽ phai màu và lem vào sản phẩm khác làm hỏng, ố quần áo.</li>
                    <li>Cách giặt đồ: Lấy 1-2 giọt sữa tắm, dầu gội đầu… đánh bông lên, cho sản phẩm vào bóp nhẹ, rũ qua sau đó rũ lại bằng nước sạch rồi phơi lên luôn, tránh ngâm lâu.</li>
                    <li>Với những sản phẩm chất liệu ren, có phụ kiện không nên giặt sản phẩm cùng với các sản phẩm cầu kì khác như: Có móc, có khóa cứng, có nhiều họa tiết …. sẽ làm ảnh hưởng đến chất liệu sản phẩm. (sản phẩm ren và lưới hoặc vải mềm mỏng nên giặt bằng tay, nếu giặt máy vui lòng bỏ vào túi lưới để tránh làm hư sợi vải)</li>
                    <li>Lưu ý sản phẩm jean và denim : Chất liệu này 3 nước đầu không nên giặt chung với sản phẩm khác, mua về cho ngay vào tủ đông tầm 1 ngày để giữ màu lâu hơn.</li>
                    <li>Đối với sản phẩm có chất co giãn mạnh, khi phơi nên phơi ngang, lộn mặt trái sản phẩm khi phơi.</li>
                    <li>Nên phơi quần áo trong bóng mát, không nên phơi dưới ánh nắng gắt quá lâu tránh mất màu, giòn và rút sợi vải.</li>
                    <li>Ủi sản phẩm ở nhiệt độ vừa phải.</li>
                </ul>
            </div>
        </div>

        <div class="rate-product">
            <p>Đánh giá trung bình: <?php echo $product->getAverageRate() ?> sao</p>
            <h2 id="rateProduct">Đánh giá của bạn</h2>
            <form method="post" name="commentForm" onsubmit="return validateComment()">
                <b>Điểm đánh giá <input name="rate" type="number" value="5" max="5" min="1"></b><br />
                <b>Bình luận:</b><br>
                <textarea placeholder="Hãy đưa ra đánh giá cho chúng mình nhé" rows="3" name="content"></textarea>
                <p id="validateComment"></p>
                <input type="submit" value="Bình luận">
            </form>
            <h2>Phản hồi của khách hàng</h2>
            <?php
            $commentService = new CommentService();
            $comments = $commentService->getAllCommentFormProduct($product->getId());
            foreach ($comments as $comment) {
            ?>
                <div class="comment">
                    <span><b><?php echo $comment->getNameUser() ?></b>&emsp;<b>
                            Điểm đánh giá:</b> <?php echo $comment->getRate() ?>/5</span>
                    <br>
                    <span><?php echo $comment->getContent() ?></span>
                </div>
            <?php
            }
            ?>
        </div>
        <a href="#buy" id="up-to-top">
            <div class="img-up"><img src="https://d29fhpw069ctt2.cloudfront.net/icon/image/39098/preview.png" alt="up-to-top"></div>
            <p> Mua ngay</p>
        </a>
    </div>


</body>
<script type="text/javascript" src=<?php echo "/" . $path_project . "/" . "public/js/detail.js" ?>></script>