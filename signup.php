<?php
session_start();
$fname = "";
$lname = "";
$dob = "";
$number = "";
$username = "";
if (isset($_POST['submit'])) {
    include 'partials/_db_con.php';
    $fname = mysqli_real_escape_string($con, $_POST['fname']);
    $lname = mysqli_real_escape_string($con, $_POST['lname']);
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);

    $email_search = "SELECT * FROM user_data WHERE email = '$username'";
    $query = mysqli_query($con, $email_search);
    $num_email = mysqli_num_rows($query);

    if ($num_email > 0) {
        $email_exist = true;
    } else {
        if ($password == $cpassword) {
            $pass = password_hash($password, PASSWORD_BCRYPT);
            $insert = "INSERT INTO `user_data` (`fname`, `lname`, `email`, `username`, `password`,`role`, `datetime`)
            VALUES ('$fname','$lname','$username','$username','$pass',0, current_timestamp())";
            $result = mysqli_query($con, $insert);
            if ($result) {
                session_start();
                $_SESSION['success'] = true;
                header('location: login.php');
            }
        } else {
            $pass_not_matched = true;
        }
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="resources/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_signup.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <section class='hero'>
        <div class="login-box">
            <form action="" method="post">
                <div class="heading">
                    <span>Create new account</span>
                </div>
                <?php
                if (isset($email_exist)) {
                    echo '<div class="email_error">
                    Email already exist.
                </div>';
                }
                if (isset($pass_not_matched)) {
                    echo '<div class="email_error">
                    Passwords not matched.
                </div>';
                }
                ?>
                <div class="user-fname input-box">
                    <input type="text" class="input fname" name="fname" placeholder="First name*" value="<?php echo $fname ?>" required>
                </div>
                <div class="user-lname input-box">
                    <input type="text" class="input lname" name="lname" placeholder="Last name*" value="<?php echo $lname ?>" required>
                </div>
                <div class="user-email input-box">
                    <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" class="input email <?php if ($email_exist == true) {
                                                                echo 'error';
                                                            } ?>" name="username" placeholder="Email address*" value="<?php echo $username ?>" required>
                </div>
                <div class="pass input-box">
                    <input type="password" class="input password <?php if ($pass_not_matched == true) {
                                                                        echo 'error';
                                                                    } ?>" name="password" placeholder="Password*" required>
                </div>
                <div class="cpass input-box">
                    <input type="password" class="input cpassword <?php if ($pass_not_matched == true) {
                                                                        echo 'error';
                                                                    } ?>" name="cpassword" placeholder="Confirm password*" required>
                </div>
                <div class="buttons ">
                    <button class="submit disabled" type="submit" id="register" name="submit" disabled="disabled">Register</button>
                </div>
                <div class="login">
                    <span>Already have an account? <a href="login.php">login here</a></span>
                </div>
            </form>
        </div>
    </section>
    <script>
        var sub = document.getElementById('register');
        (function() {
            $('form > div > input').keyup(function() {
                var empty = false;
                $('form > div > input').each(function() {
                    if ($(this).val() == '') {
                        empty = true;
                    }
                });
                if (empty) {
                    $('#register').attr('disabled', 'disabled');
                    sub.classList.add('disabled');
                } else {
                    $('#register').removeAttr('disabled');
                    sub.classList.remove('disabled');
                }
            });
        })()
    </script>
</body>

</html>