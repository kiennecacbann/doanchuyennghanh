<?php
session_start();
include("../db/connect.php");



if (isset($_GET['huy'])) {
    $id = $_GET['huy'];
    mysqli_query($con, "UPDATE tbl_order SET order_status = '3' WHERE tbl_order.id = '$id'");
    echo '<meta http-equiv="refresh" content="0;url=order_list.php">';
}

if (isset($_GET['page'])) {
    $page_ = $_GET['page'];
} else {
    $page_ = '';
}
if ($page_ == '' || $page_ == '1') {
    $start = 0;
} else {
    $start = ($page_ * 5) - 5;
}

$user_id =  $_SESSION['khachhang_id'];
$sql = "SELECT * FROM tbl_order WHERE user_id = '$user_id' ORDER BY id DESC LIMIT $start, 5";
$query = mysqli_query($con, $sql);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Welcome</title>
    <style>
        ul.page {
            /* padding: 0 35%; */
            width: fit-content;
            margin: 0;
            list-style: none;
            display: block;
        }

        ul.page li {
            padding: 5px 13px;
            margin: 5px;
            background: #00dbde;
            float: left;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h4 align="center">DANH SÁCH ĐƠN HÀNG</h4>
                <form style="text-align: -webkit-center;" action="" method="POST">
                    <table class="table table-bordered ">
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Giờ đặt</th>
                            <th>Ngày đặt</th>
                            <th>Địa chỉ</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Phương thức thanh toán</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Ghi chú</th>
                            <th>Quản lý</th>

                        </tr>
                        <?php
                        while ($row = mysqli_fetch_array($query)) {
                            $tongtien = 0;                           
                            $id = $row['id'];
                            $sql_cart = "SELECT * FROM tbl_product, tbl_order_detail WHERE tbl_order_detail.id = '$id' AND tbl_order_detail.product_id = tbl_product.id";
                            $query_cart = mysqli_query($con, $sql_cart);
                            while ($row_cart = mysqli_fetch_array($query_cart)) {
                                $thanhtien = $row_cart['price'] * $row_cart['quantity'];
                                $tongtien += $thanhtien;
                            }

                        ?>
                            <tr>

                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['time'] ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo number_format($tongtien, 0, ',', '.') . '$' ?></td>
                                <td><?php
                                    if ($row['order_status'] == '0')
                                        echo "Đang xử lý";
                                    else if ($row['order_status'] == '2')
                                        echo "Đang giao hàng";
                                    else if ($row['order_status'] == '1')
                                        echo "Hoàn thành";
                                    else
                                        echo "Đã huỷ";
                                    ?></td>
                                <td><?php
                                    if ($row['payment_method'] == '0')
                                        echo "Thanh toán khi nhận hàng";
                                    else
                                        echo "Thanh toán qua VNPay";
                                    ?></td>
                                <td><?php
                                    if ($row['payment_status'] == '0')
                                        echo "Chưa thanh toán";
                                    else if ($row['payment_status'] == '1')
                                        echo "Đã thanh toán";
                                    else
                                        echo "Đã huỷ";
                                    ?></td>
                                <td><?php echo $row['note'] ?></td>
                                <td><a href="?id=<?php echo $row['id'] ?>">Xem</a></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <?php
                    $sql_page = mysqli_query($con, "SELECT * FROM tbl_order");
                    $row_page = mysqli_num_rows($sql_page);
                    $page = ceil($row_page / 5)
                    ?>
                    <ul class="page">
                        <?php
                        for ($i = 1; $i <= $page; $i++) {
                        ?>
                            <li <?php if ($i == $page_) echo 'style="background:yellow;"'  ?>><a href="order_list.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                        }
                        ?>

                    </ul>
                </form>
            </div>

            <a href="home.php">Trở về trang chủ</a>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql_cart = "SELECT * FROM tbl_order,tbl_order_detail,tbl_product WHERE tbl_order_detail.id = '$id' AND tbl_order.id = tbl_order_detail.id AND tbl_order_detail.product_id = tbl_product.id";
                $query_cart = mysqli_query($con, $sql_cart);
            ?>
                <div class="col-md-12">
                    <h4 align="center">CHI TIẾT ĐƠN HÀNG <?php echo $id ?></h4>
                    <form action="" method="POST">
                        <table class="table table-bordered ">
                            <tr>
                                <th>Mã món</th>
                                <th>Món ăn</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>
                            <?php
                            while ($row_cart = mysqli_fetch_array($query_cart)) {
                            ?>
                                <tr>

                                    <td><?php echo $row_cart['id'] ?></td>
                                    <td><?php echo $row_cart['name'] ?></td>
                                    <td><?php echo $row_cart['price'] ?></td>
                                    <td><?php echo $row_cart['quantity'] ?></td>
                                    <td><?php echo number_format($row_cart['price'] * $row_cart['quantity'], 0, ',', '.') . '$' ?></td>

                                </tr>
                            <?php } ?>
                        </table>


                        <?php
                        $sql_cart = "SELECT * FROM tbl_order,tbl_order_detail,tbl_product WHERE tbl_order_detail.id = '$id' AND tbl_order.id = tbl_order_detail.id AND tbl_order_detail.product_id = tbl_product.id";
                        $query_cart = mysqli_query($con, $sql_cart);
                        $row_cart = mysqli_fetch_array($query_cart);
                        if ($row_cart['order_status'] == '0') {
                        ?>
                            <a style="float:right;" href="?huy=<?php echo $id ?>">Huỷ đơn</a>
                        <?php }
                        ?>
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</body>