<?php
session_start();
include 'partials/_db_con.php';
$ins = "UPDATE `user_data` SET `status`=NULL WHERE id = '$_GET[id]'";
mysqli_query($con, $ins);
setcookie("username", "", time() - 60);
header('location: login.php');
session_unset();
session_destroy();
?>