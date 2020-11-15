<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/main.css" />
    <link rel="stylesheet" href="../asset/css/resetcss.css" />
    <link rel="stylesheet" href="../asset/fonts/fontawesome-free-5.15.1-web/css/all.min.css">
    <title>Document</title>
</head>

<body>
    <?php
    include "./connect.php";
    $result = mysqli_query($con, "SELECT * FROM product where id_product =" . $_GET['id']);
    $product = mysqli_fetch_assoc($result);
    $imglibrary = mysqli_query($con, "SELECT * FROM library_img where id_product =" . $_GET['id']);
    $product['images'] = mysqli_fetch_all($imglibrary, MYSQLI_ASSOC);


    ?>
    <div class="total">
        <div class="hearder">
            <div class="container">
                <div class="hearder_home hearder_button">
                    <a href="../index.php">HOME</a>
                </div>
                <div class="hearder_logo">
                    <a href=""><img src="../asset/img/logo.png" alt="" /></a>
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
        <div class="detail">
            <h2>Chi tiết sản phẩm</h2>
            <hr>
            <div class="detail_content">
                <div class="detail_content_img">
                    <div class="content_img-main"><img src="../asset/img/<?= $product['img'] ?>" alt=""></div>
                    <div class="gallery">
                        <ul>
                            <?php
                            foreach ($product['images'] as $img) { ?>
                                <li><img src="../asset/img/<?= $img['image'] ?>" alt=""></li>
                            <?php } ?>
                        </ul>
                    </div>

                </div>
                <div class="detail_content-com">
                    <h1><?= $product['Name'] ?></h1>
                    <div class="content-com">
                        <span>Giá:<?= $product['price'] ?>$</span>
                        <div>
                            <pre>
Mỗi bộ sản phẩm bao gồm:

Nón:
- 100% Cotton
- Freesize
- Thiết kế đồ họa bởi 5THEWAY Team
- Freesize
Ứng dụng VieON:
- Thẻ Giftcode xem gói VIP 1 Tháng
                            </pre>
                        </div>
                        <div class="detail_cart">
                            <form action="cart.php?action=add" method="post">
                                <input type="text" value="1" name="quantity[<?= $product['id_product'] ?>]" size="2">
                                <br>
                                <br>
                                <div class="detail_cart-btn">

                                    <input type="submit" value="Thêm vào giỏ hàng">
                                </div>
                            </form>
                        </div>
                    </div>


                </div>

            </div>



        </div>
    </div>
</body>

</html>