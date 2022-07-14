<?php
require_once ROOT . DS . 'services' . DS . 'UserService.php';
require_once ROOT . DS . 'services' . DS . 'OrderItemService.php';
require_once ROOT . DS . 'services' . DS . 'BillService.php';

$userService= new UserService();
$allUser=$userService->getAll();

$billService = new BillService();
$listTmpBill = $billService->getAllBill();

$orderService = new OrderItemService();


$phoneNumber= "";
$fullname = "";


if(array_key_exists("fullname", $_POST)){
  $fullname = strtolower($_POST['fullname']);
}
if(array_key_exists("phoneNumber", $_POST)){
  $phoneNumber = strtolower($_POST['phoneNumber']);
}

$users= array();
$listBill = array();
foreach($allUser as $g){
  $gfullname= strtolower($g->getFullname());
  $gphoneNumber= strtolower($g->getPhoneNumber());
  if(($fullname=="" || strpos($gfullname, $fullname) !== false)  &&
        ( $phoneNumber=="" || strpos($gphoneNumber, $phoneNumber) !== false)){
          array_push($users, $g);
  }
}

foreach ($listTmpBill as $tmpBill) {
    $userId = $tmpBill->getUserId();
    $user = $userService->getUser($userId);
    if(in_array($user, $users)){
        array_push($listBill, $tmpBill);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng người dùng | 21store</title>
    <style>
        p {
        color:rgb(35, 102, 226); font-size: 25px; margin-bottom:0px;
        }
        .input1 {
        width: 70%;
        height: 30px;
        border-radius: 5px;
        }
        .btn{
        border: none;
        background-color: dodgerblue;
        color: white;
        font-size: 20px;
        margin-top: 47px;
        padding: 10px;
        border-radius: 5px;
        }
        th {
        width:25%;
        color:rgb(35, 102, 226);
        font-size: 30px;
        }
        td {
        color:rgb(26, 12, 7);
        font-size: 25px;
        }
    </style>

    </head>
    <body>
        <div style="color:rgb(35, 102, 226);"><center><h1>Quản lý đơn hàng, tài khoản</h1></center></div>
        <hr>
        <form action="" method="post">
            <div>
                <div style="width:28%; float:left; height: 70px;">
                    <p>Name</p>
                    <input class="input1" type="text" name="name">
                </div>
                <div style="width:28%; float:left; height: 70px;">
                    <p>Phone</p>
                    <input class="input1" type="text" name="phone">
                </div>
                <div style="width:16%; float:left; height: 70px;">
                    <input class="btn" type="submit" value="Tìm kiếm">
                </div>

            </div>
        </form>
        <br>
        <br>
        <br>
        <br>
        <br>
        <hr>
        <br><br>
        <table border="1" style="width:100%;">
            <tr>
                <th >UserName</th>
                <th >Full Name</th>
                <th >Phone</th>
                <th >Address</th>
            </tr>
            <?php
            foreach($users as $u){
            ?>
            <tr>
                <td><?php echo $u->getUsername()?></td>
                <td><?php echo $u->getFullname()?></td> -->
                <td><?php echo $u->getPhoneNumber()?></td>
                <td><?php echo $u->getAddress()?></td>
            </tr>
            <?php } ?>
        </table>
        <?php
            $total_turnover = 0;
            $total_bill = 0;
            foreach ($listBill as $bill) {


                if($bill->getStatus() == "Đã mua"){
                    $total_turnover += $bill->getTotalAmount();
                    $total_bill++;
                }

            }
        ?>
        <br /><br /><br /><br />
        <h2>Sản phẩm đặt hàng</h2><h2>Tổng số tiền đã bán thành công : <?php echo $total_turnover ?></h2><h2>Tổng số đơn hàng đã bán thành công : <?php echo $total_bill ?></h2>
        <div class="products-container" b>
          <table border="1" style="width:100%;">
              <tr>
                  <td>Khách hàng</td>
                  <td>Ngày đặt hàng</td>
                  <td>Chi tiết đơn hàng</td>
                  <td>Tổng tiền</td>
                  <td>Trạng thái</td>
                  <td>Hành động</td>
              </tr>
          <?php
              for ($i=count($listBill)-1; $i>=0; $i--) {
                $bill = $listBill[$i];
                $user = $userService->getUser($bill->getUserId());
                $listOrderItem = $orderService->getAllOrderFormBill($bill->getId())
          ?>
            <tr>
                <form action="library/UpdateBill.php" method="POST">
                  <input type="text" name="bill_id" value="<?php echo $bill->getID() ?>" style="display: none">
                  <td><?php echo $user->getFullname() ?></td>
                  <td><p id = 'deal'><?php echo $bill->getCreatedAt() ?></p></td>
                  <td><p><?php                     foreach ($listOrderItem as $item) {
                    ?>
                        <?php $product = $item->getProduct(); ?>
                        <a href="<?php echo  "/" . $path_project . "/" . "detail?id=" .  $item->getProductId() ?>" class="purchase-infor">
                            <div>
                                <p><?php echo $product->getProductName() ?></p>
                                <p class="quantity">X<?php echo $item->getQuantity() ?>
                                    <span><?php echo $product->getFormattedPrice() ?></span>
                                </p>
                            </div>
                        </a>
                        <div class="divider"></div>
                    <?php } ?></p></td>
                  <td><p id = 'total_amount'>x<?php echo $bill->getTotalAmount() ?></p></td>
                  <td><p id = 'status'><?php
                    echo $bill->getStatus()
                    ?></p></td>
                    <td style="text-align : center">
                      <select name="status">
                          
                          <option value="Đang giao">Đang giao</option>
                          <option value="Đã mua">Hoàn thành</option>
                      </select>
                      <input type="submit">
                    </td>
                </form>
            </tr>
        <?php } ?>
        </table>
      </div>
    </body>
</html>
