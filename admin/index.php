<?php
session_start();
include('../db/connect.php')
?>
<?php
if (isset($_POST['login'])) {
    $user = $_POST['user'];
    $password = md5($_POST['password']);
    if ($user == '' || $password == '') {
        echo '<p>Please enter full</p>';
    } else {
        $sql_select_admin = mysqli_query($con, "SELECT*FROM tbl_admin WHERE username='$user'AND password='$password' LIMIT 1");
        $count = mysqli_num_rows($sql_select_admin);
        $row_login = mysqli_fetch_array($sql_select_admin);
        if ($count > 0) {
            $_SESSION['login'] = $row_login['name'];
            $_SESSION['admin_id'] = $row_login['id'];
            header('Location: dashboard.php');
        } else {
            echo '<p>Something wrong with your password or username</p>';
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
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>AD PAGE</title>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5" style="background-color: silver;">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Sign In</h3>
                        <form action="" method="POST" class="login-form">
                            <div class="form-group">
                                <input type="text" name="user" class="form-control rounded-left" placeholder="Username" required>
                            </div>
                            <div class="form-group d-flex">
                                <input type="password" name="password" class="form-control rounded-left" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" name="login" class="form-control btn btn-primary rounded submit px-3">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/popper.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/main.js"></script>
    </body>

</html>