<?php
session_start();
include "../db/connect.php";
include "./loginwgg.php";

if (isset($_POST['dangnhap_home'])) {
    $kh_user = $_POST['kh_user'];
    $kh_password = md5($_POST['kh_password']);
    if ($kh_user == '' || $kh_password == '') {
        echo '<script language="javascript">';
        echo 'alert("Tài khoản hoặc mật khẩu không được để trống!")';
        echo '</script>';
    } else {
        $sql_select_dangnhap = mysqli_query($con, "SELECT*FROM tbl_user_account WHERE username='$kh_user' AND password='$kh_password'");
        $count = mysqli_num_rows($sql_select_dangnhap);
        $row_login = mysqli_fetch_array($sql_select_dangnhap);
        if ($count > 0) {
            $_SESSION['dangnhap_home'] = $row_login['fullname'];
            $_SESSION['khachhang_id'] = $row_login['id'];
            $_SESSION['khachhang_email'] = $row_login['email'];
            echo '<script language="javascript">';
            echo 'alert("Welcome to Restaurant!")';
            echo '</script>';
        } else {
            echo '<script language="javascript">';
            echo 'alert("Something wrong with your user name or password!")';
            echo '</script>';
            //header('Location:login.php') 
            echo '<meta http-equiv="refresh" content="5;url=login.php">';
        }
    }
}
?>

<?php
if (!isset($_SESSION['dangnhap_home'])) {
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

<body>
    <section class="top">
        <div class="container">
            <div class="row justify-content">
                <div class="logo"><a href="#home"><img src="../image/logo.png" alt=""></a></div>
                <div class="logout">
                    <p>XIN CHÀO : <?php echo $_SESSION['dangnhap_home'] ?> </p>
                    <a href="?loginn=logout" onclick="return confirm('logout from this website?');"> <button class="logout-button">LOG OUT</button></a>
                </div>
                <div class="cart"><a href="cart.php"><i class="fas fa-shopping-cart"></i><span></span></a></div>
                <div class="cart"><a href="order_list.php"><i class="fas fa-history"></i></a></div>
                <div class="menu-bar">
                    <span></span>
                </div>
                <div class="menu-items">
                    <ul>
                        <a href="#home">Home</a><br>
                        <a href="#aboutus">About us</a> <br>
                        <a href="#menu">Menu</a><br>
                        <a href="#gallery">Gallery</a><br>
                        <a href="#room">Party Room</a><br>
                        <a href="#contact">Contact</a>
                    </ul>

                </div>

            </div>
        </div>

    </section>
    <section id="home" class="background">
        <div class="background-content" data-aos="fade-up" data-aos-easing="linear" data-aos-duration="1500">
            <h2>European Restaurant </h2>
            <p>Come and experience it yourself!</p>
            <a href="#booking">
                <button class="background-content btn">BOOK NOW</button>
            </a>
        </div>
    </section>

    <!---------------------------------------------ABOUT-US------------------------------------->
    <?php include('aboutus.php'); ?>
    <!--------------------------------------SIGNUP--------------------------------------->


    <!--------------------------------------------------------MENU---------------------------------------------------->

    <?php include('menuproduct.php'); ?>
    
    <!--------------------------------------------GALLERY------------------------------------------->
    <?php include('gallery.php'); ?>

    <!----------------------------------ROOM------------------------------------>
    <?php include('room.php'); ?>

    <!-----------------------------------------BOOKING---------------------------------------->
    <?php include('booking.php'); ?>

    <!-----------------------------------------FOOTER---------------------------------------->

    <?php include 'footer.php'; ?>

    <script src="../assets/js/webscript.js"></script>
    <script>
        AOS.init();
        // Get the modal
        var modal = document.getElementById('id01');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: '{your-app-id}',
                cookie: true,
                xfbml: true,
                version: '{api-version}'
            });

            FB.AppEvents.logPageView();

        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {
                return;
            }
            js = d.createElement(s);
            js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

</body>

</html>