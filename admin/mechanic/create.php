<?php
include("../config/connection.php");
// extract($_POST);

// print_r($_FILES); exit;

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$exprince = $_POST['exprince'];
$prework = $_POST['preWork'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$address = $_POST['address'];

$profile = $_FILES["profile"]["name"];
$tempname = $_FILES["profile"]["tmp_name"];
$folder = "../images/mechanic/" . $profile;
move_uploaded_file($tempname, $folder);

$create = mysqli_query($con, "INSERT INTO mechanic (`fname`, `lname`, `exprince`, `previous_work`, `mobile`, `email`, `profile`, `address`) VALUES ('$fname', '$lname', '$exprince', '$prework', '$mobile', '$email', '$profile', '$address')");

if ($create) {
    header("Location: ../mechanic.php");
} else {
    echo "Catch Error " . $create . "<br/>" . mysqli_error($con);
}
mysqli_close($con);
