<?php
include('../db/connect.php');
session_start();
include('./loginwfb.php');
include('./loginwgg.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/webstyle.css">
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
</head>

<body>
    <div id="id02" class="register">
        <div class="register-content">
            <a href="index.php">
                <span class="close" title="Close Modal">&times;</span>
            </a>
            <form class="register-form" action="home.php" method="post">
                <span class="login100-form-title p-b-53">
                    Sign In With
                </span>
                <div class="orther-btn">
                    <?php               
                    echo '<a href="' . $loginUrl . '" class="btn-face m-b-20" >
                                <i class="fab fa-facebook"></i>
                                Facebook
                                </a>';
                    ?>
                    <?php
                    
                    
                    echo '<a href="' . $client->createAuthUrl() . '" class="btn-google m-b-20" >
                                    <img src="../image/icon-google.png" alt="Google">
                                    </a>';
                    ?>

                </div>
                <div class="p-t-31 p-b-9">
                    <span class="txt1">
                        Username
                    </span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Username is required">
                    <input class="input100" type="text" name="kh_user" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="p-t-13 p-b-9">
                    <span class="txt1">
                        Password
                    </span>
                    <a href="forgotpass.php" class="txt2 bo1 m-l-5">
                        Forgot?
                    </a>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="kh_password" required>
                    <span class="focus-input100"></span>
                </div>

                <div class="container-login100-form-btn ">
                    <button type="submit" class="login100-form-btn" name="dangnhap_home">Log In</button>
                </div>

                <div class="w-full text-center p-t-55">
                    <span class="txt2">
                        Not a member?
                    </span>
                    <a href="register.php" class="txt2 bo1">
                        Sign up now
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
<script src="../assets/js/webscript.js"></script>