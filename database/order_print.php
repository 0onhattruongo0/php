<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    session_start();
    if (!empty($_SESSION['current_user'])) {
        include "connect.php";
        $orders = mysqli_query($con, "select orders.Name,orders.phone,orders.address,orders_detail.*, product.Name as product_Name from orders
    inner join orders_detail on orders_detail.id_order = orders.id_order
    inner join product on product.id_product= orders_detail.id_product
    where orders.id_order=" . $_GET['id']);
        $orders = mysqli_fetch_all($orders, MYSQLI_ASSOC);
    }
    ?>
    <div>
        <div>
            <h1>Chi tiết đơn hàng</h1>
            <label for="">Người nhận:</label><span><?= $orders[0]['Name'] ?></span><br>
            <label for="">Số điện thoại:</label><span><?= $orders[0]['phone'] ?></span><br>
            <label for="">Địa chỉ:</label><span><?= $orders[0]['address'] ?></span><br>
        </div>
        <hr>
        <h2>Danh sách sản phẩm</h2>
        <ul>
            <?php
            $total_quantity = 0;
            $total_money = 0;
            foreach ($orders as $row) {
            ?>
                <li>
                    <span><?= $row['product_Name'] ?></span>
                    <br>
                    <span>SL:<?= $row['quanlity'] ?></span>

                </li>
            <?php
                $total_money += ($row['price'] * $row['quanlity']);
                $total_quantity += $row['quanlity'];
            }
            ?>
        </ul>
        <hr>
        <div>
            <label for="">Tổng số lượng:<?= $total_quantity ?></label>- <label for="">Tổng tiền:<?= $total_money ?>$</label>
        </div>
    </div>
</body>

</html>