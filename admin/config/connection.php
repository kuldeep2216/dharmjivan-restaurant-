<?php

// $host = "localhost";
// $user = "root";
// $password = "";
// $database = "project_db"; // <-- Old database
// $con = mysqli_connect($host, $user, $password, $database);

// Connect to the correct restaurant database
$con = mysqli_connect("localhost", "root", "", "dharmjivan_db"); // <-- New database

if(!$con){
    die("MySQL connection error: " . mysqli_connect_error());
}
?>