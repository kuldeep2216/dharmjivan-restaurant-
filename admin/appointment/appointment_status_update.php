<?php
include("../config/connection.php");

$status = $_POST['status'];

$update = "UPDATE appointment SET `status`='".$status."' WHERE `id`='".$_POST["id"]."'";

if(mysqli_query($con, $update))
{
    header("Location: ../acceptedappointment.php");
}
else
{
    echo "Error : ".$update. "<br/>" . mysqli_error($con);
}
mysqli_close($con);
?>