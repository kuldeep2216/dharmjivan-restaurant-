<?php
include("../config/connection.php");

    $delete = mysqli_query($con, "DELETE FROM `testimonial` where `id`='" . $_GET["id"] . "'");
    // $data = mysqli_fetch_assoc($datas);
    if($delete)
    {
        header("Location: ../testimonial.php");
    }
    else
    {
        echo "Catch Error ".$delete. "<br/>". mysqli_error($con);
    }
    mysqli_close($con);
?>