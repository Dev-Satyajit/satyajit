<?php
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])) {
    session_start();
    // $_SESSION['login']=true;
    header('location: login.php?next='.$next);
    exit;
}

if (!isset($_SESSION['fname'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    include 'partials/_db_con.php';
    $email_search = "SELECT * FROM user_data WHERE username = '$_SESSION[username]'";
    $query = mysqli_query($con, $email_search);
    $data = mysqli_fetch_assoc($query);
    $_SESSION['id'] = $data['id'];
    $_SESSION['lname'] = $data['lname'];
    $_SESSION['dob'] = $data['dob'];
    $_SESSION['prefix'] = $data['prefix'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['fname'] = $data['fname'];
    $_SESSION['number'] = $data['number'];
    $_SESSION['role'] = $data['role'];
    $ins = "UPDATE `user_data` SET `status`=1, `datetime`=current_timestamp() WHERE username = '$_SESSION[username]'";
    mysqli_query($con, $ins);
}
?>