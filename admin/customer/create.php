<?php
include("../config/connection.php");

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$email = $_POST['email'];
$password = $_POST['password'];
$hashPassword = md5($password);
$mobile = $_POST['mobile'];
$userRadio = $_POST['userRadio'];
$address = $_POST['address'];

$profile = $_FILES["profile"]["name"];
$tempname = $_FILES["profile"]["tmp_name"];
// if($_FILES["profile"]["size"] > 2097152)
// {
//     $response = array(
//         "type" => "error",
//         "message" => "Image size exceeds 2MB"
//     );
// }else{
    $folder = "../images/profile/" . $profile;
    move_uploaded_file($tempname, $folder);
// }

$create = mysqli_query($con, "INSERT INTO users (`fname`,`lname`, `email`, `password`, `mobile`, `gender`, `profile`, `address`) VALUES ('$fname','$lname','$email','$hashPassword','$mobile','$userRadio','$profile','$address')");
    
    if($create)
    {
    header("Location: http://localhost/project/login.php");
    // header("Location: ../customers.php");
    }
    else
    {
        echo "Catch Error ".$create. "<br/>". mysqli_error($con);
    }
    mysqli_close($con);
?>