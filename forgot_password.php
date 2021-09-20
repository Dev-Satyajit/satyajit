<?php
$email = "";
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $invalid_email = true;
    } else {
        include 'partials/_db_con.php';
        $email_search = "SELECT * FROM `user_data` where `email`='$email'";
        $query = mysqli_query($con, $email_search);
        $num = mysqli_num_rows($query);
        if ($num) {
            $token = bin2hex(random_bytes(15));
            $result = mysqli_fetch_assoc($query);
            $name = $result['fname'];
            $update = "UPDATE `user_data` SET `token`='$token' WHERE `email`='$email'";
            $uquery = mysqli_query($con, $update);
            if ($uquery) {
                include 'mail.php';
            } else {
                echo 'update query failed';
            }
        } else {
            $nouser = true;
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
    <title>SatyaJit | LogIn</title>
    <?php include 'partials/head.php' ?>
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_login.css" media="screen" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <section class="hero">
        <div class="login-box">
            <form action="" method="post">
                <div class="heading">
                    <div class="logo">DiGiLife <i class="fab fa-buffer"></i></div>
                </div>
                <?php if (isset($nouser)) {
                    echo '<div class="email_error">
                    User dose not exist
                    </div>';
                }
                if (isset($invalid_email)) {
                    echo '<div class="email_error">
                    Enter a valid email address
                </div>';
                }
                ?>
                <div style="height:fit-content;font-size:13px;margin-bottom:10px;">
                    Enter the email address associated with your account and click <strong style="font-size: 14px">Send Email.</strong><br>
                    We'll email you a link to reset your password.
                </div>
                <div class="user-name input-box">
                    <input type="text" class="input user <?php if (isset($invalid_email)) {
                    echo 'input-invalid'; }?>" value="<?php echo $email; ?>" name="email" required>
                    <label for="">Email address</label>
                </div>
                <button type="submit" class="submit disabled" id="register" name="submit">Send Email</button>
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