<?php
global $path_project;
require_once ROOT . DS . 'services' . DS . 'UserService.php';
require_once ROOT . DS . 'services' . DS . 'OrderItemService.php';
require_once ROOT . DS . 'services' . DS . 'BillService.php';

$userService = new UserService();
$billService = new BillService();
$orderService = new OrderItemService();

if (array_key_exists("productId", $_POST)) {
    $userService->delete($_POST['productId'][0]);

    if(isset($_COOKIE['userId']) && !empty($_COOKIE['userId'])) {
        unset($_COOKIE['userId']);
        setcookie('userId', "", time() - 3600, "/");
    } 
}

$allUser = $userService->getAll();
$listTmpBill = $billService->getAllBill();

$phoneNumber = "";
$fullname = "";

if (array_key_exists("fullname", $_POST)) {
    $fullname = strtolower($_POST['fullname']);
}
if (array_key_exists("phoneNumber", $_POST)) {
    $phoneNumber = strtolower($_POST['phoneNumber']);
}

$users = array();
$listBill = array();
foreach ($allUser as $g) {
    $gfullname = strtolower($g->getFullname());
    $gphoneNumber = strtolower($g->getPhoneNumber());
    if (($fullname == "" || strpos($gfullname, $fullname) !== false)  &&
        ($phoneNumber == "" || strpos($gphoneNumber, $phoneNumber) !== false)
    ) {
        array_push($users, $g);
    }
}

foreach ($listTmpBill as $tmpBill) {
    $userId = $tmpBill->getUserId();
    $user = $userService->getUser($userId);
    if (in_array($user, $users)) {
        array_push($listBill, $tmpBill);
    }
}

if (array_key_exists("exportUser", $_POST)) {
    $list = array(array("ID", "Full Name", "Phone Number", "Address"));
    $fp = fopen("data.csv", 'w');
    fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));

    foreach($allUser as $user) {
        $_id = $user->getId();
        $_fullname = $user->getFullname();
        $_phoneNumber = $user->getPhoneNumber();
        $_address = $user->getAddress();

        $userArray = array("$_id", "$_fullname", "$_phoneNumber", "$_address");
        array_push($list, $userArray);
    }

    foreach($list as $fields) {
        fputcsv($fp, $fields);
    }

    fclose($fp);
    header("Location: data.csv");
}

if (array_key_exists("exportBill", $_POST)) {
    $list = array(array("Customer", "Order Date", "Order Detail", "Total Amount", "Status"));
    $fp = fopen("data.csv", 'w');
    fputs($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));


    foreach($listBill as $bill) {
        $user = $userService->getUser($bill->getUserId());
        $listOrderItem = $orderService->getAllOrderFormBill($bill->getId());

        $_customer = $user->getFullname();
        $_orderDate = $bill->getCreatedAt();
        $_orderDetail = "";

        foreach ($listOrderItem as $item) {
            $_productName = $item->getProduct()->getProductName();
            $_quantity = $item->getQuantity();
            $_orderDetail = $_orderDetail . "$_productName" . ": $_quantity; ";
        }
        $_totalAmount = $bill->getFormattedTotalAmount();
        $_status = $bill->getStatus();

        $billArray = array("$_customer", "$_orderDate", "$_orderDetail", "$_totalAmount", "$_status");
        array_push($list, $billArray);
    }

    foreach($list as $fields) {
        fputcsv($fp, $fields);
    }

    fclose($fp);
    header("Location: data.csv");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public/css/account_management.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/admin.css">
    <title>Quản lý tài khoản | 21store</title>

</head>

