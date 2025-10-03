<?php
session_start();
include("../config/connection.php");

extract($_POST);

// $qry="select * from admin where email='".$email."' && password='".$password."'";
$qry="select * from users where user_email='".$user_email."' && password='".MD5($password)."'";

$result = mysqli_query($con, $qry) or die(mysqli_error($con));

$count = mysqli_num_rows($result);

if ($count > 0) {
    $_SESSION["user_email"] = $user_email;
    header('location:../../index.php');
} else {
    header('location:../../login.php');
}

?>