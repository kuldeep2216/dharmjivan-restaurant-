<?php
include("../config/connection.php");

extract($_POST);

$name = $_POST["name"];
$email = $_POST["email"];
$mobile = $_POST["mobile"];
$date = $_POST["date"];
$vehicle = $_POST["vehicle"];
$service = $_POST["service_id"];
$subject = $_POST["subject"];
$created_by = $_POST["u_id"];

$create = mysqli_query($con, "INSERT INTO appointment (`name`, `email`, `mobile`, `date`, `vehicle`, `service`, `subject`, `created_by`) VALUES ('$name', '$email', '$mobile', '$date','$vehicle', '$service_id', '$subject', '$created_by')");
    
    if($create)
    {
        header("Location: http://localhost/project/index.php");
        // header("Location: http://localhost/project/admin/inquiry.php");
    }
    else
    {
        echo "Catch Error ".$create. "<br/>". mysqli_error($con);
    }
    mysqli_close($con);
?>