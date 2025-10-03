<?php
include("../config/connection.php");

$is_read = $_POST['is_read'];

$update = "UPDATE contact SET `is_read`='".$is_read."' WHERE `id`='".$_POST["id"]."'";

if(mysqli_query($con, $update))
{
    header("Location: ../readcontact_query.php");
}
else
{
    echo "Error : ".$update. "<br/>" . mysqli_error($con);
}
mysqli_close($con);
?>