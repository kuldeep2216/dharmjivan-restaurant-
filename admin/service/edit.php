<?php
include("../config/connection.php");

$id= $_POST['id'];
$name= $_POST['name'];
$description= $_POST['description'];
$price= $_POST['price'];
$approx_time= $_POST['approx_time'];
$status= $_POST['status'];

if(!empty($_FILES["service_image"]["name"]))
{
    $service_image = $_FILES["service_image"]["name"];
    $tempname = $_FILES["service_image"]["tmp_name"];
    $folder = "../images/services/" . $service_image;
    move_uploaded_file($tempname, $folder);
}else{
    $service_image = $_POST['service_image'];
}

$update = "UPDATE services SET `name`='".$name."', `description`='".$description."', `price`='".$price."', `service_image`='".$service_image."', `approx_time`='".$approx_time."', `status`='".$status."' WHERE `id`='".$id."'";

if(mysqli_query($con, $update))
{
    header("Location: ../services.php");
}
else
{
    echo "Error : ".$update. "<br/>" . mysqli_error($con);
}
mysqli_close($con);
?>