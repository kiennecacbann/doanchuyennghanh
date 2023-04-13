<?php
session_start();
include('../db/connect.php')
?>
<?php
if (isset($_POST['dangky_home'])) {
    $kh_user = $_POST['kh_user'];
    $kh_password = md5($_POST['kh_password']);
    $confirm_password = $_POST['kh_repeatps'];
    $kh_fullname = $_POST['kh_fullname'];
    $kh_sdt = $_POST['kh_sdt'];
    $kh_email = $_POST['kh_email'];

    $check = mysqli_query($con, "SELECT*FROM tbl_user_account WHERE email='$kh_email' or username='$kh_user'");
    $count = mysqli_num_rows($check);
    $check1 = mysqli_query($con, "SELECT*FROM tbl_user_account WHERE email='$kh_email'");
    $count1 = mysqli_num_rows($check1);
    $check2 = mysqli_query($con, "SELECT*FROM tbl_user_account WHERE username='$kh_user'");
    $count2 = mysqli_num_rows($check2);
    if ($count > 0) {
        if ($count1 > 0 && $count2 > 0) {
            echo '<script language="javascript">';
            echo 'alert("Email and ID has already been used!")';
            echo '</script>';
        }

        if ($count1 > 0 && $count2  <= 0) {
            echo '<script language="javascript">';
            echo 'alert("Email has already been used!")';
            echo '</script>';
        }
        if ($count2 > 0 && $count1  <= 0) {
            echo '<script language="javascript">';
            echo 'alert("ID has already been used!")';
            echo '</script>';
        }
    } else {
        if($confirm_password != $_POST['kh_password']){
            echo '<script language="javascript">';
            echo 'alert("Confirm password does not match your password!")';
            echo '</script>';
        }else{
            $sql_insert_dangky = mysqli_query($con, "INSERT INTO tbl_user_account(username,password,fullname,phone_number,email)
            values('$kh_user','$kh_password','$kh_fullname','$kh_sdt','$kh_email')");
            //$check = mysqli_query($con, $sql_insert_dangky);
            //$check = $sql_insert_dangky;
            echo '<script language="javascript">';
            echo 'alert("Bạn đã đăng ký thành công!")';
            echo '</script>';
            echo '<meta http-equiv="refresh" content="0;url=index.php">';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/webstyle.css">
</head>
<body>
    <div class="register">
     <div class="register-content">
        <a href="index.php">
        <span class="close" title="Close Modal">&times;</span>
        </a>
            <form class="register-form" method="post">
                <h1>Welcome To Bees Restaurant</h1>
                <p>Please fill in this form to create an account.</p>
                <hr>
                <div class="signup-input">
                    <input type="text" placeholder="Full name" name="kh_fullname" required>
                    <input type="text" placeholder="Enter your mail" name="kh_email" required>
                    <input type="text" placeholder="Enter your phone number" name="kh_sdt" required>
                    <input type="text" placeholder="Enter user name" name="kh_user" required>
                    <input type="password" placeholder="Enter password" name="kh_password" required>
                    <input type="password" placeholder="Confirm your password" name="kh_repeatps" required>
                </div>
    
                <label>
                    <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px">
                    Remember me
                </label>
    
                <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms &
                        Privacy</a>.</p>
    
                <div class="clearfix">
                    <a href="index.php"><button class="signupbtn">Cancel</button></a>
                    <button type="submit" class="signupbtn" name="dangky_home">Sign Up</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<script src="../assets/js/webscript.js"></script>