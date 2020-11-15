<?php
include "database/connect.php";
$product = mysqli_query($con, "SELECT * FROM casestudy.product");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./asset/css/main.css" />
    <link rel="stylesheet" href="./asset/css/resetcss.css" />
    <link rel="stylesheet" href="./asset/fonts/fontawesome-free-5.15.1-web/css/all.min.css" />
    <title>Document</title>
</head>

<body>
    <div class="total">
        <div class="hearder">
            <div class="container">
                <div class="hearder_home hearder_button">
                    <a href="./database/login.php">HOME</a>
                </div>
                <div class="hearder_logo">
                    <a href=""><img src="./asset/img/logo.png" alt="" /></a>
                </div>
                <div class="hearder_right">
                    <div class="hearder_cart">
                        <a href=""><i class="fas fa-shopping-cart"></i></a>
                    </div>
                    <div class="hearder_button">
                        <a href="database/login.php">LOGIN</a>
                    </div>
                </div>
            </div>
        </div>
        <hr />
        <div class="slice">
            <img src="./asset/img/slideshow_1.jpg" alt="" />
        </div>
        <div class="content">
            <?php

            while ($row = mysqli_fetch_array($product)) {
            ?>
                <div class="product">
                    <div class="product_overlay">
                        <div class="products_img"><img src="asset/img/<?= $row['img'] ?>" alt=""></div>
                        <div class="products_Name"><?= $row['Name'] ?></div>
                        <div class="products_price"><?= $row['price'] ?>$</div>
                        <div class="overlay">
                            <div class="overlay_link">
                                <a href="database/detail.php?id=<?= $row['id_product'] ?>">Xem thêm</a>

                            </div>
                            <div class="overlay-cart">
                                <a href="">Thêm vào giỏ hàng</a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>

        </div>
    </div>
</body>

</html>