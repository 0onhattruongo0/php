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


    <?php
    session_start();
    include './connect.php';
    $error = false;
    if (isset($_POST['username']) & isset($_POST['password'])) {
        $result = mysqli_query($con, "Select `id_user`,`username`,`Name`,`email`,`birthday` from `user` WHERE (`username` ='" . $_POST['username'] . "' AND `password` = md5('" . $_POST['password'] . "'))");
        if (!$result) {
            mysqli_error($con);
        } else {
            $user = mysqli_fetch_assoc($result);
            $_SESSION['current_user'] = $user;
        }
        mysqli_close($con);
        if ($error != false || $result->num_rows == 0) {
    ?>
            <div class="login">
                <h1>Thông báo</h1>
                <h4><?= !empty($error) ? $error : "Thông tin đăng nhập ko đúng"  ?> </h4>
                <a href="login.php">Quay lại</a>
            </div>
        <?php
            exit;
        }
        ?>
    <?php
    }
    ?>

    <?php if (empty($_SESSION['current_user'])) { ?>
        <div class="login">
            <h1>Đăng nhập</h1>
            <form action="./login.php" method="Post">
                <label>Username</label></br>
                <input type="text" name="username" value="" /><br />
                <label>Password</label></br>
                <input type="password" name="password" value="" /></br>
                <br>
                <input type="submit" value="Login" />
            </form>
        </div>
    <?php } else {
        $currentUser = $_SESSION['current_user'];
    ?>
        <?php include "./product_list.php" ?>
    <?php } ?>
</body>

</html>