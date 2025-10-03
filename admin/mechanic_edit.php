<?php
$title = 'Edit Mechanic';
require_once("layouts/header.php");
include("config/connection.php");

$datas = mysqli_query($con, "SELECT * FROM `mechanic` where `id`='" . $_GET["id"] . "'");
$data = mysqli_fetch_assoc($datas);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Mechanic</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Mechanic Edit</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- jquery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Mechanic</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="mechanic" action="mechanic/edit.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$data["id"]?>">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicFName">First Name</label>
                                        <input type="text" name="fname" class="form-control" value="<?= $data["fname"] ?>" id="mechanicFName" placeholder="Enter First Name">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicLName">Last Name</label>
                                        <input type="text" name="lname" class="form-control" value="<?= $data["lname"] ?>" id="mechanicLName" placeholder="Enter Last Name">
                                    </div>
                                </div>
                            </div>  

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicExprince">Exprince</label>
                                        <input type="text" name="exprince" class="form-control" value="<?= $data["exprince"]?>" id="mechanicExprince" placeholder="Enter Exprince">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicPreWork">Previous Work Station</label>
                                        <input type="text" name="preWork" class="form-control" value="<?= $data["previous_work"]?>" id="mechanicPreWork" placeholder="Enter Previous Work Station Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicMobile">Mobile Number</label>
                                        <input type="text" name="mobile" class="form-control" value="<?= $data["mobile"]?>" id="mechanicMobile" placeholder="Enter Mobile Number">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicEmail">Email address</label>
                                        <input type="email" name="email" class="form-control" value="<?= $data["email"]?>" id="mechanicEmail" placeholder="Enter email">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <img src="images/mechanic/<?= $data["profile"] ?>" class="m-3" alt="profile Image" height="100px" width="100px"><br>
                                <label for="userProfile">Profile Picture</label>
                                <input type="file" class="form-control-file" name="profile" value="<?php echo $data["profile"] ?>" id="userProfile">
                                <input class="form-control mt-4" name="profile" value="<?= $data["profile"] ?>" type="text" id="formFile" hidden>
                            </div>
                                                        
                            <div class="form-group">
                                <label for="mechanicAddress">Address</label>
                                <textarea class="form-control" rows="3" name="address" id="mechanicAddress" placeholder="Enter ..."><?= $data["address"] ?></textarea>
                            </div>
                            
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">

            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>

<?php
require_once("layouts/footer.php");
?>