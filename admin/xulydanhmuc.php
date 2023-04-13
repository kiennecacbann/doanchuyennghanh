<?php
include('../db/connect.php');
session_start();
?>
<?php
if (isset($_POST['themdanhmuc'])) {
    $tendanhmuc = $_POST['danhmuc'];
    
    if($tendanhmuc == ''){
        echo '<script language="javascript">';
        echo 'alert("Tên danh mục không được để trống")';
        echo '</script>';
    }else{
        $sql_select = mysqli_query($con, "SELECT id from tbl_category WHERE category_name = '$tendanhmuc'");       
        if(mysqli_fetch_array($sql_select)){
            echo '<script language="javascript">';
            echo 'alert("Danh mục đã tồn tại")';
            echo '</script>';
        }else{
            $sql_insert = mysqli_query($con, "INSERT INTO tbl_category(category_name) values ('$tendanhmuc')");
            echo '<script language="javascript">';
            echo 'alert("Danh mục đã được thêm thành công")';
            echo '</script>';
        }
    }
    
    
} elseif (isset($_POST['capnhatdanhmuc'])) {
   
    $id_post = $_POST['id_danhmuc'];
    $tendanhmuc = $_POST['danhmuc'];
    if($tendanhmuc == ''){
        echo '<script language="javascript">';
        echo 'alert("Tên danh mục không được để trống")';
        echo '</script>';
    }else{
        $sql_select = mysqli_query($con, "SELECT id from tbl_category WHERE category_name = '$tendanhmuc'");
    if(mysqli_fetch_array($sql_select)){
        echo '<script language="javascript">';
        echo 'alert("Tên danh mục đã tồn tại")';
        echo '</script>';
    }else{
        $sql_update = mysqli_query($con, "UPDATE tbl_category SET category_name='$tendanhmuc' WHERE id ='$id_post'");
        echo '<script language="javascript">';
        echo 'alert("Danh mục đã được cập nhật thành công")';
        echo '</script>';        
    }
    }   
}
if (isset($_GET['xoa'])) {
    $id = $_GET['xoa'];
    $sql_xoa = mysqli_query($con, "DELETE FROM tbl_category WHERE id='$id'");
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
    <title>Danh Mục</title>
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
                $id_capnhat = $_GET['id'];
                $sql_capnhat = mysqli_query($con, "SELECT * FROM tbl_category WHERE id='$id_capnhat'");
                $row_capnhat = mysqli_fetch_array($sql_capnhat);
            ?>
                <div class="col-md-4">
                    <h4>Cập nhật danh mục</h4>
                    <label>Tên danh mục</label>
                    <form action="" method="POST">
                        <input type="text" class="form-control" name="danhmuc" value="<?php echo $row_capnhat['category_name'] ?>"><br>
                        <input type="hidden" class="form-control" name="id_danhmuc" value="<?php echo $row_capnhat['id'] ?>">

                        <input type="submit" name="capnhatdanhmuc" value="Cập nhật danh mục" class="btn btn-default">
                    </form>
                </div>
            <?php
            } else {
            ?>
                <div class="col-md-4">
                    <h4>Thêm danh mục</h4>
                    <label>Tên danh mục</label>
                    <form action="" method="POST">
                        <input type="text" class="form-control" name="danhmuc" placeholder="Tên danh mục"><br>
                        <input type="submit" name="themdanhmuc" value="Thêm danh mục" class="btn btn-default">
                    </form>
                </div>
            <?php
            }

            ?>
            <div class="col-md-8">
                <h4>Liệt kê danh mục</h4>
                <?php
                $sql_select = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY id DESC");
                ?>
                <table class="table table-bordered ">
                    <tr>
                        <th>Thứ tự</th>
                        <th>Tên danh mục</th>
                        <th>Quản lý</th>
                    </tr>
                    <?php
                    $i = 0;
                    while ($row_category = mysqli_fetch_array($sql_select)) {
                        $i++;
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row_category['category_name'] ?></td>
                            <td><a href="?xoa=<?php echo $row_category['id'] ?>">Xóa</a> || <a href="?quanly=capnhat&id=<?php echo $row_category['id'] ?>">Cập nhật</a></td>
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