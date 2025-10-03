<?php
include("../config/connection.php");
$email_address= $_POST['email_address'];
$contact_number= $_POST['contact_number'];
$address= $_POST['address'];

$update = "UPDATE contact_detail SET `email_address`='".$email_address."', `contact_number`='".$contact_number."', `address`='".$address."' WHERE `id`='".$_POST["id"]."'";

if(mysqli_query($con, $update))
{
    header("Location: ../contact_detail.php");
}
else
{
    echo "Error : ".$update. "<br/>" . mysqli_error($con);
}
mysqli_close($con);
?>