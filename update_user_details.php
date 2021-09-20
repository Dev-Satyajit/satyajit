<?php
session_start();
$page = 'users';
$next = 'http%3A%2F%2Fsatyajit.rf.gd%2Fusers.php';
include 'session.php';
if ($_SESSION['role'] != 1) {
    header('location: home.php');
    exit;
}
if (!isset($_GET['id'])) {
    header('location:users.php');
    exit;
}
$id = $_GET['id'];
include 'partials/_db_con.php';
$email_search = "SELECT * FROM user_data WHERE id = $id";
$query = mysqli_query($con, $email_search);
$result = mysqli_fetch_assoc($query);
$role = $result['role'];

if (isset($_POST['submit'])) {
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $dob = mysqli_real_escape_string($con, $_POST['dob']);
    $number = mysqli_real_escape_string($con, $_POST['number']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    if ($_POST['usertype'] == 'admin') {
        $usertype = 1;
    } else {
        $usertype = 0;
    }
    $update = "UPDATE `user_data` SET `fname`='$fname',`lname`='$lname',`dob`='$dob', `prefix`='+91', `number`='$number',`email`='$email',`username`='$email',`role`='$usertype' WHERE `id` = $id";
    $uquery = mysqli_query($con, $update);
    if ($uquery) {
        header('location:users.php');
    } else {
        echo 'failed';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatyaJit | SignUp</title>
    <?php include 'partials/head.php' ?>
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_u_u_d.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
    <section class='hero'>
        <?php include 'partials/_nav.php' ?>
        <div class="heading">
            <span>Update user information </span>
            <span class="user-name"><?php echo $result['username']; ?></span>
        </div>
        <div class="login-box">
            <form action="" method="post">

                <div class="first-name input-box">
                    <label for="">First name <span style="color:red;">*</span></label>
                    <input type="text" class="input fname" name="fname" value="<?php echo $result['fname'] ?>" required>
                </div>
                <div class="last-name input-box">
                    <label for="">Last name <span style="color:red;">*</span></label>
                    <input type="text" class="input lname" name="lname" value="<?php echo $result['lname'] ?>" required>
                </div>
                <div class="dob input-box">
                    <label for="">Date of birth <span style="color:red;">*</span></label>
                    <input type="date" class="input dob" name="dob" value="<?php echo $result['dob'] ?>">
                </div>
                <div class="number input-box">
                    <label for="">Phone number <span style="color:red;">*</span></label>
                    <input type="text" maxlength="10" class="input number" name="number" value="<?php echo $result['number'] ?>" required>
                </div>
                <div class="user-email input-box">
                    <label for="">Email Address <span style="color:red;">*</span></label>
                    <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="input email" name="email" value="<?php echo $result['username'] ?>" required>
                </div>
                <div class="usertype radio-box">

                    <label for="">User type <span style="color:red;">*</span></label>
                    <div class="input-radio">
                        <input type="radio" id="admin" class="input usertype" name="usertype" value="admin" required <?php if ($role == 1) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                        <label for="admin">Admin</label>
                        <input type="radio" id="user" class="input usertype" name="usertype" value="user" required <?php if ($role == 0) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                        <label for="user">User</label>
                    </div>
                </div>
                <div class="buttons">
                    <a href="users.php">
                        <input type="button" class="cancel" value="Cancel">
                    </a>
                    <input type="submit" name="submit" class="done" value="Done">
                </div>
            </form>
        </div>
    </section>
    <?php include 'partials/foot.php' ?>
</body>

</html>