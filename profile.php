<?php
session_start();
$page = 'account';
$next = 'http%3A%2F%2Fsatyajit.rf.gd%2Fprofile.php';
include 'session.php';
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
    <link href="resources/style_profile.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php include 'partials/_nav.php' ?>
    <section class="hero">
        <div class="info">
            <div class="row-tr toppp">
                <span class="your-info">Your info</span>
                <div class="change-password">
                    <a href="change_password.php">
                        <div>
                            <span><i class="fas fa-key"></i></span>
                        </div>
                        <div>
                            <span class="bold">Change password</span> <br><span class="light">Security</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="info-container personal-info">
                <div class="row-tr heading" type="heading">
                    <div class="heading-tag">Personal Information</div>
                    <div class="edit"><a href="#">Edit personal info</a></div>
                </div>
                <div class="row-tr mobile-number">
                    <div class="tgg info-tag">Full name</div>
                    <div class="tgg info-value"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname'] ?></div>
                </div>
                <div class="row-tr email-id">
                    <div class="tgg info-tag">Date of birth</div>
                    <div class="tgg info-value"><?php echo $_SESSION['dob'] ?></div>
                </div>
            </div>
            <div class="info-container contact-info">
                <div class="row-tr heading" type="heading">
                    <div class="heading-tag">Contact information</div>
                    <div class="edit"><a href="#" title="hello">Edit contact info</a></div>
                </div>
                <div class="row-tr email-id">
                    <div class="tgg info-tag">Email address</div>
                    <div class="tgg info-value"><?php echo $_SESSION['email'] ?></div>
                </div>
                <div class="row-tr mobile-number">
                    <div class="tgg info-tag">Phone number</div>
                    <div class="tgg info-value"><?php echo $_SESSION['prefix'] . ' ' . $_SESSION['number'] ?></div>
                </div>
            </div>
        </div>
    </section>
    <?php include 'partials/foot.php' ?>
</body>

</html>