<?php
if (!isset($_GET['token'])) {
    header('location:login.php');
    exit;
}
$token = $_GET['token'];
include 'partials/_db_con.php';
$token_search = "SELECT * FROM `user_data` where `token`='$token'";
$query = mysqli_query($con, $token_search);
$num = mysqli_num_rows($query);
if ($num) {
    if (isset($_POST['submit'])) {
        $npassword = mysqli_real_escape_string($con, $_POST['npassword']);
        $cnpassword = mysqli_real_escape_string($con, $_POST['cnpassword']);
        if ($npassword == $cnpassword) {
            $password = password_hash($npassword, PASSWORD_BCRYPT);
            $update = "UPDATE `user_data` SET `password`='$password' WHERE `token`='$token'";
            $uquery = mysqli_query($con, $update);
            if ($uquery) {
                $reset_token = "UPDATE `user_data` SET `token`= NULL WHERE `token`='$token'";
                $rtquery = mysqli_query($con, $reset_token);
                session_start();
                $_SESSION['reset']=true;
                header('location:login.php');
            } else {
                echo 'failed';
            }
        } else {
            echo 'pass not matched';
        }
    }
} else {
    header('location:login.php');
}
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" href="resources/img/icon.png">
    <link rel="stylesheet" href="resources/style_reset_password.css">
</head>

<body>
    <div>
        <div>
            <form action="" method="post">
                <input type="password" name="npassword">
                <input type="password" name="cnpassword">
                <button type="submit" name="submit">Reset Password</button>
            </form>
        </div>
    </div>
</body>

</html> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatyaJit | SignUp</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="resources/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_signup.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
    <section class='hero'>
        <div class="login-box">
            <form action="" method="post">
                <div class="heading">
                    <span>Reset Password</span>
                </div>
                <div class="pass input-box">
                    <input type="password" class="input npassword" name="npassword" placeholder="New password*" required>
                </div>
                <div class="cpass input-box">
                    <input type="password" class="input cnpassword" name="cnpassword" placeholder="Confirm new password*" required>
                </div>
                <div class="buttons ">
                    <button class="submit" type="submit" name="submit">Reset Password</button>
                </div>
            </form>
        </div>
    </section>
</body>

</html>