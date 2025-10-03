<?php
include("../config/connection.php");

if (isset($_POST['submit']) && $_POST['submit'] == "add") 
{
    $name= $_POST['name'];
    $description= $_POST['description'];
    $price= $_POST['price'];
    $approx_time= $_POST['approx_time'];
    $status= $_POST['status'];
    
    $service_image = $_FILES["service_image"]["name"];
    $tempname = $_FILES["service_image"]["tmp_name"];
    $folder = "../images/services/" . $service_image;
    move_uploaded_file($tempname, $folder);

        $create = mysqli_query($con, "INSERT INTO services (`name`, `description`, `price`, `service_image`, `approx_time`, `status`) VALUES ('$name', '$description','$price', '$service_image', '$approx_time', '$status')");

        if($create)
        {
            header("Location: ../services.php");
        }
        else
        {
            echo "Catch Error ".$create. "<br/>". mysqli_error($con);
        }
    mysqli_close($con);
}
?>