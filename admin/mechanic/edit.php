<?php
include("../config/connection.php");

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$exprince = $_POST['exprince'];
$prework = $_POST['preWork'];
$mobile = $_POST['mobile'];
$email = $_POST['email'];
$address = $_POST['address'];

if(!empty($_FILES["profile"]["name"]))
{
    $profile = $_FILES["profile"]["name"];
    $tempname = $_FILES["profile"]["tmp_name"];
    $folder = "../images/mechanic/" . $profile;
    move_uploaded_file($tempname, $folder);
}else{
    $profile = $_POST['profile'];
}

$update = "UPDATE mechanic SET `fname`='".$fname."', `lname`='".$lname."', `exprince`='".$exprince."', `previous_work`='".$prework."', `mobile`='".$mobile."', `email`='".$email."', `profile`='".$profile."', `address`='".$address."' WHERE `id`='".$_POST["id"]."'";

if(mysqli_query($con, $update))
{
    header("Location: ../mechanic.php");
}
else
{
    echo "Error : ".$update. "<br/>" . mysqli_error($con);
}
mysqli_close($con);
?>