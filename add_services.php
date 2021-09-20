<?php
if(isset($_POST['submit'])){
    $username = $_POST['del_id'];
    $link = $_POST['link'];
    $linkname = $_POST['linkname'];
    include 'partials/_db_con.php';
    $add = "INSERT INTO `user_services` (`username`, `link`, `linkname`) VALUES('$username', '$link','$linkname')";
    if(mysqli_query($con, $add)){
        header('location:services.php');
    }else{
        echo 'failed';
    }
}
?>