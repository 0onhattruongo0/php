<?php
include './connect.php';

if (!empty($_GET['action']) && $_GET['action'] == 'sea') {
    if (isset($_REQUEST['sear'])) {
        $search = $_POST['tim'];
    }
}

$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : "10";
$current_page = !empty($_GET['page']) ? $_GET['page'] : "1";
$offset = ($current_page - 1) * $item_per_page;
if (!empty($search)) {

    $orders = mysqli_query($con, "SELECT * FROM casestudy.orders where Name like '%$search%' order by id_order desc limit $item_per_page  offset $offset ;");
} else {

    $orders = mysqli_query($con, "SELECT * FROM casestudy.orders order by id_order desc limit $item_per_page  offset $offset ;");
}
$totalproduct = mysqli_query($con, "select * from casestudy.orders");
$totalRecords = $totalproduct->num_rows;
$totalPage = ceil($totalRecords / $item_per_page);

?>

<div class="content">
    <h1>Danh sách đơn hàng</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Tên Khách Hàng</th>
            <th>Địa chỉ</th>
            <th>Phone</th>
            <th>Ngày mua</th>
            <th>In đơn</th>

        </tr>
        <?php

        while ($row = mysqli_fetch_array($orders)) {
        ?>
            <tr>
                <td><?= $row['id_order'] ?></td>
                <td><?= $row['Name'] ?></td>
                <td><?= $row['address'] ?></td>
                <td><?= $row['phone'] ?></td>
                <td><?= date('d/m/Y H:i', $row['created_time']) ?></td>
                <td><a href="order_print.php?id=<?= $row['id_order'] ?>">In đơn</a></td>
            </tr>

        <?php
        }
        ?>


    </table>
    <div class="pana">
        <div class="pana_left"><?php include './panagation.php' ?>
        </div>
    </div>
</div>