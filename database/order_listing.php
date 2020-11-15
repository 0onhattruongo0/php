<?php
session_start();
if (isset($_SESSION['current_user'])) {
    $currentUser = $_SESSION['current_user'];
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../asset/css/mainadmin.css" />
        <link rel="stylesheet" href="../asset/css/resetcss.css" />
        <link rel="stylesheet" href="../asset/fonts/fontawesome-free-5.15.1-web/css/fontawesome.min.css" />
        <title>Document</title>
    </head>

    <body>
        <div class="total">
            <div class="header">
                <div class="admin">
                    <span class="admin_name">Hi: <?= $currentUser['Name'] ?></span>
                    <div class="admin_home"><a href="../index.php">HOME</a></div>
                </div>
                <div class="header_right">
                    <div class="form">
                        <form action="./login.php?action=sea" method="post">
                            <input type="text" name="tim" />
                            <input type="submit" name="sear" value="Search">
                        </form>
                    </div>
                    <div class="logout"><a href="./edit.php">Đổi mật khẩu</a></div>
                    <div class="logout"><a href="./logout.php">Đăng xuất</a> </div>
                </div>
            </div>
            <div class="container">
                <div class="container_left">
                    <div class="container_left_heard">Danh mục</div>
                    <ul>
                        <li>
                            <a href="login.php"> Danh sách sản phẩm </a>
                        </li>
                        <li>
                            <a href="order_listing.php"> Danh sách đơn hàng </a>
                        </li>
                    </ul>
                </div>
                <div class="container_right">
                    <?php include "./order.php" ?>
                </div>
            </div>
        </div>
    </body>

    </html>
<?php }
?>