<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../asset/css/mainadmin.css" />
    <link rel="stylesheet" href="../asset/css/resetcss.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include './connect.php';
    $error = false;
    if (isset($_GET['action']) && $_GET['action'] == 'edit') {
        if (isset($_POST['id_user']) && isset($_POST['old_password']) && isset($_POST['new_password']) && $_POST['old_password'] != "" && $_POST['new_password'] != "") {
            $userResult = mysqli_query($con, "Select * from `user` WHERE (`id_user` = " . $_POST['id_user'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
            if ($userResult->num_rows > 0) {
                $result = mysqli_query($con, "UPDATE `user` SET `password` = MD5('" . $_POST['new_password'] . "') WHERE (`id_user` = " . $_POST['id_user'] . " AND `password` = '" . md5($_POST['old_password']) . "')");
            } else {
                $error = "Mật khẩu cũ không đúng.";
            }
            mysqli_close($con);
            if ($error !== false) {
    ?>
                <div class="login">
                    <h1>Thông báo</h1>
                    <h4><?= $error ?></h4>
                    <a href="./edit.php">Đổi lại mật khẩu</a>
                </div>
            <?php } else { ?>
                <div class="login">
                    <h1><?= ($error !== false) ? $error : "Sửa tài khoản thành công" ?></h1>
                    <a href="index.php">Quay lại tài khoản</a>
                </div>
            <?php } ?>
        <?php } else { ?>
            <div class="login">
                <h1>Vui lòng nhập đủ thông tin để sửa tài khoản</h1>
                <a href="./edit.php">Quay lại sửa tài khoản</a>
            </div>
        <?php
        }
    } else {
        session_start();
        $user = $_SESSION['current_user'];
        if (!empty($user)) {
        ?>
            <div class="login">
                <h1>Xin chào "<?= $user['Name'] ?>"<br> Bạn đang thay đổi mật khẩu</h1>
                <form action="./edit.php?action=edit" method="Post">
                    <input type="hidden" name="id_user" value="<?= $user['id_user'] ?>">
                    <label>Password cũ</label></br>
                    <input type="password" name="old_password" value="" /></br>
                    <label>Password mới</label></br>
                    <input type="password" name="new_password" value="" /></br>
                    <br><br>
                    <input type="submit" value="Edit" />
                </form>
            </div>
    <?php
        }
    }
    ?>
</body>

</html>