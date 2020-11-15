<?php
include './connect.php';

if (!empty($_GET['action']) && $_GET['action'] == 'sea') {
    if (isset($_REQUEST['sear'])) {
        $search = $_POST['tim'];
    }
}

$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : "4";
$current_page = !empty($_GET['page']) ? $_GET['page'] : "1";
$offset = ($current_page - 1) * $item_per_page;
if (!empty($search)) {

    $product = mysqli_query($con, "SELECT * FROM casestudy.product where Name like '%$search%' order by id_product asc limit $item_per_page  offset $offset ;");
} else {

    $product = mysqli_query($con, "SELECT * FROM casestudy.product order by id_product asc limit $item_per_page  offset $offset ;");
}
$totalproduct = mysqli_query($con, "select * from casestudy.product");
$totalRecords = $totalproduct->num_rows;
$totalPage = ceil($totalRecords / $item_per_page);

?>

<div class="content">
    <h1>PRODUCTS</h1>
    <div class="add"><a href="add_product.php">Thêm sản phẩm</a></div>
    <table>
        <tr>
            <th>Tên sản phẩm</th>
            <th>Image</th>
            <th>Giá</th>
            <th>Edit</th>
            <th>Delete</th>

        </tr>
        <?php

        while ($row = mysqli_fetch_array($product)) {
        ?>
            <tr>
                <td><strong><?= $row['Name'] ?></strong></td>
                <td class="img_edit"><img src="../asset/img/<?= $row['img'] ?>" alt=""></td>
                <td>
                    <div>Giá:<?= $row['price'] ?>$</div>
                </td>
                <td><a href="update.php?id=<?= $row['id_product'] ?>">Edit</a></td>
                <td><a href="delete.php?id=<?= $row['id_product'] ?>"> Delete </a></td>
            </tr>

        <?php } ?>


    </table>
    <div class="pana">
        <div class="pana_left"><?php include './panagation.php' ?>
        </div>
    </div>
</div>