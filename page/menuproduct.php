<?php 
include('../db/connect.php');
?>
<section id="menu" class="menu section-pading">

        <div class="container">
            <div class="row">
                <div class="title">
                <h2 style="color: #DAA520;">MENU</h2>
                </div>
            </div>
            <div class="row">
                <div class="menu-title">
                    <?php
                    $sql_category = mysqli_query($con, "SELECT * FROM tbl_category ORDER BY id  ASC");
                    ?>

                    <?php
                    while ($row_category = mysqli_fetch_array($sql_category)) {
                    ?>
                        <button class="menu-button" data-title="<?php echo $row_category['id'] ?>"><?php echo $row_category['category_name'] ?></button>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <?php
            $sql_category = mysqli_query($con, "SELECT * FROM tbl_category");
            ?>
            <?php
            while ($row_category = mysqli_fetch_array($sql_category)) {
            ?>
                <div class="menu-content " id="<?php echo $row_category['id'] ?>">
                    <?php
                    $id = $row_category['id'];
                    $sql_product = mysqli_query($con, "SELECT * FROM tbl_product WHERE category_id = $id ");
                    ?>
                    <?php
                    while ($row_product = mysqli_fetch_array($sql_product)) {
                    ?>
                        <div class="list-items">
                            <div class="list-item">
                                <img src="../image/<?php echo $row_product['image'] ?>" alt="">
                                <a href="detail.php?id=<?php echo $row_product['id'] ?>"><?php echo $row_product['name'] ?></a>
                            </div>
                            <div class="list-price">
                                <p><?php echo $row_product['price'] ?>$</p>
                            </div>
                            <a href="addproduct.php?action=add&sanpham_id=<?php echo $row_product['id'] ?>"><i class="fas fa-plus"></i></a>
                        </div>
                    <?php
                    }
                    ?>

                </div>


            <?php
            }
            ?>
        </div>

    </section>