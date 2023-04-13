<?php
include('../db/connect.php');
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
?>
<?php


?>
<?php
if (isset($_GET['xoadonhang'])) {
	$madonhang = $_GET['xoadonhang'];
	$sql_delete = mysqli_query($con, "DELETE FROM tbl_order WHERE id='$madonhang'");
	header('Location:xulydonhang.php');
}
if (isset($_GET['giao'])) {
	$madonhang = $_GET['giao'];
	$sql_deliver = mysqli_query($con, "UPDATE tbl_order SET order_status = '2' WHERE id='$madonhang'");
	header('Location:xulydonhang.php');
}
if (isset($_GET['huydon'])) {
	$madonhang = $_GET['huydon'];
	$sql_deliver = mysqli_query($con, "UPDATE tbl_order SET order_status = '3' WHERE id='$madonhang'");
	header('Location:xulydonhang.php');
}
if (isset($_GET['hoanthanh'])) {
	$madonhang = $_GET['hoanthanh'];
	$sql_completed = mysqli_query($con, "UPDATE tbl_order SET order_status = '1' WHERE id='$madonhang'");
	header('Location:xulydonhang.php');
}
if (isset($_GET['dangxuly'])) {
	$madonhang = $_GET['dangxuly'];
	$sql_completed = mysqli_query($con, "UPDATE tbl_order SET order_status = '0' WHERE id='$madonhang'");
	header('Location:xulydonhang.php');
}
//$sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET huydon='$huydon' WHERE madonhang='$magiaodich'");
//$sql_update_giaodich = mysqli_query($con, "UPDATE tbl_giaodich SET huydon='$huydon' WHERE magiaodich='$magiaodich'");
if (!isset($_SESSION['login'])) {
    header('Location: index.php');
}
if (isset($_GET['loginn'])) {
    $logout = $_GET['loginn'];
} else {
    $logout = '';
}
if ($logout == 'logout') {
    session_destroy();
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Đơn hàng</title>
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
	<p>Xin chào : <?php echo $_SESSION['login'] ?> <a href="?loginn=logout">Log out</a></p>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a class="nav-link" href="xulydonhang.php">Đơn hàng <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="xulydanhmuc.php">Danh mục</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="xulysanpham.php">Sản phẩm</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="xulykhachhang.php">Khách hàng</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="xulydondatban.php">Đơn đặt bàn</a>
				</li>
			</ul>
		</div>
	</nav><br><br>
	<div class="container-fluid">
		<div class="row">
			<?php
			if (isset($_GET['quanly']) == 'xemdonhang') {
				$madonhang = $_GET['madonhang'];
				$sql_chitiet = mysqli_query($con, "SELECT * FROM tbl_order_detail WHERE id='$madonhang'");
			?>
				<div class="col-md-12">
					<h4 align="center">XEM CHI TIẾT ĐƠN HÀNG</h4>
					<form action="" method="POST">
						<table class="table table-bordered ">
							<tr>
								<th>Mã đơn hàng</th>
								<th>Món ăn</th>
								<th>Đơn giá</th>
								<th>Số lượng</th>

							</tr>
							<?php
							while ($row_chitietdonhang = mysqli_fetch_array($sql_chitiet)) {
								$id_monan = $row_chitietdonhang['product_id'];
								$row_monan	= mysqli_query($con, "SELECT * FROM tbl_product WHERE id ='$id_monan'");
								if ($row_chitietmonan = mysqli_fetch_array($row_monan)) {
							?>
									<tr>

										<td><?php echo $row_chitietdonhang['id']; ?></td>
										<td><?php echo $row_chitietmonan['name']; ?></td>
										<td><?php echo $row_chitietmonan['price']; ?>$</td>
										<td><?php echo $row_chitietdonhang['quantity']; ?></td>
										<input type="hidden" name="mahang_xuly" value="<?php echo $row_donhang['id'] ?>">
									</tr>
							<?php
								}
							}
							?>
						</table>





						<input type="submit" value="Cập nhật đơn hàng" name="capnhatdonhang" class="btn btn-success">
					</form>
				</div>
			<?php
			} else {
			?>
				<div class="col-md-7">
					<h1>ĐƠN HÀNG CỦA BẠN</h1>
				</div>
			<?php
			}
			?>
			<div class="col-md-12">
				<h4 align="center">DANH SÁCH TẤT CẢ ĐƠN HÀNG CHƯA XỬ LÍ</h4>
				<?php
				$today = date("Y-m-d");
				$sql_select = mysqli_query($con, "SELECT * FROM tbl_order WHERE order_status = '0' and date = '$today'");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã đơn hàng</th>
						<th>Tình trạng đơn hàng</th>
						<th>Tên khách hàng</th>
						<th>Thời gian đặt</th>
						<th>Địa chỉ</th>
						<th>TỔNG TIỀN</th>
						<th>Tình trạng thanh toán</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while ($row_donhang = mysqli_fetch_array($sql_select)) {
						$madon = $row_donhang['id'];

						$sql_chitietdon = mysqli_query($con, "SELECT * FROM tbl_order_detail WHERE id='$madon' ");
						$tong = 0;
						while ($row_chitiet =  mysqli_fetch_array($sql_chitietdon)) {
							$monan_id = $row_chitiet['product_id'];
							$sql_monan = mysqli_query($con, "SELECT * FROM tbl_product WHERE id ='$monan_id' ");
							if ($row_monan =  mysqli_fetch_array($sql_monan)) {
								$giamon = $row_monan['price'];
								$tong +=  $giamon * $row_chitiet['quantity'];
							}
						}
						$i++;
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_donhang['id']; ?></td>
							<td><?php
								if ($row_donhang['order_status'] == 0) {
									echo 'Chưa xử lý';
								} else if ($row_donhang['order_status'] == 1) {
									echo 'Đã hoàn thành';
								} else if ($row_donhang['order_status'] == 2) {
									echo 'Đang giao hàng';
								} else {
									echo 'Đã hủy';
								}
								?></td>
							<?php
							$user__id = $row_donhang['user_id'];
							$sql_user =	mysqli_query($con, "SELECT * FROM tbl_user_account WHERE id = '$user__id'");
							if($row_user = mysqli_fetch_array($sql_user)){							
							?>
							<td><?php echo $row_user['fullname'] ?></td>
							<td><?php echo $row_donhang['date'] ?></td>

							<td><?php echo $row_donhang['address'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><?php
								if ($row_donhang['payment_status'] == 0) {
									echo 'Chưa thanh toán';
								} else if ($row_donhang['payment_status'] == 1) {
									echo 'Đã thanh toán';
								}
								?></td>
							<td><a href="?huydon=<?php echo $row_donhang['id'] ?>">Hủy</a> || <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['id'] ?>"> Xem chi tiết </a>|| <a href="?giao=<?php echo $row_donhang['id'] ?>"> Giao</a></td>
						</tr>
					<?php
						}else{
					?>
							<td>--</td>
							<td><?php echo $row_donhang['date'] ?></td>

							<td><?php echo $row_donhang['address'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><?php
								if ($row_donhang['payment_status'] == 0) {
									echo 'Chưa thanh toán';
								} else if ($row_donhang['payment_status'] == 1) {
									echo 'Đã thanh toán';
								}
								?></td>
							<td><a href="?huydon=<?php echo $row_donhang['id'] ?>">Hủy</a> || <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['id'] ?>"> Xem chi tiết </a>|| <a href="?giao=<?php echo $row_donhang['id'] ?>"> Giao</a></td>
						<?php
						}
					}
					?>
				</table>
			</div>

			<div class="col-md-12">
				<h4 align="center">DANH SÁCH TẤT CẢ ĐƠN HÀNG ĐANG VẬN CHUYỂN</h4>
				<?php
				$sql_select = mysqli_query($con, "SELECT * FROM tbl_order WHERE order_status = '2' and date = '$today'");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã đơn hàng</th>
						<th>Tình trạng đơn hàng</th>
						<th>Tên khách hàng</th>
						<th>Thời gian đặt</th>
						<th>Địa chỉ</th>
						<th>TỔNG TIỀN</th>
						<th>Tình trạng thanh toán</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while ($row_donhang = mysqli_fetch_array($sql_select)) {
						$madon = $row_donhang['id'];

						$sql_chitietdon = mysqli_query($con, "SELECT * FROM tbl_order_detail WHERE id='$madon' ");
						$tong = 0;
						while ($row_chitiet =  mysqli_fetch_array($sql_chitietdon)) {
							$monan_id = $row_chitiet['product_id'];
							$sql_monan = mysqli_query($con, "SELECT * FROM tbl_product WHERE id ='$monan_id' ");
							if ($row_monan =  mysqli_fetch_array($sql_monan)) {
								$giamon = $row_monan['price'];
								$tong +=  $giamon * $row_chitiet['quantity'];
							}
						}
						$i++;
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_donhang['id']; ?></td>
							<td><?php
								if ($row_donhang['order_status'] == 0) {
									echo 'Chưa xử lý';
								} else if ($row_donhang['order_status'] == 1) {
									echo 'Đã hoàn thành';
								} else if ($row_donhang['order_status'] == 2) {
									echo 'Đang giao hàng';
								} else {
									echo 'Đã hủy';
								}
								?></td>
							<?php
							$user__id = $row_donhang['user_id'];
							$sql_user =	mysqli_query($con, "SELECT * FROM tbl_user_account WHERE id = '$user__id'");
							if($row_user = mysqli_fetch_array($sql_user)){							
							?>
							<td><?php echo $row_user['fullname'] ?></td>
							<td><?php echo $row_donhang['date'] ?></td>

							<td><?php echo $row_donhang['address'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><?php
								if ($row_donhang['payment_status'] == 0) {
									echo 'Chưa thanh toán';
								} else if ($row_donhang['payment_status'] == 1) {
									echo 'Đã thanh toán';
								}
								?></td>
							<td> <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['id'] ?>"> Xem chi tiết </a>|| <a href="?hoanthanh=<?php echo $row_donhang['id'] ?>"> Hoàn thành</a></td>
						</tr>
					<?php
						}else{
					?>
							<td>--</td>
							<td><?php echo $row_donhang['date'] ?></td>

							<td><?php echo $row_donhang['address'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><?php
								if ($row_donhang['payment_status'] == 0) {
									echo 'Chưa thanh toán';
								} else if ($row_donhang['payment_status'] == 1) {
									echo 'Đã thanh toán';
								}
								?></td>
							<td><a href="?huydon=<?php echo $row_donhang['id'] ?>">Hủy</a> || <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['id'] ?>"> Xem chi tiết </a>|| <a href="?giao=<?php echo $row_donhang['id'] ?>"> Giao</a></td>
						<?php
						}
					}
					?>
				</table>
			</div>

			<div class="col-md-12">
				<h4 align="center">DANH SÁCH TẤT CẢ ĐƠN HÀNG ĐÃ XỬ LÍ</h4>
				<?php
				$sql_select = mysqli_query($con, "SELECT * FROM tbl_order WHERE order_status = '1' and date = '$today'");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã đơn hàng</th>
						<th>Tình trạng đơn hàng</th>
						<th>Tên khách hàng</th>
						<th>Thời gian đặt</th>
						<th>Địa chỉ</th>
						<th>TỔNG TIỀN</th>
						<th>Tình trạng thanh toán</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while ($row_donhang = mysqli_fetch_array($sql_select)) {
						$madon = $row_donhang['id'];

						$sql_chitietdon = mysqli_query($con, "SELECT * FROM tbl_order_detail WHERE id='$madon' ");
						$tong = 0;
						while ($row_chitiet =  mysqli_fetch_array($sql_chitietdon)) {
							$monan_id = $row_chitiet['product_id'];
							$sql_monan = mysqli_query($con, "SELECT * FROM tbl_product WHERE id ='$monan_id' ");
							if ($row_monan =  mysqli_fetch_array($sql_monan)) {
								$giamon = $row_monan['price'];
								$tong +=  $giamon * $row_chitiet['quantity'];
							}
						}
						$i++;
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_donhang['id']; ?></td>
							<td><?php
								if ($row_donhang['order_status'] == 0) {
									echo 'Chưa xử lý';
								} else if ($row_donhang['order_status'] == 1) {
									echo 'Đã hoàn thành';
								} else if ($row_donhang['order_status'] == 2) {
									echo 'Đang giao hàng';
								} else {
									echo 'Đã hủy';
								}
								?></td>
							<?php
							$user__id = $row_donhang['user_id'];
							$sql_user =	mysqli_query($con, "SELECT * FROM tbl_user_account WHERE id = '$user__id'");
							if($row_user = mysqli_fetch_array($sql_user)){							
							?>
							<td><?php echo $row_user['fullname'] ?></td>
							<td><?php echo $row_donhang['date'] ?></td>

							<td><?php echo $row_donhang['address'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><?php
								if ($row_donhang['payment_status'] == 0) {
									echo 'Chưa thanh toán';
								} else if ($row_donhang['payment_status'] == 1) {
									echo 'Đã thanh toán';
								}
								?></td>
							<td><a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['id'] ?>"> Xem chi tiết </a></td>
						</tr>
					<?php
						}else{
					?>
							<td>--</td>
							<td><?php echo $row_donhang['date'] ?></td>

							<td><?php echo $row_donhang['address'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><?php
								if ($row_donhang['payment_status'] == 0) {
									echo 'Chưa thanh toán';
								} else if ($row_donhang['payment_status'] == 1) {
									echo 'Đã thanh toán';
								}
								?></td>
							<td><a href="?huydon=<?php echo $row_donhang['id'] ?>">Hủy</a> || <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['id'] ?>"> Xem chi tiết </a>|| <a href="?giao=<?php echo $row_donhang['id'] ?>"> Giao</a></td>
						<?php
						}
					}
					?>
				</table>
			</div>


			<div class="col-md-12">
				<h4 align="center">DANH SÁCH TẤT CẢ ĐƠN HÀNG ĐÃ HỦY</h4>
				<?php
				$sql_select = mysqli_query($con, "SELECT * FROM tbl_order WHERE order_status = '3' and date = '$today'");
				?>
				<table class="table table-bordered ">
					<tr>
						<th>Thứ tự</th>
						<th>Mã đơn hàng</th>
						<th>Tình trạng đơn hàng</th>
						<th>Tên khách hàng</th>
						<th>Thời gian đặt</th>
						<th>Địa chỉ</th>
						<th>TỔNG TIỀN</th>
						<th>Tình trạng thanh toán</th>
						<th>Quản lý</th>
					</tr>
					<?php
					$i = 0;
					while ($row_donhang = mysqli_fetch_array($sql_select)) {
						$madon = $row_donhang['id'];

						$sql_chitietdon = mysqli_query($con, "SELECT * FROM tbl_order_detail WHERE id='$madon' ");
						$tong = 0;
						while ($row_chitiet =  mysqli_fetch_array($sql_chitietdon)) {
							$monan_id = $row_chitiet['product_id'];
							$sql_monan = mysqli_query($con, "SELECT * FROM tbl_product WHERE id ='$monan_id' ");
							if ($row_monan =  mysqli_fetch_array($sql_monan)) {
								$giamon = $row_monan['price'];
								$tong +=  $giamon * $row_chitiet['quantity'];
							}
						}
						$i++;
					?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $row_donhang['id']; ?></td>
							<td><?php
								if ($row_donhang['order_status'] == 0) {
									echo 'Chưa xử lý';
								} else if ($row_donhang['order_status'] == 1) {
									echo 'Đã hoàn thành';
								} else if ($row_donhang['order_status'] == 2) {
									echo 'Đang giao hàng';
								} else {
									echo 'Đã hủy';
								}
								?></td>
							<?php
							$user__id = $row_donhang['user_id'];
							$sql_user =	mysqli_query($con, "SELECT * FROM tbl_user_account WHERE id = '$user__id'");
							if($row_user = mysqli_fetch_array($sql_user)){							
							?>
							<td><?php echo $row_user['fullname'] ?></td>
							<td><?php echo $row_donhang['date'] ?></td>

							<td><?php echo $row_donhang['address'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><?php
								if ($row_donhang['payment_status'] == 0) {
									echo 'Chưa thanh toán';
								} else if ($row_donhang['payment_status'] == 1) {
									echo 'Đã thanh toán';
								}
								?></td>
							<td><a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['id'] ?>"> Xem chi tiết </a>|| <a href="?giao=<?php echo $row_donhang['id'] ?>"> Giao</a></td>
						</tr>
					<?php
						}else{
					?>
							<td>--</td>
							<td><?php echo $row_donhang['date'] ?></td>

							<td><?php echo $row_donhang['address'] ?></td>
							<td><?php echo $tong ?>$</td>
							<td><?php
								if ($row_donhang['payment_status'] == 0) {
									echo 'Chưa thanh toán';
								} else if ($row_donhang['payment_status'] == 1) {
									echo 'Đã thanh toán';
								}
								?></td>
							<td><a href="?huydon=<?php echo $row_donhang['id'] ?>">Hủy</a> || <a href="?quanly=xemdonhang&madonhang=<?php echo $row_donhang['id'] ?>"> Xem chi tiết </a>|| <a href="?giao=<?php echo $row_donhang['id'] ?>"> Giao</a></td>
						<?php
						}
					}
					?>
				</table>
			</div>
		</div>
	</div>

</body>

</html>