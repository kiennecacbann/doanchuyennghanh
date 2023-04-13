<?php
session_start();
include("../db/connect.php");

//tang so luong san pham
if (isset($_GET['tang'])) {
    $id = $_GET['tang'];
    foreach ($_SESSION['donhang'] as $donhang_sp) {
        if ($donhang_sp['id'] != $id) {
            $sanpham[] = array('sanpham_name' => $donhang_sp['sanpham_name'], 'id' => $donhang_sp['id'], 'soluong' => $donhang_sp['soluong'], 'sanpham_gia' => $donhang_sp['sanpham_gia'], 'sanpham_image' => $donhang_sp['sanpham_image'], 'sanpham_id' => $donhang_sp['sanpham_id']);
            $_SESSION['donhang'] = $sanpham;
        } else {
            $sanpham[] = array('sanpham_name' => $donhang_sp['sanpham_name'], 'id' => $donhang_sp['id'], 'soluong' => $donhang_sp['soluong'] + 1, 'sanpham_gia' => $donhang_sp['sanpham_gia'], 'sanpham_image' => $donhang_sp['sanpham_image'], 'sanpham_id' => $donhang_sp['sanpham_id']);
            $_SESSION['donhang'] = $sanpham;
        }
    }
    header('Location:cart.php');
}

//giam so luong san pham
if (isset($_GET['giam'])) {
    $id = $_GET['giam'];
    foreach ($_SESSION['donhang'] as $donhang_sp) {
        if ($donhang_sp['id'] != $id) {
            $sanpham[] = array('sanpham_name' => $donhang_sp['sanpham_name'], 'id' => $donhang_sp['id'], 'soluong' => $donhang_sp['soluong'], 'sanpham_gia' => $donhang_sp['sanpham_gia'], 'sanpham_image' => $donhang_sp['sanpham_image'], 'sanpham_id' => $donhang_sp['sanpham_id']);
            $_SESSION['donhang'] = $sanpham;
        } else {
            if ($donhang_sp['soluong'] > 1) {
                $sanpham[] = array('sanpham_name' => $donhang_sp['sanpham_name'], 'id' => $donhang_sp['id'], 'soluong' => $donhang_sp['soluong'] - 1, 'sanpham_gia' => $donhang_sp['sanpham_gia'], 'sanpham_image' => $donhang_sp['sanpham_image'], 'sanpham_id' => $donhang_sp['sanpham_id']);
            } else {
                $sanpham[] = array('sanpham_name' => $donhang_sp['sanpham_name'], 'id' => $donhang_sp['id'], 'soluong' => $donhang_sp['soluong'], 'sanpham_gia' => $donhang_sp['sanpham_gia'], 'sanpham_image' => $donhang_sp['sanpham_image'], 'sanpham_id' => $donhang_sp['sanpham_id']);
            }
            $_SESSION['donhang'] = $sanpham;
        }
    }
    header('Location:cart.php');
}

//xoa san pham
if (isset($_SESSION['donhang']) && isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    foreach ($_SESSION['donhang'] as $donhang_sp) {
        if ($donhang_sp['id'] != $id) {
            $sanpham[] = array('sanpham_name' => $donhang_sp['sanpham_name'], 'id' => $donhang_sp['id'], 'soluong' => $donhang_sp['soluong'], 'sanpham_gia' => $donhang_sp['sanpham_gia'], 'sanpham_image' => $donhang_sp['sanpham_image'], 'sanpham_id' => $donhang_sp['sanpham_id']);
        }
        $_SESSION['donhang'] = $sanpham;
        header('Location:cart.php');
    }
}

//xoa tat ca
if (isset($_GET['xoatatca']) && $_GET['xoatatca'] == 1) {
    unset($_SESSION['donhang']);
    header('Location:cart.php');
}

//them vao gio hang
if (!isset($_SESSION['dangnhap_home'])) {
    echo '<script language="javascript">';
    echo 'alert("Đăng nhập để có thể thêm món ăn vào giỏ hàng!")';
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0;url=login.php">';
} else {
    if (isset($_GET['action']) && $_GET['action'] == 'add') {
        $id = $_GET['sanpham_id'];
        if (isset($_GET['sl']))
            $soluong = $_GET['sl'];
        else
        $soluong = 1;
        $sql = "SELECT * FROM tbl_product WHERE id ='$id'";
        $query = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($query);
        if ($row) {
            $new_product = array(array('sanpham_name' => $row['name'], 'id' => $id, 'sanpham_gia' => $row['price'], 'soluong' => $soluong, 'sanpham_image' => $row['image'], 'sanpham_id' => $row['id']));
            if (isset($_SESSION['donhang'])) {
                $found = false;
                foreach ($_SESSION['donhang'] as $donhang_sp) {
                    if ($donhang_sp['id'] == $id) {
                        $sanpham[] = array('sanpham_name' => $donhang_sp['sanpham_name'], 'id' => $donhang_sp['id'], 'soluong' => $donhang_sp['soluong']+1, 'sanpham_gia' => $donhang_sp['sanpham_gia'], 'sanpham_image' => $donhang_sp['sanpham_image'], 'sanpham_id' => $donhang_sp['sanpham_id']);
                        $found = true;
                    } else {
                        $sanpham[] = array('sanpham_name' => $donhang_sp['sanpham_name'], 'id' => $donhang_sp['id'], 'soluong' => $donhang_sp['soluong'], 'sanpham_gia' => $donhang_sp['sanpham_gia'], 'sanpham_image' => $donhang_sp['sanpham_image'], 'sanpham_id' => $donhang_sp['sanpham_id']);
                    }
                }
                if ($found == false) {
                    $_SESSION['donhang'] = array_merge($sanpham, $new_product);
                } else {
                    $_SESSION['donhang'] = $sanpham;
                }
            } else {
                $_SESSION['donhang'] = $new_product;
            }
        }
    }
    echo '<script language="javascript">';
    echo 'alert("Món đã được thêm vào giỏ hàng!")';
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0;url=home.php#menu">';
}
?>
