<?php
if(isset($_POST['submit'])){
    $id = $_POST['del_id'];
    include 'partials/_db_con.php';
    $delete = "DELETE from `user_services` WHERE `id`= $id";
    if(mysqli_query($con, $delete)){
        header('location:services.php');
    }
}
?>