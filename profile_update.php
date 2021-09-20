<?php
session_start();
$page='profile';
$next = 'http%3A%2F%2Fsatyajit.rf.gd%2Fprofile_update.php';
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatyaJit | Profile</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link href="resources/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_u_p.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body>
    <section class='hero'>
        <?php include 'partials/_nav.php' ?>
        <div class="text">
            <span>Please provide the following required contact information. Dell Technical Support will use it to create Support Requests on your behalf and, if needed, to ship replacement parts to the correct location.<br>The information you provide here will only be used for technical support purposes.</span>
        </div>
        <div class="login-box">
            <form action="" method="post">
                <div class="heading">
                    <span>Update Acount Details</span>
                </div>
                <div class="first-name input-box">
                    <label for="">First Name <span style="color:red;">*</span></label>
                    <input type="text" class="input fname" name="fname" value="<?php echo $_SESSION['fname']; ?>" required>
                </div>
                <div class="last-name input-box">
                    <label for="">Last Name <span style="color:red;">*</span></label>
                    <input type="text" class="input lname" name="lname" value="<?php echo $_SESSION['lname']; ?>" required>
                </div>
                <div class="dob input-box">
                    <label for="">Date of Birth <span style="color:red;">*</span></label>
                    <input type="date" class="input dob" name="dob" value="<?php echo $_SESSION['dob']; ?>">
                </div>
                <div class="number input-box">
                    <label for="">Mobile Number <span style="color:red;">*</span></label>
                    <input data-label="Email Address" type="text" maxlength="10" class="input number" name="number" value="<?php echo $_SESSION['number']; ?>" required>
                </div>
                <div class="user-email input-box">
                    <label for="">Email Address <span style="color:red;">*</span></label>
                    <input disabled data-label="Email Address" style="background:#EFEFEF; color:#999;" type="text" class="input email" name="email" value="<?php echo $_SESSION['username']; ?>" required>
                </div>
                <div class="buttons">
                    <a href="home.php">
                        <input type="button" class="cancel" value="Cancel">
                    </a>
                    <input type="submit" class="done" value="Done" >
                </div>
            </form>
        </div>
    </section>
    <script src="resources/js/bootstrap.bundle.min.js"></script>
</body>

</html>