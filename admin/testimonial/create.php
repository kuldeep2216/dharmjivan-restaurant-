<?php
include("../config/connection.php");

$name= $_POST['name'];
$description= $_POST['description'];

$create = mysqli_query($con, "INSERT INTO testimonial (`name`, `description`) VALUES ('$name', '$description')");
    
    if($create)
    {
        header("Location: ../testimonial.php");
    }
    else
    {
        echo "Catch Error ".$create. "<br/>". mysqli_error($con);
    }
    mysqli_close($con);
?>