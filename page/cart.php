<?php
include('../db/connect.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KIEN RESTAURANT</title>
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/webstyle.css">
  <link rel="stylesheet" href="../assets/css/login.css">
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="../frontend/res.css"> -->
  <link rel="stylesheet" href="../assets/fonts/fontawesome-free-5.15.4-web/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" integrity="sha512-NhSC1YmyruXifcj/KFRWoC561YpHpc5Jtzgvbuzx5VozKpWvQ+4nXhPdFgmx8xqexRcpAglTj9sIBWINXa8x5w==" crossorigin="anonymous" referrer-policy="no-referrer" />
  <script>
    src = "https://kit.fontawesome.com/54f0cb7e4a.js";
    crossorigin = "anonymous"
  </script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
</head>

<body>
  <section class="h-100 h-custom" style="background-color: #d2c9ff;">
    <div class="container py-5 h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12">
          <div class="card card-registration card-registration-2" style="border-radius: 15px;">
            <div class="card-body p-0">
              <div class="row g-0">
                <div class="col-lg-8">
                  <div class="p-5">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                      <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                    </div>
                    <hr class="my-4">

                    <?php
                    $tongtien = 0;
                    if (isset($_SESSION['donhang'])) {
                      foreach ($_SESSION['donhang'] as $donhang_sp) {
                        $thanhtien = $donhang_sp['soluong'] * $donhang_sp['sanpham_gia'];
                        $tongtien += $thanhtien;
                    ?>

                        <div class="row mb-4 d-flex justify-content-between align-items-center">
                          <div class="col-md-2 col-lg-2 col-xl-2">
                            <img src="../image/<?php echo $donhang_sp['sanpham_image'] ?>" class="img-fluid rounded-3" alt="">
                          </div>
                          <div class="col-md-3 col-lg-3 col-xl-3">
                            <h6 class="text-black mb-0"><?php echo $donhang_sp['sanpham_name'] ?></h6>
                          </div>
                          <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                            <a href="addproduct.php?tang=<?php echo $donhang_sp['id'] ?>"><i class="fas fa-plus"></i></a>
                            <h6 style="padding: 0 10px;"><?php echo $donhang_sp['soluong'] ?></h6>
                            <a href="addproduct.php?giam=<?php echo $donhang_sp['id'] ?>"><i class="fas fa-minus"></i></a>
                          </div>
                          <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                            <h6 class="mb-0"><?php echo number_format($thanhtien, 0, ',', '.') . ' VNĐ' ?></h6>
                          </div>
                          <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                            <a href="addproduct.php?xoa=<?php echo $donhang_sp['id'] ?>" class="text-muted"><i class="fas fa-times"></i></a>
                          </div>
                        </div>
                      <?php } ?>
                    <?php

                    } else { ?>
                      <h6>Hiện tại chưa có đơn hàng được tạo!</h6>
                    <?php } ?>

                    <hr class="my-4">

                    <div class="pt-5 d-flex justify-content-between align-items-center">
                      <h6 class="mb-0"><a style="cursor: pointer" href="home.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                      <h6 style="float: right"><a href="addproduct.php?xoatatca=1">Xoá tất cả</a></h6>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 bg-grey">
                  <div class="p-5">
                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                    <hr class="my-4">

                    <div class="d-flex justify-content-between mb-3">
                      <h5 class="text-uppercase">Total price</h5>
                      <h5><?php echo number_format($tongtien, 0, ',', '.') . ' VNĐ' ?></h5>
                    </div>


                    <form action="payment.php" method="post" name="payment" onsubmit="return validateForm()" required>
                      <div class="mb-4 pb-2">
                        <p>Note</p>
                        <input type="text" id="note" name="note">
                      </div>

                      <div class="mb-4 pb-2">
                        <p>Address Shipping</p>
                        <input type="text" id="address" name="address">
                      </div>
                      <div class="mb-4 pb-2">
                        <p>Choose payment method</p>
                        <input class="payment-method" type="radio" name="payment-method" value="tt" checked><label for="tt">Thanh toán khi nhận hàng</label><br>
                        <input class="payment-method" type="radio" name="payment-method" value="vnpay"><label for="vnpay">VNPay</label><br>
                        <?php if (isset($_SESSION['donhang'])) { ?>
                          <a href="" style="text-decoration: none; color:white;"><input style="margin-top: 20px;" type="submit" id="submit" value="Go to Payment" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark"></label></input></a>
                        <?php } else { ?>
                          <a href="payment.php" style="text-decoration: none; color:white;"><button type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark" disabled>Go to Payment</button></a>
                        <?php } ?>
                    </form>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
</body>

<script>
  function validateForm() {
    var x = document.forms["payment"]["address"].value;
    if (x == "") {
      alert("Địa chỉ không được để trống!");
      return false;
    }
  }
</script>