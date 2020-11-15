<?php
include './connect.php';
$id = $_GET['id'];


$edit = mysqli_query($con, "select * from product where id_product='$id'") or die("loi");


$ed = mysqli_fetch_array($edit);

mysqli_close($con);



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/css/mainadmin.css" />
    <link rel="stylesheet" href="../asset/css/resetcss.css" />
    <title>Document</title>
</head>

<body>
    <div class="login">
        <h1> UPDATE</h1>
        <form action="Xl_update.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label for="">Name:</label><br>
            <input type="text" name="Name" value="<?= $ed['Name'] ?>">
            <br>

            <label for="">Image:</label><br>
            <input type="text" name="img" value="<?= $ed['img'] ?>">
            <br>

            <label for="">Price</label> <br>
            <input type="number" name="price" value="<?= $ed['price'] ?>">

            <br>
            <br>

            <input type="submit" value="UPDATE">

        </form>
    </div>
</body>

</html>