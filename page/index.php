<?php

include('../db/connect.php');
include('./loginwgg.php');
include('./loginwfb.php');

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
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/4.5.6/css/ionicons.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
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
                <div class="logo"><img src="../image/logo.png" alt=""></div>
                <div class="signup">
                    <div class="signup-button">
                        <a href="register.php"><button>SIGN UP</button></a>
                    </div>
                </div>
                <div class="login">
                    <div class="login-button">
                        <a href="login.php">
                            <button>LOG IN</button>
                        </a>
                    </div>
                </div>
                <div class="menu-bar">
                    <span></span>
                </div>
                <div class="menu-items">
                    <ul>
                        <a href="">Home</a><br>
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
    <section id="" class="background">
        <div class="home-slider owl-carousel js-fullheight">
            <div class="slider-item js-fullheight" style="background-image:url(../image/restaurant.webp);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                        <div class="col-md-12 ftco-animate">
                            <div class="text w-100 text-center">
                                <h2>European Restaurant</h2>
                                <h1 class="mb-3">BEAUTIFUL</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item js-fullheight" style="background-image:url(../image/background5.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                        <div class="col-md-12 ftco-animate">
                            <div class="text w-100 text-center">
                                <h2>European Restaurant</h2>
                                <h1 class="mb-3">DELICIOUS</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item js-fullheight" style="background-image:url(../image/background6.jpg);">
                <div class="overlay"></div>
                <div class="container">
                    <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center">
                        <div class="col-md-12 ftco-animate">
                            <div class="text w-100 text-center">
                                <h2>European Restaurant</h2>
                                <h1 class="mb-3">FRESH</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!---------------------------------------------ABOUT-US------------------------------------->
   <?php include('aboutus.php');?>
    <!--------------------------------------SIGNUP--------------------------------------->


    <!--------------------------------------------------------MENU---------------------------------------------------->

    <?php include('menuproduct.php');?>
    <!---------------------------------------------Some foods------------------------------------------->
    <?php include('gallery.php');?>

    <!----------------------------------ROOM------------------------------------>
    <?php include('room.php');?>

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
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->


    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId: 'Login_KR',
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

        FB.getLoginStatus(function(response) {
            statusChangeCallback(response);
        });
    </script>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/main.js"></script>
</body>

</html>