<?php
session_start();
include('../db/connect.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');
$khachhang_id = $_SESSION['khachhang_id'];
$code_order = rand(0, 9999);
$today = date("Y-m-d");
$today_ = date("H:i:s");


$rdo = $_POST['payment-method'];
$note = $_POST['note'];
$address = $_POST['address'];

if ($rdo == "tt") {
    $insert_order = "INSERT INTO tbl_order(user_id, date, time, note, address, order_status, payment_status, payment_method) VALUE('" . $khachhang_id . "', '" . $today . "', '" . $today_ . "', '" . $note . "', '" . $address . "', 0, 0, 0)";
    $cart_query = mysqli_query($con, $insert_order);
    $sql = "SELECT id FROM tbl_order ORDER BY id DESC";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    $id = $row['id'];
    if ($insert_order) {
        foreach ($_SESSION['donhang'] as $key => $value) {
            $id_sanpham = $value['id'];
            $soluong = $value['soluong'];
            $insert_order_detail = "INSERT INTO tbl_order_detail(id, product_id, quantity) VALUE('" . $id . "','" . $id_sanpham . "', '" . $soluong . "')";
            mysqli_query($con, $insert_order_detail);
        }
    }
    unset($_SESSION['donhang']);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <meta http-equiv="refresh" content="5;url=home.php">
    </head>

    <body>
        <h1>Bạn đã đặt hàng thành công! Hệ thống sẽ tự động trở về Trang chủ sau 3 giây.</h1>
    </body>

    </html>
<?php
} elseif ($rdo == "vnpay") {
    $insert_order = "INSERT INTO tbl_order(user_id, date, time, note, address, order_status, payment_status, payment_method) VALUE('" . $khachhang_id . "', '" . $today . "', '" . $today_ . "', '" . $note . "', '" . $address . "', 0, 0, 1)";
    $cart_query = mysqli_query($con, $insert_order);
    $sql = "SELECT id FROM tbl_order ORDER BY id DESC";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    $id = $row['id'];
    if ($insert_order) {
        foreach ($_SESSION['donhang'] as $key => $value) {
            $id_sanpham = $value['id'];
            $soluong = $value['soluong'];
            $insert_order_detail = "INSERT INTO tbl_order_detail(id, product_id, quantity) VALUE('" . $id . "', '" . $id_sanpham . "', '" . $soluong . "')";
            mysqli_query($con, $insert_order_detail);
        }
    }


    unset($_SESSION['donhang']);
    header('Location:VNPay/index.php');
} else {
}

?>