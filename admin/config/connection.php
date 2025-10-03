<?php

// $host = "localhost";
// $user = "root";
// $password = "";
// $database = "project_db";
// $con = mysqli_connect($host, $user, $password, $database);

$con = mysqli_connect("localhost", "root", "", "project_db");

if(!$con){
    die("mysql error" . mysqli_connect_error());
}
?>