<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "satyajit_db";

$con = mysqli_connect($server, $user, $password, $database);

if(!$con){
    die("Error".mysqli_connect_error());
}