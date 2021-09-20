<?php
session_start();
if (isset($_COOKIE['username']) || isset($_COOKIE['username'])) {
    header('location: index.php');
}
unset($_SESSION['next']);

if (isset($_GET['next'])) {
    $_SESSION['next'] = $_GET['next'];
}
$email_not_exist = false;
$pass_not_matched = false;

if (isset($_POST['submit'])) {
    include 'partials/_db_con.php';
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $email_search = "SELECT * FROM user_data WHERE username = '$username'";
    $query = mysqli_query($con, $email_search);
    $num_email = mysqli_num_rows($query);

    if ($num_email > 0) {
        $data = mysqli_fetch_assoc($query);
        $pass = $data['password'];
        $verify = password_verify($password, $pass);
        if ($verify) {
            $_SESSION['username'] = $data['username'];
            setcookie("username", $data['username'], time() + (86400 * 30));
            if (isset($_SESSION['next'])) {
                header('location:' . $_SESSION['next']);
            } else {
                header('location:/satyajit');
            }
        } else {
            $pass_not_matched = true;
        }
    } else {
        $email_not_exist = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatyaJit | LogIn</title>
    <?php include 'partials/head.php' ?>
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_login.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <section class="hero">
        <div class="login-box">
            <form action="" method="post">
                <div class="heading">
                    <div class="logo">SatyaJit <i class="fab fa-buffer"></i></div>
                    Sign in to your SatyaJit account
                    <div class="sign-up">Don't have an account? <a href="signup.php" class="sign-up-link">Sign up</a></div>
                </div>
                <?php
                if (isset($_SESSION['success'])) {
                    echo '<div class="success_message">
                    <strong>Congratulations!</strong><br>Account has been created successfully.
                </div>';
                    session_unset();
                    session_destroy();
                }
                if (isset($_SESSION['changed'])) {
                    echo '<div class="success_message">
                    <strong>Congratulations!</strong><br>Your password has been changed successfully.
                </div>';
                    session_unset();
                    session_destroy();
                }
                if (isset($_SESSION['login'])) {
                    echo '<div class="warning_message">
                    You must log in to continue.
                </div>';
                    unset($_SESSION['login']);
                    // session_destroy();
                }
                if (isset($_SESSION['mailed'])) {
                    echo '<div class="success_message">
                    <strong>Awesome!</strong><br>A password reset link has been sent to your email.
                </div>';
                    session_unset();
                    session_destroy();
                }
                if (isset($_SESSION['reset'])) {
                    echo '<div class="success_message">
                    <strong>Awesome!</strong><br>Your password has been reset successfully.
                </div>';
                    session_unset();
                    session_destroy();
                }
                // <div class="success_message">
                //     <strong>Congratulations!</strong><br>New password created successfully.
                // </div>
                if ($email_not_exist == true) {
                    echo '<div class="email_error">
                    Email dose not exist
                </div>';
                }
                if ($pass_not_matched == true) {
                    echo '<div class="email_error">
                    Passwords is incorrect.
                </div>';
                }
                ?>
                <div class="input-container">
                    <div class="user-email input-box">
                        <input type="text" class="input user" name="username" required />
                        <label for="">Email address</label>
                    </div>
                    <div class="pass input-box">
                        <input type="password" id="password" class="input password" name="password" required autocomplete="off">
                        <label for="">Password</label>
                        <div class="show">
                            <i class="fas fa-eye-slash" id="show" onclick="show()"></i>
                            <i class="fas fa-eye" id="hide" onclick="hide()"></i>
                        </div>
                    </div>
                    <button class="submit disabled" type="submit" id="register" name="submit">Login</button>
                </div>
                <div class="forgot">
                    <a class="forgot-link" href="forgot_password.php">Forgotten password?</a>
                </div>
            </form>

        </div>
    </section>
    <script>
        var sub = document.getElementById('register');
        (function() {
            $('form > div > div > input').keyup(function() {
                var empty = false;
                $('form > div > div > input').each(function() {
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
    <script src="resources/js/main.js"></script>
</body>

</html>