<?php
session_start();
include "../db/connect.php";

if(isset($_POST['pass_reset'])){
	$checkotp = $_SESSION['otp'];
	$otp = $_POST['otp'];
    $npass = md5($_POST['new_password']);   
	$kh_email = $_SESSION['user_email'];
	if($otp == ''|| $npass== ''){
        if($otp == ''){
            echo '<script language="javascript">';
		    echo 'alert("OTP cant be blank!")';
		    echo '</script>';
        }else{
            echo '<script language="javascript">';
		    echo 'alert("New password cant be blank!")';
		    echo '</script>';
        }

		
	}else{
		
        try{
            $check_pass = mysqli_query($con, " SELECT * FROM `tbl_user_account`  WHERE email = '$kh_email'");
            
            if(mysqli_num_rows($check_pass)>0 && $otp==$checkotp){
                mysqli_query($con, "UPDATE tbl_user_account SET password = '$npass'  WHERE email = '$kh_email'");
				$_SESSION['passupdate'] = 'Successfully updated password';
				header('Location: index.php'); 
            }
            else{
                echo '<script language="javascript">';
                echo 'alert("You entered wrong OTP!")';
                echo '</script>';
            }
           	
        }  catch (Exception $e){
                $error = $e->getMessage();
                echo $error;
        }			      
	}
	}


?>
<head>
	<meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/css/forgotpass.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Simple Forgot Password Page Using HTML and CSS">
	<meta name="keywords" content="forgot password page, basic html and css">
	<title>Forgot Password Page - HTML + CSS</title>
</head>
<body>
<form class="modal-content" action="" method="post">
	<div class="row">
		<h1>RESET PASSWORD</h1>
		<h6 class="information-text">Enter your registered email to reset your password.</h6>
		<div class="form-group">
        <p><label for="username">OTP</label></p> <input type="text" name="otp" id="otp">
        <p><label for="username">New password</label></p><input type="password" name="new_password" id="new_password">
			
			<button type="submit" name="pass_reset" onclick="showSpinner()">Reset Password</button>
		</div>
		<div class="footer">
			<h5>New here? <a href="register.php">Sign Up.</a></h5>
			<h5>Remembered your password? <a href="login.php">Sign In.</a></h5>
		</div>
	</div>
    </form>
</body>

