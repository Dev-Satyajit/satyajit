<?php
session_start();
$page='profile';
$next = 'http%3A%2F%2Fsatyajit.rf.gd%2Fchange_password.php';
include 'session.php';
$check_pass = "";
if(isset($_POST['submit'])){
    $cpassword = $_POST['cpassword'];
    $npassword = $_POST['npassword'];
    $cnpassword = $_POST['cnpassword'];

    if($npassword==$cnpassword){
        include 'partials/_db_con.php';
        $check_pass = "SELECT `password` FROM `user_data` WHERE `username`= '$_SESSION[username]'";
        $query= mysqli_query($con, $check_pass);
        $data = mysqli_fetch_assoc($query);
        $verify= password_verify($cpassword, $data['password']);
        if($verify){
            $pass = password_hash($npassword, PASSWORD_BCRYPT);
            $update = "UPDATE `user_data` SET `password` = '$pass' WHERE `username`= '$_SESSION[username]'";
            $uq = mysqli_query($con, $update);
            if($uq){
                header('location:profile.php');
            }else{
                echo 'failed';
            }
        }else{
            $cpass_error = true;
        }
    }else{
        $npass_error = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatyaJit | Profile</title>
    <?php include 'partials/head.php' ?>
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_c_p.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
    <section class='hero'>
        <?php include 'partials/_nav.php' ?>
        <div class="text">
            <span>Change your password frequently to keep your account secure.</span>
        </div>
        <div class="login-box">
            <form action="" method="post">
                <div class="heading">
                    <span>Change Password</span>
                </div>
                <?php
                if(isset($cpass_error)){
                   echo '<div class="email_error">
                    You have entered wrong password.
                    </div>';
                }
                ?>
                <div class="first-name input-box">
                    <label for="">Current password <span style="color:red;">*</span></label>
                    <input type="password" class="input cpassword" name="cpassword" required>
                </div>
                <div class="last-name input-box">
                    <label for="">New Password <span style="color:red;">*</span></label>
                    <input type="password" class="input npassword" name="npassword" required>
                </div>
                <div class="dob input-box">
                    <label for="">Confirm new password <span style="color:red;">*</span></label>
                    <input type="password" class="input cnpassword" name="cnpassword" required>
                </div>
                <div class="buttons">
                    <a href="profile.php">
                        <input type="button" class="cancel" value="Cancel">
                    </a>
                    <input type="submit" name="submit" class="done" value="Done">
                </div>
            </form>
        </div>
    </section>
    <script src="resources/js/bootstrap.bundle.min.js"></script>
</body>

</html>