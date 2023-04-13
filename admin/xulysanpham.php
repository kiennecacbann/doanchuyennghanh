<?php
include('../db/connect.php');
session_start();
?>
<?php
if (isset($_POST['themsanpham'])) {
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $gia = $_POST['giasanpham'];
    $danhmuc = $_POST['danhmuc'];
    $path = '../image/';
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name']; 
    $mota = $_POST['mota'];

    $sql_monan	= mysqli_query($con, "SELECT name FROM tbl_product WHERE name ='$tensanpham'");
    $sql_monan1	= mysqli_query($con, "SELECT image FROM tbl_product WHERE image ='$hinhanh'");   
	$row_monan = mysqli_fetch_array($sql_monan);
    $row_monan1 = mysqli_fetch_array($sql_monan1);

        if($gia <= '0' || $gia == ''){
            echo '<script language="javascript">';
            echo 'alert("Giá bán không hợp lệ")';
            echo '</script>';       
        }else if($hinhanh== ''){
            echo '<script language="javascript">';
            echo 'alert("Không tìm thấy ảnh")';
            echo '</script>';       
        }else if($tensanpham == ''){
            echo '<script language="javascript">';
            echo 'alert("Tên không hợp lệ")';
            echo '</script>';       
        }else if($danhmuc == '0'){
            echo '<script language="javascript">';
            echo 'alert("Danh mục chưa được chọn")';
            echo '</script>';
        }else if($mota == ''){
            echo '<script language="javascript">';
            echo 'alert("Mô tả không được để trống")';
            echo '</script>';
        }else if(isset($row_monan1)){
            echo '<script language="javascript">';
            echo 'alert("Ảnh đã được sử dụng")';
            echo '</script>';
        }else if(isset($row_monan)){
            echo '<script language="javascript">';
            echo 'alert("Tên món đã tồn tại")';
            echo '</script>';
        }
        else{
            $sql_insert_product = mysqli_query($con, "INSERT INTO tbl_product(name,price,image,category_id,details) values ('$tensanpham','$gia','$hinhanh','$danhmuc',',$mota')");
        move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
        }
    
}else if(isset($_POST['capnhatsanpham'])) {
    $id_update = $_POST['id_update'];
    $tensanpham = $_POST['tensanpham'];
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $gia = $_POST['giasanpham'];
    $danhmuc = $_POST['danhmuc'];
    $path = '../image/';
    $hinhanh1 = '';
    $mota = $_POST['mota'];
    $sql_monan	= mysqli_query($con, "SELECT name FROM tbl_product WHERE name ='$tensanpham'");  
    
    $sql_monan1	= mysqli_query($con, "SELECT image FROM tbl_product WHERE image ='$hinhanh'");   
     
    $sql_monan2 = mysqli_query($con, "SELECT name,image,details FROM tbl_product WHERE id = '$id_update' ");
    if($row_monan1 = mysqli_fetch_array($sql_monan2)){
        $hinhanh1 = $row_monan1['image'];
        $tensanpham1 = $row_monan1['name'];
        $mota1 = $row_monan1['details'];
    }
        
               
    if($gia <= '0' || $gia == ''){
        echo '<script language="javascript">';
        echo 'alert("Giá bán không hợp lệ")';
        echo '</script>';       
    }else if($tensanpham == ''){
        echo '<script language="javascript">';
        echo 'alert("Tên không hợp lệ")';
        echo '</script>';       
    }else if($danhmuc == '0'){
        echo '<script language="javascript">';
        echo 'alert("Danh mục chưa được chọn")';
        echo '</script>';
    }else if(($row_monan = mysqli_fetch_array($sql_monan1)) && ($hinhanh != $hinhanh1)){
        echo '<script language="javascript">';
        echo 'alert("Ảnh đã được sử dụng")';
        echo '</script>';
    }else if(($row_monan = mysqli_fetch_array($sql_monan)) && ($tensanpham!=$tensanpham1)){
        echo '<script language="javascript">';
        echo 'alert("Tên món đã tồn tại")';
        echo '</script>';
    }else if($mota == '' && $mota1 == ''){
        echo '<script language="javascript">';
        echo 'alert("Mô tả không được để trống")';
        echo '</script>';
    }else{
        if($hinhanh == ''){           
            $sql_update_image = "UPDATE tbl_product SET name='$tensanpham',price='$gia',image='$hinhanh1',category_id='$danhmuc',details='$mota' WHERE id='$id_update'";
            mysqli_query($con, $sql_update_image);
        }else{
            move_uploaded_file($hinhanh_tmp, $path . $hinhanh);
            $sql_update_image = "UPDATE tbl_product SET name='$tensanpham',price='$gia',image='$hinhanh',category_id='$danhmuc',details='$mota' WHERE id='$id_update'";
            mysqli_query($con, $sql_update_image);
            }
        }            
}
?>
<?php
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $sql_xoa = mysqli_query($con, "DELETE FROM tbl_product WHERE id='$id'");
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all" />
    <title>Sản Phẩm</title>
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
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET['quanly']) == 'capnhat') {
                $id_capnhat = $_GET['capnhat_id'];
                $sql_capnhat = mysqli_query($con, "SELECT * FROM tbl_product WHERE id='$id_capnhat'");
                $row_capnhat = mysqli_fetch_array($sql_capnhat);
                $id_category_1 = $row_capnhat['category_id'];
            ?>
                <div class="col-md-4">
                    <h4>Lưu chỉnh sửa</h4>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="tensanpham" value="<?php echo $row_capnhat['name'] ?>"><br>
                        <input type="hidden" class="form-control" name="id_update" value="<?php echo $row_capnhat['id'] ?>">
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <img src="../image/<?php echo $row_capnhat['image'] ?>" height="80" width="80"><br>
                        <label>Giá</label>
                        <input type="text" class="form-control" name="giasanpham" value="<?php echo $row_capnhat['price'] ?>"><br>
                        <label>Mô tả</label>
                        <input type="text" class="form-control" name="mota" value="<?php echo $row_capnhat['details'] ?>"><br>
                        <label>Danh mục</label>
                        <?php
                        $sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY id DESC");
                        ?>
                        <select name="danhmuc" class="form-control">
                            <option value="0">-----Chọn danh mục-----</option>
                            <?php
                            while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                                if ($id_category_1 == $row_danhmuc['id']) {
                            ?>
                                    <option selected value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                                <?php
                                } else {
                                ?>
                                    <option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select><br>
                        <input type="submit" name="capnhatsanpham" value="Cập nhật sản phẩm" class="btn btn-default">
                    </form>
                </div>
            <?php
            } else {
            ?>
                <div class="col-md-4">
                    <h4>Thêm sản phẩm</h4>

                    <form action="" method="POST" enctype="multipart/form-data">
                        <label>Tên sản phẩm</label>
                        <input type="text" class="form-control" name="tensanpham" placeholder="Tên sản phẩm"><br>
                        <label>Hình ảnh</label>
                        <input type="file" class="form-control" name="hinhanh"><br>
                        <label>Giá</label>
                        <input type="text" class="form-control" name="giasanpham" placeholder="Giá sản phẩm"><br>
                        <input type="text" class="form-control" name="mota" placeholder="Mô tả sản phẩm"><br>
                        <label>Danh mục</label>
                        <?php
                        $sql_danhmuc = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY id DESC");
                        ?>
                        <select name="danhmuc" class="form-control">
                            <option value="0">-----Chọn danh mục-----</option>
                            <?php
                            while ($row_danhmuc = mysqli_fetch_array($sql_danhmuc)) {
                            ?>
                                <option value="<?php echo $row_danhmuc['id'] ?>"><?php echo $row_danhmuc['category_name'] ?></option>
                            <?php
                            }
                            ?>
                        </select><br>
                        <input type="submit" name="themsanpham" value="Thêm sản phẩm" class="btn btn-default">
                    </form>
                </div>
            <?php
            }

            ?>
            <div class="col-md-12">
                <h4>Liệt kê sản phẩm</h4>
                <?php
                $sql_select_sp = mysqli_query($con, "SELECT tbl_product.id, name, image, price, category_id, category_name,details FROM tbl_product, tbl_category WHERE tbl_product.category_id=tbl_category.id ORDER BY tbl_product.id DESC");
                ?>
                <table class="table table-bordered ">
                    <tr>
                        <th style="width:70px">Thứ tự</th>
                        <th style="width:70px">Tên sản phẩm</th>
                        <th style="width:70px">Hình ảnh</th>
                        <th style="width:70px">Danh mục</th>
                        <th style="width:70px">Giá</th>
                        <th style="width:150px">Mô tả</th>
                        <th style="width:70px">Quản lý</th>
                    </tr>
                    <?php
                    $i = 0;
                    while ($row_sp = mysqli_fetch_array($sql_select_sp)) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $row_sp['name'] ?></td>
                            <td><img src="../image/<?php echo $row_sp['image'] ?>" height="100" width="80"></td>
                            <td><?php echo $row_sp['category_name'] ?></td>
                            <td><?php echo number_format($row_sp['price']) . '$' ?></td>
                            <td><?php echo $row_sp['details']?></td>
                            <td><a href="?xoa=<?php echo $row_sp['id'] ?>">Xóa</a> || <a href="xulysanpham.php?quanly=capnhat&capnhat_id=<?php echo $row_sp['id'] ?>">Sửa</a></td>
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