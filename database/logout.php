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
    <?php
    session_start();
    unset($_SESSION['current_user']);
    ?>
    <div class="login">
        <h1>Đăng xuất tài khoản thành công</h1>
        <a href="login.php">Đăng nhập</a>
        <a href="../index.php">Home</a>
    </div>
</body>

</html>