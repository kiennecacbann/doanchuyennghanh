<?php
session_start();
include "../db/connect.php";
use PHPMailer\PHPMailer\PHPMailer;


    if(isset($_POST['email_con'])){
	$email = $_POST['user_email']; 	
	if($email == ''){
		echo '<script language="javascript">';
		echo 'alert("Email cant be blank!")';
		echo '</script>';
	}else{
		
		$check_email = mysqli_query($con, "SELECT*FROM tbl_user_account WHERE email='$email'");
		$count = mysqli_num_rows($check_email);
    if($count > 0 ){
        $row = mysqli_fetch_array($check_email);
        $_SESSION['user_email'] = $row['email'];
		$otp = rand();
		$_SESSION['otp'] = $otp;
		$name = "Kien-restaurant";  // Name of your website or yours
        $to = $email;  // mail of reciever
        $subject = "Your code has arrived";
        $body = $otp;
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
            //echo "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }
		echo '<script language="javascript">';
		echo 'alert("Found it!")';
		echo '</script>';
    }else{
		echo '<script language="javascript">';
		echo 'alert("No account found")';
		echo '</script>';
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
	<title>Forgot Password Page</title>
</head>
<body>
<form class="modal-content" action="forgotpass.php" method="post">
	<div class="row">
		<h1>Forgot Password</h1>
		<h6 class="information-text">Enter your registered email to reset your password.</h6>
		<div class="form-group">
			<input type="email" name="user_email" id="user_email">
			<p><label for="username">Email</label></p>
			<button type="submit" name="email_con" onclick="showSpinner()">Confirm email</button>
		</div>
		<div class="footer">
			<h5>New here? <a href="register.php">Sign Up.</a></h5>
			<h5>Remembered your password ? <a href="login.php">Sign In</a></h5>	
		</div>
	</div>
    </form>
</body>