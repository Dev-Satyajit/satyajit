<?php
session_start();
$page = 'home';
$next = 'http%3A%2F%2Flocalhost%2Fsatyajit';
include 'session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SatyaJit | Home</title>
    <?php include 'partials/head.php' ?>
    <link rel="icon" href="resources/img/icon.png">
    <link href="resources/style_home.css" media="screen" rel="stylesheet" type="text/css" />
</head>

<body onload="loading()">
    <div id="loader"></div>
    <section class="hero">
        <?php include 'partials/_nav.php' ?>
        <div class="welcome">
            <h1>Welcome <?php echo $_SESSION['fname']; ?></h1>
        </div>
    </section>
    <?php include 'partials/foot.php' ?>
    <script>
        var ll = document.getElementById('loader');
        function loading(){
            ll.style.display = 'none';
        }
    </script>
</body>

</html>