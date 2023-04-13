<?php
include "../db/connect.php";
session_start();

$id = "";

if (isset($_GET["id"])) {
    $id = $_GET["id"];
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


    <div class="detail">
        <h2>PRODUCT DETAILS</h2>

        <?php
        $sql_product = mysqli_query($con, "SELECT * FROM tbl_product WHERE id = $id ");
        while ($row_product = mysqli_fetch_array($sql_product)) {
        ?>

            <div class="detail-modal1">
                <div class="detail-items">
                    <div class="detail-img">
                        <img src="../image/<?php echo $row_product['image'] ?>" alt="">
                        <h6 class="mb-0"><a style="cursor: pointer;font-size:20px;color:black;" href="home.php#menu" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                    </div>
                    <div class="detail-info">
                        <h2><?php echo $row_product['name'] ?></h2>
                        <h3>PRICE: <?php echo $row_product['price'] ?>$</h3>
                        <label for="">QUANTITY: <input name="quantity" type="number" limit="1"></label>
                        <h3>DETAIL : <p><?php echo $row_product['details'] ?></p>
                        </h3>
                        <a href="addproduct.php?action=add&sanpham_id=<?php echo $row_product['id']?>" class="btn-cart">
                            ADD TO CART <i class="fas fa-shopping-cart"></i>
                        </a>
                    </div>
                <?php
            }
                ?>
                </div>
            </div>
    </div>
</body>