<body>
    <div class="wrapper" style="display: flex;">
        <?php require_once ROOT . DS . 'mvc' . DS . 'views' . DS . 'admin.php'; ?>
        <div class="content">
            <h1>Quản lý tài khoản</h1>
            <div class="divider"></div>
            <div>
                <form action="" method="post" class="search-user">
                    <div class="input-search">
                        <label>Name</label>
                        <input type="text" name="fullname">
                    </div>
                    <div class="input-search">
                        <label>Phone</label>
                        <input type="text" name="phoneNumber">
                    </div>
                    <div>
                        <input type="submit" value="Tìm kiếm">
                    </div>
                </form>
                <form method="post">
                    <button type="submit" name="exportUser">Export User</button>
                </form>
                <br><br>
                <form method="post">
                    <table class="table-user">
                        <tr>
                            <th>UserName</th>
                            <th>Full Name</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>

                        </tr>
                        <?php
                        foreach ($users as $u) {
                        ?>
                            <tr>
                                <td><?php echo $u->getUsername() ?></td>
                                <td><?php echo $u->getFullname() ?></td>
                                <td><?php echo $u->getPhoneNumber() ?></td>
                                <td><?php echo $u->getAddress() ?></td>
                                <td class="action">
                                    <button type="submit" name="productId[]" value="<?php echo $u->getId() ?>">Xoá</button>
                                </td>

                            </tr>                        
                        <?php } ?>
                    </table>
                </form>
                <?php
                $total_turnover = 0;
                $total_bill = 0;
                foreach ($listBill as $bill) {

                    if ($bill->getStatus() == "Đã mua") {
                        $total_turnover += $bill->getTotalAmount();
                        $total_bill++;
                    }
                }
                ?>
                <h1>Quản lý đơn hàng</h1>
                <div class="divider"></div>
                <h5>Tổng số tiền đã bán thành công : <span style="color: red;"><?php echo number_format($total_turnover, 0, '', ',') . " VND" ?></span></h5>
                <h5>Tổng số đơn hàng đã bán thành công : <?php echo $total_bill ?></h5>
                <form method="post">
                    <button type="submit" name="exportBill">Export Bill Data</button>
                </form>
                <br><br>
                <div class="products-container">
                    <table class="table-user">
                        <tr>
                            <th>Khách hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th style="min-width: 300px;">Chi tiết đơn hàng</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Hành động</th>
                        </tr>
                        <?php
                        for ($i = count($listBill) - 1; $i >= 0; $i--) {
                            $bill = $listBill[$i];
                            $user = $userService->getUser($bill->getUserId());
                            $listOrderItem = $orderService->getAllOrderFormBill($bill->getId())
                        ?>
                            <tr>
                                <form action="library/UpdateBill.php" method="POST">
                                    <input type="text" name="bill_id" value="<?php echo $bill->getID() ?>" style="display: none">
                                    <td><?php echo $user->getFullname() ?></td>
                                    <td>
                                        <p id='deal'><?php echo $bill->getCreatedAt() ?></p>
                                    </td>
                                    <td>
                                        <p><?php foreach ($listOrderItem as $item) {
                                            ?>
                                                <?php $product = $item->getProduct(); ?>
                                        <div class="detail">
                                            <span><?php echo $product->getProductName() ?> X<?php echo $item->getQuantity() ?></span>
                                            <span>
                                                <?php echo $product->getFormattedPrice() ?>
                                            </span>
                                        </div>

                                    <?php } ?></p>
                                    </td>
                                    <td>
                                        <p id='total_amount'>x<?php echo $bill->getFormattedTotalAmount() ?></p>
                                    </td>
                                    <td>
                                        <p id='status'><?php
                                                        echo $bill->getStatus()
                                                        ?></p>
                                    </td>
                                    <td>
                                        <select name="status">
                                            <option <?php if ($bill->getStatus() != "Đang giao") echo "selected" ?> value="Đang giao">Đang giao</option>
                                            <option <?php if ($bill->getStatus() == "Đã mua") echo "selected" ?> value="Đã mua">Hoàn thành</option>
                                        </select>
                                        <input type="submit" value="Xác nhận">
                                    </td>
                                </form>
                            </tr>
                        <?php } ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>