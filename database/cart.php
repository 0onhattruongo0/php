<?php
session_start();
?>

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
    include "connect.php";
    $error = false;
    $success = false;
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }
    if (isset($_GET['action'])) {
        function update_cart($add = false)
        {
            foreach ($_POST['quantity'] as $id => $quantity) {
                if ($quantity == 0) {
                    unset($_SESSION['cart'][$id]);
                } else {
                    if ($add) {
                        $_SESSION['cart'][$id] += $quantity;
                    } else {
                        $_SESSION['cart'][$id] = $quantity;
                    }
                }
            }
        }
        switch ($_GET['action']) {
            case "add":
                update_cart(true);
                header('location:./cart.php');
                break;
            case "delete":
                if (isset($_GET['id'])) {
                    unset($_SESSION['cart'][$_GET['id']]);
                }
                header('location:./cart.php');
                break;
            case "submit":
                if (isset($_POST['update_click'])) {
                    update_cart();
                } elseif (isset($_POST['order_click'])) {
                    if (empty($_POST['Name'])) {
                        $error = "Bạn chưa nhập tên người nhận.";
                    } elseif (empty($_POST['phone'])) {
                        $error = "Bạn chưa nhập số điện thoại người nhận.";
                    } elseif (empty($_POST['address'])) {
                        $error = "Bạn chưa nhập địa chỉ người nhận.";
                    } elseif (empty($_POST['quantity'])) {
                        $error = "Giỏ hàng rỗng.";
                    }
                    if ($error == false && (!empty($_POST['quantity']))) {
                        $products = mysqli_query($con, "select * from product where id_product in (" . implode(",", array_keys($_POST['quantity'])) . ")");
                        $total = 0;
                        $order_product = array();
                        while ($row = mysqli_fetch_array($products)) {
                            $order_product[] = $row;
                            $total += $row['price'] * $_POST['quantity'][$row['id_product']];
                        }
                        $insert_order = mysqli_query($con, "INSERT INTO `casestudy`.`orders` (`Name`, `phone`, `address`, `note`, `total`, `created_time`, `last_update`) VALUES ('" . $_POST['Name'] . "', '" . $_POST['phone'] . "', '" . $_POST['address'] . "', '" . $_POST['note'] . "', '" . $total . "', '" . time() . "', '" . time() . "');");
                        $orderID = $con->insert_id;
                        $insert_string = "";
                        foreach ($order_product as $key => $products) {
                            $insert_string .= "('" . $orderID . "','" . $products['id_product'] . "','" . $_POST['quantity'][$products['id_product']] . "','" . $products['price'] . "','" . time() . "','" . time() . "')";
                            if ($key != count($order_product) - 1) {
                                $insert_string .= ",";
                            }
                        };

                        $insert_order = mysqli_query($con, "INSERT INTO `casestudy`.`orders_detail` (`id_order`, `id_product`, `quanlity`, `price`, `created_time`, `last_update`) VALUES " . $insert_string . "; ");
                        if ($insert_order == true) {
                            unset($_SESSION['cart']);
                            $success = "Bạn đã đặt hàng thành công";
                        }
                    }
                }

                break;
        }
    }
    if (!empty($_SESSION['cart'])) {
        $products = mysqli_query($con, "select * from product where id_product in (" . implode(",", array_keys($_SESSION['cart'])) . ")");
    }

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
                        <a href="login.php">LOGIN</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="cart">
            <h1>Giỏ hàng</h1>
            <div class="notify_msg">
                <?= (!empty($error)) ? $error : "" ?>
                <?= (!empty($success)) ? $success : "" ?>
            </div>
            <hr>
            <form action="cart.php?action=submit" method="post">
                <table class="table_cart">
                    <tr>
                        <th>STT</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Đơn giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th>Xóa</th>
                    </tr>
                    <?php
                    if (isset($products) & (isset($_SESSION['cart']))) {

                        $total = 0;
                        $num = 1;
                        while ($row = mysqli_fetch_array($products)) { ?>
                            <tr>
                                <td><?= $num ?></td>
                                <td><?= $row['Name'] ?> </td>
                                <td class="table_cart-img"><img src="../asset/img/<?= $row['img'] ?>" alt=""></td>
                                <td>Giá:<?= $row['price'] ?>$ </td>
                                <td class="quantity"><input type="text" value="<?= $_SESSION['cart'][$row['id_product']] ?>" name="quantity[<?= $row['id_product'] ?>]"></td>
                                <td><?= $row['price'] * $_SESSION['cart'][$row['id_product']] ?>$</td>
                                <td class="table_cart-delete"><a href="cart.php?action=delete&id=<?= $row['id_product'] ?>">Delete</a></td>
                            </tr>
                        <?php
                            $total += $row['price'] * $_SESSION['cart'][$row['id_product']];
                            $num++;
                        } ?>
                        <tr>
                            <td></td>
                            <td><strong> Tổng Tiền </strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="color: red;"><strong><?= $total ?>$</strong></td>
                            <td></td>
                        </tr>
                    <?php
                    } ?>

                </table>
                <div class="cart_update">

                    <input type="submit" name="update_click" value="Cập nhật">
                </div>

                <hr>
                <div class="cart_cus">
                    <h2>Thông tin khách hàng</h2>

                    Name: <br>
                    <input type="text" value="" name="Name">
                    <br>
                    Phone: <br>
                    <input type="number" value="" name="phone">
                    <br>
                    Address: <br>
                    <input type="text" value="" name="address">
                    <br>
                    Note: <br>
                    <input type="text" value="" name="note">
                    <br><br>
                    <input type="submit" name="order_click" value="Mua Hàng">

                </div>
            </form>
        </div>
    </div>
</body>

</html>