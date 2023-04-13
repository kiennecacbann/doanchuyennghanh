<?php
include('../db/connect.php');
session_start();
use PHPMailer\PHPMailer\PHPMailer;
?>
<?php
if (isset($_POST['capnhatdonhang'])) {
	$xuly = $_POST['xuly'];
	$madondatban = $_POST['madondatban_xuly'];
	$sql_update_donhang = mysqli_query($con, "UPDATE tbl_donhang SET tinhtrang='$xuly' WHERE madonhang='$madonhang'");
}

?>
<?php
if (isset($_GET['xoadondatban'])) {
	$madondatban = $_GET['xoadondatban'];
	$sql_delete = mysqli_query($con, "DELETE FROM tbl_table_booking WHERE id='$madondatban'");
	header('Location:xulydondatban.php');
}
if (isset($_GET['xacnhanhuy'])) {
	$huydon = $_GET['xacnhanhuy'];
	$sql_update = mysqli_query($con, "UPDATE tbl_table_booking SET status = '3' WHERE id='$huydon'");
	header('Location:xulydondatban.php');
}if (isset($_GET['duyetdon'])) {
	$duyetdon = $_GET['duyetdon'];
	$room_id = $_GET['room_id'];
	$table_needed = 0;
	$sql_select_booking = mysqli_query($con, "SELECT current_table,aop,table_amount,table_cat FROM tbl_room,tbl_table_booking  WHERE tbl_table_booking.room_id=tbl_room.id and tbl_room.id = '$room_id' ");
	while($row_room = mysqli_fetch_array($sql_select_booking)){
		$current_table = $row_room['current_table'];
		$table_amount = $row_room['table_amount'];
		$aop = $row_room['aop'];	
		$tbl_cat = $row_room['table_cat'];
	}	
	if($current_table < $table_amount ){
			$table_needed = $aop / $tbl_cat;					
	}
	if(($table_needed+$current_table)<$table_amount){
		$current_table_update = $table_needed + $current_table;
		$sql_update_booking = mysqli_query($con, "UPDATE tbl_table_booking SET status = '2' WHERE id='$duyetdon'");
		$sql_update_room = mysqli_query($con, "UPDATE tbl_room SET current_table = '$current_table_update' WHERE id='$room_id'");
		$sql_select_user = mysqli_query($con, "SELECT * FROM tbl_table_booking,tbl_user_account WHERE tbl_table_booking.user_id=tbl_user_account.id and tbl_table_booking.id='$duyetdon'");
		$row_user = mysqli_fetch_array($sql_select_user);
		$email = $row_user['email'];
		$name = "BEE-restaurant";  // Name of your website or yours
        $to = $email;  // mail of reciever
        $subject = "Your table booking confirm code has arrived";
        $body = 'Ma don:'.$duyetdon . ',Loai ban:'.$tbl_cat.'nguoi,so luong khach:'.$aop;
        //$body = file_get_contents('forgotpass.php');
        $from = "saeyoshino2901@gmail.com";  // you mail
        $password = "yxvtfxnntokwxzst";  // your mail password

        // Ignore from here
		require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";
        $mail = new PHPMailer();
        // To Here

        //SMTP Settings
        $mail->isSMTP();
        // $mail->SMTPDebug = 3;  Keep It commented this is used for debugging                          
        $mail->Host = "smtp.gmail.com"; // smtp address of your email
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $password;
        $mail->Port = 587;  // port
        $mail->SMTPSecure = "tls";  // tls or ssl
        $mail->smtpConnect([
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            ]
        ]);

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($from, $name);
        $mail->addAddress($to); // enter email address whom you want to send
        $mail->Subject = ("$subject");
        $mail->Body = $body;
        if ($mail->send()) {
            //echo "Email is sent!";
        } else {
           // echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }		
	}else{
		echo '<script language="javascript">';
		echo 'alert("Hiện tại không đủ bàn")';
		echo '</script>';   
	}

}
	

