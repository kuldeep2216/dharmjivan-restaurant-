<?php
include("../config/connection.php");

// extract($_POST);
if(isset($_POST['change_password']))
{
    $u_id = $_POST['u_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['confirm_password'];
    $user = mysqli_query($con, "SELECT * from `users` where id='".$u_id."' AND password='".md5($current_password)."'");
    $row=mysqli_fetch_array($user);
    if($row>0){
        $update = "UPDATE users SET `password`='".md5($new_password)."' WHERE `id`='".$_POST["u_id"]."'";
        echo '<script>alert("Your Password Change.")</script>';
    }else{
        header("Location: http://localhost/project/profile.php"); 
    }
}else{
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $userRadio = $_POST['userRadio'];
    $address = $_POST['address'];
    
    if(!empty($_FILES["profile"]["name"]))
    {
        $profile = $_FILES["profile"]["name"];
        $tempname = $_FILES["profile"]["tmp_name"];
        $folder = "../images/profile/" . $profile;
        move_uploaded_file($tempname, $folder);
    }else{
        $profile = $_POST['profile'];
    }
    
    $update = "UPDATE users SET `fname`='".$fname."', `lname`='".$lname."', `email`='".$email."',`mobile`='".$mobile."', `gender`='".$userRadio."',`profile`='".$profile."', `address`='".$address."' WHERE `id`='".$_POST["id"]."'";
    
}
if(mysqli_query($con, $update))
{
    header("Location: http://localhost/project/profile.php");
    // echo '<script>alert("Your Password Change.")</script>';
    // header("Location: ../customers.php");
}
else
{
    echo "Error : ".$update. "<br/>" . mysqli_error($con);
}
mysqli_close($con);
?>