<?php
include("../config/connection.php");

$id= $_POST['id'];
$name= $_POST['name'];
$description= $_POST['description'];

$update = "UPDATE testimonial SET `name`='".$name."', `description`='".$description."' WHERE `id`='".$id."'";

if(mysqli_query($con, $update))
{
    header("Location: ../testimonial.php");
}
else
{
    echo "Error : ".$update. "<br/>" . mysqli_error($con);
}
mysqli_close($con);
?>