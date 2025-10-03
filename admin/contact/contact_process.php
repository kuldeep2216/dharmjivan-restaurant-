<?php
include("../config/connection.php");

extract($_POST);
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$create = mysqli_query($con, "INSERT INTO contact (`name`, `mobile`, `subject`, `message`) VALUES ('$name', '$mobile','$subject', '$message')");
    
    if($create)
    {
    header("Location: http://localhost/project/contact.php");
    }
    else
    {
        echo "Catch Error ".$create. "<br/>". mysqli_error($con);
    }
    mysqli_close($con);
?>