<?php
session_start();


if (isset($_SESSION['donhang'])) {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIEN RESTAURANT</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/webstyle.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrer-policy="no-referrer" />
    <script>
        src = "https://kit.fontawesome.com/54f0cb7e4a.js";
        crossorigin = "anonymous"
    </script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>
<table style="width: 100%; text-align:center; border-collapse:collapse;" border="1">
    <tr>
        <th>Mã món</th>
        <th>Tên món</th>
        <th>Số lượng</th>
        <th>Giá</th>
        <th>Thành tiền</th>
        <th>Quản lý</th>
    </tr>
    <?php
    if (isset($_SESSION['donhang'])) {
        $tongtien = 0;
        foreach ($_SESSION['donhang'] as $donhang_sp) {
            $thanhtien = $donhang_sp['soluong'] * $donhang_sp['sanpham_gia'];
            $tongtien += $thanhtien;
    ?>
            <tr>
                <td><?php echo $donhang_sp['sanpham_id'] ?></td>
                <td><?php echo $donhang_sp['sanpham_name'] ?></td>
                <td>
                    <a href="addproduct.php?tang=<?php echo $donhang_sp['id'] ?>"><i class="fas fa-plus"></i></a>
                    <?php echo $donhang_sp['soluong'] ?>
                    <a href="addproduct.php?giam=<?php echo $donhang_sp['id'] ?>"><i class="fas fa-minus"></i></a>
                </td>
                <td><?php echo number_format($donhang_sp['sanpham_gia'], 0, ',', '.') . ' VNĐ' ?></td>
                <td><?php echo number_format($thanhtien, 0, ',', '.') . ' VNĐ' ?></td>
                <td><a href="addproduct.php?xoa=<?php echo $donhang_sp['id'] ?>">Xoá</a></td>
            </tr>
        <?php } ?>
        <td colspan="7">
            <p style="float: left;">Tổng tiền : <?php echo number_format($tongtien, 0, ',', '.') . ' VNĐ' ?></p>
            <p style="float: right"><a href="addproduct.php?xoatatca=1">Xoá tất cả</a></p>
            <div style="clear:both"></div>
        </td>


    <?php

    } else { ?>
        <tr>
            <td colspan="7">
                <p>Hiện tại chưa có đơn hàng được tạo!</p>
            </td>
        </tr>
    <?php } ?>
</table>
<br>
<p style="text-align:center"><a href="">Thanh toán</a></p>