if (isset($_GET['xacnhanhuy1'])) {
	$xacnhanhuy = $_GET['xacnhanhuy1'];
	$room_id = $_GET['room_id'];
	$table_needed = 0;
	$sql_select_booking = mysqli_query($con, "SELECT current_table,aop,table_amount,table_cat FROM tbl_room,tbl_table_booking  WHERE tbl_table_booking.room_id=tbl_room.id and tbl_room.id = '$room_id' ");
	while($row_room = mysqli_fetch_array($sql_select_booking)){
		$current_table = $row_room['current_table'];
		$table_amount = $row_room['table_amount'];
		$aop = $row_room['aop'];	
		$tbl_cat = $row_room['table_cat'];
	}	
	$table_needed = $aop / $tbl_cat;					

	if(($current_table - $table_needed) <= 0){
		$sql_update_booking = mysqli_query($con, "UPDATE tbl_table_booking SET status = '3' WHERE id='$xacnhanhuy '");
		$sql_update_room = mysqli_query($con, "UPDATE tbl_room SET current_table = 0 WHERE id='$room_id '");
		header('Location:xulydondatban.php');
	}else{
		$current_table_update = $current_table - $table_needed;
		$sql_update_booking = mysqli_query($con, "UPDATE tbl_table_booking SET status = '3' WHERE id='$xacnhanhuy '");
		$sql_update_room = mysqli_query($con, "UPDATE tbl_room SET current_table ='$current_table_update' WHERE id='$room_id'");
		header('Location:xulydondatban.php');
	}
	
}
if (isset($_GET['hoanthanh'])) {
	$xacnhanhuy = $_GET['hoanthanh'];
	$room_id = $_GET['room_id'];
	$table_needed = 0;
	$sql_select_booking = mysqli_query($con, "SELECT current_table,aop,table_amount,table_cat FROM tbl_room,tbl_table_booking  WHERE tbl_table_booking.room_id=tbl_room.id and tbl_room.id = '$room_id' ");
	while($row_room = mysqli_fetch_array($sql_select_booking)){
		$current_table = $row_room['current_table'];
		$table_amount = $row_room['table_amount'];
		$aop = $row_room['aop'];	
		$tbl_cat = $row_room['table_cat'];
	}	
	$table_needed = $aop / $tbl_cat;					

	if(($current_table - $table_needed) <= 0){
		$sql_update_booking = mysqli_query($con, "UPDATE tbl_table_booking SET status = '1' WHERE id='$xacnhanhuy '");
		$sql_update_room = mysqli_query($con, "UPDATE tbl_room SET current_table = 0 WHERE id='$room_id '");
		header('Location:xulydondatban.php');
	}else{
		$current_table_update = $current_table - $table_needed;
		$sql_update_booking = mysqli_query($con, "UPDATE tbl_table_booking SET status = '1' WHERE id='$xacnhanhuy '");
		$sql_update_room = mysqli_query($con, "UPDATE tbl_room SET current_table ='$current_table_update' WHERE id='$room_id'");
		header('Location:xulydondatban.php');
	}
	
}   else {
	$huydon = '';
	$magiaodich = '';
}


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
			if (isset($_GET['xemdondatban'])) {
				$madonhang = $_GET['xemdondatban'];
				$sql_acckh = mysqli_query($con, "SELECT * FROM tbl_table_booking  WHERE tbl_table_booking.id = '$madondatban'");
			?>
				<div class="col-md-12">
					<h4 align="center" >DANH SÁCH ĐƠN ĐẶT BÀN</h4>
					<form action="" method="POST">
						<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hàng</th>
								<th>SĐT khách hàng</th>
								<th>Địa chỉ mail</th>	
								<th>Tên tài khoản</th>							
							</tr>
							<?php
							$i = 0;
							while ($row_kh = mysqli_fetch_array($sql_acckh)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_donhang['fullname']; ?></td>
									<td><?php echo $row_donhang['phone_number']; ?></td>
									<td><?php echo $row_donhang['email']; ?></td>
									<td><?php echo $row_donhang['username']; ?></td>										
									<input type="hidden" name="khachhang_xuly" value="<?php echo $row_kh['id'] ?>">
								</tr>
							<?php
							}
							?>
						</table>
					</form>
				</div>
			<?php
			}
			?>
			<div class="col-md-12">
				<h4 align="center">DANH SÁCH ĐƠN ĐẶT BÀN</h4>
				<?php
				$sql_acckh = mysqli_query($con, "SELECT fullname,date,status,tbl_table_booking.id,room_id FROM tbl_table_booking,tbl_user_account Where tbl_table_booking.user_id=tbl_user_account.id and status = 0 ORDER BY tbl_table_booking.date ASC ");
				?>
				<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hàng</th>	
								<th>Mã xác nhận đơn</th>	
								<th>Ngày đặt</th>
								<th>Trạng thái</th>	
								<th>Quản lí</th>					
							</tr>
							<?php
							$i = 0;
							while ($row_dondatban = mysqli_fetch_array($sql_acckh)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_dondatban ['fullname']; ?></td>
									<td><?php echo $row_dondatban ['id']; ?></td>	
									<td><?php echo $row_dondatban ['date']; ?></td>																			
									<td><?php
									if ($row_dondatban['status'] == 0) {
										echo 'Chưa xử lí';
									} else if ($row_dondatban['status'] == 1) {
										echo 'Đã hoàn thành';
									}else if ($row_dondatban['status'] == 2) {
										echo 'Đã duyệt';
									}else if ($row_dondatban['status'] == 3) {
										echo 'Đã hủy';
									}
								?>	</td>
								<?php
								?>
								<td><a href="?xacnhanhuy=<?php echo $row_dondatban['id']?>">Hủy đơn</a> || <a href="?duyetdon=<?php echo $row_dondatban['id'] ?>&room_id=<?php echo $row_dondatban['room_id']?>">Duyệt</a></td>						
								</tr>
							<?php
							}
							?>
				</table>
			</div>
			<div class="col-md-12">
				<h4 align="center">DANH SÁCH ĐƠN ĐANG ĐỢI NHẬN BÀN</h4>
				<?php
				$sql_acckh = mysqli_query($con, "SELECT fullname,date,status,tbl_table_booking.id,room_id FROM tbl_table_booking,tbl_user_account Where tbl_table_booking.user_id=tbl_user_account.id and status = 2 ORDER BY tbl_table_booking.date ASC ");
				?>
				<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hàng</th>	
								<th>Mã xác nhận đơn</th>	
								<th>Ngày đặt</th>
								<th>Trạng thái</th>	
								<th>Quản lí</th>					
							</tr>
							<?php
							$i = 0;
							while ($row_dondatban = mysqli_fetch_array($sql_acckh)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_dondatban ['fullname']; ?></td>
									<td><?php echo $row_dondatban ['id']; ?></td>	
									<td><?php echo $row_dondatban ['date']; ?></td>																			
									<td><?php
									if ($row_dondatban['status'] == 0) {
										echo 'Chưa xử lí';
									} else if ($row_dondatban['status'] == 1) {
										echo 'Đã hoàn thành';
									}else if ($row_dondatban['status'] == 2) {
										echo 'Đã duyệt';
									}else if ($row_dondatban['status'] == 3) {
										echo 'Đã hủy';
									}
								?>	</td>
								<?php
								?>
								<td><a href="?xacnhanhuy1=<?php echo $row_dondatban['id'] ?>&room_id=<?php echo $row_dondatban['room_id']?>">HỦY ĐƠN</a>||<a href="?hoanthanh=<?php echo $row_dondatban['id'] ?>&room_id=<?php echo $row_dondatban['room_id']?>">HOÀN THÀNH</a></td>						
								</tr>
							<?php
							}
							?>
				</table>
			</div>

			<div class="col-md-12">
				<h4 align="center">DANH SÁCH HỦY</h4>
				<?php
				$sql_acckh = mysqli_query($con, "SELECT fullname,date,status,tbl_table_booking.id,room_id FROM tbl_table_booking,tbl_user_account Where tbl_table_booking.user_id=tbl_user_account.id and status = 3 ORDER BY tbl_table_booking.date ASC ");
				?>
				<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hàng</th>	
								<th>Mã xác nhận đơn</th>	
								<th>Ngày đặt</th>
								<th>Trạng thái</th>						
							</tr>
							<?php
							$i = 0;
							while ($row_dondatban = mysqli_fetch_array($sql_acckh)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_dondatban ['fullname']; ?></td>
									<td><?php echo $row_dondatban ['id']; ?></td>	
									<td><?php echo $row_dondatban ['date']; ?></td>																			
									<td><?php
									if ($row_dondatban['status'] == 0) {
										echo 'Chưa xử lí';
									} else if ($row_dondatban['status'] == 1) {
										echo 'Đã hoàn thành';
									}else if ($row_dondatban['status'] == 2) {
										echo 'Đã duyệt';
									}else if ($row_dondatban['status'] == 3) {
										echo 'Đã hủy';
									}
								?>	</td>
								<?php
								?>			
								</tr>
							<?php
							}
							?>
				</table>
			</div>
			<div class="col-md-12">
				<h4 align="center">DANH SÁCH ĐƠN HOÀN THÀNH</h4>
				<?php
				$sql_acckh = mysqli_query($con, "SELECT fullname,date,status,tbl_table_booking.id,room_id FROM tbl_table_booking,tbl_user_account Where tbl_table_booking.user_id=tbl_user_account.id and status = 1 ORDER BY tbl_table_booking.date ASC ");
				?>
				<table class="table table-bordered ">
							<tr>
								<th>Thứ tự</th>
								<th>Tên khách hàng</th>	
								<th>Mã xác nhận đơn</th>	
								<th>Ngày đặt</th>
								<th>Trạng thái</th>	
												
							</tr>
							<?php
							$i = 0;
							while ($row_dondatban = mysqli_fetch_array($sql_acckh)) {
								$i++;
							?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $row_dondatban ['fullname']; ?></td>
									<td><?php echo $row_dondatban ['id']; ?></td>	
									<td><?php echo $row_dondatban ['date']; ?></td>																			
									<td><?php
									if ($row_dondatban['status'] == 0) {
										echo 'Chưa xử lí';
									} else if ($row_dondatban['status'] == 1) {
										echo 'Đã hoàn thành';
									}else if ($row_dondatban['status'] == 2) {
										echo 'Đã duyệt';
									}else if ($row_dondatban['status'] == 3) {
										echo 'Đã hủy';
									}
								?>	</td>
								<?php
								?>
								</tr>
							<?php
							}
							?>
				</table>
			</div>
		</div>
	</div>

</body>

</html>