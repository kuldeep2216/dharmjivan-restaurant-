<?php
$title = 'Edit Customer';
require_once("layouts/header.php");
include("config/connection.php");

$datas = mysqli_query($con, "SELECT * FROM `users` where `id`='" . $_GET["id"] . "'");
$data = mysqli_fetch_assoc($datas);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Customer</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Customer Edit</li>
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
                        <h3 class="card-title">Customer</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="users" action="customer/edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data["id"] ?>">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="userFirstName">First Name</label>
                                        <input type="text" name="fname" id="userFirstName" class="form-control" value="<?= $data["fname"] ?>" placeholder="Enter First Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="userLastName">Last Name</label>
                                        <input type="text" name="lname" id="userLastName" class="form-control" value="<?= $data["lname"] ?>" placeholder="Enter Last Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="userMobile">Mobile Number</label>
                                        <input type="text" name="mobile" class="form-control" value="<?= $data["mobile"] ?>" id="userMobile" placeholder="Enter Mobile Number">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="userEmail">Email address</label>
                                        <input type="email" name="user_email" class="form-control" value="<?= $data["user_email"] ?>" id="userEmail" placeholder="Enter email">
                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                <label for="userPassword">Password</label>
                                <input type="password" name="password" class="form-control" id="userPassword" placeholder="Enter Password" value="<?= $data["password"] ?>">
                            </div> -->

                            <div class="form-group clearfix">
                                <label for="userRadio">Gender </label>
                                <br>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="userRadio" value="Male" <?php if ($data['gender'] == "Male") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                    <label for="radioPrimary1">
                                        Male
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="userRadio" value="Female" <?php if ($data['gender'] == "Female") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                    <label for="radioPrimary2">
                                        Female
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary3" name="userRadio" value="Other" <?php if ($data['gender'] == "Other") {
                                                                                                                echo "checked";
                                                                                                            } ?>>
                                    <label for="radioPrimary3">
                                        Other
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <img src="images/profile/<?= $data["profile"] ?>" class="m-3" alt="profile Image" height="100px" width="100px"><br>
                                <label for="userProfile">Profile Picture</label>
                                <input type="file" class="form-control-file" name="profile" value="<?php echo $data["profile"] ?>" id="userProfile">
                                <input class="form-control mt-4" name="profile" value="<?= $data["profile"] ?>" type="text" id="formFile" hidden>
                            </div>

                            <div class="form-group">
                                <label for="mechanicAddress">Address</label>
                                <textarea class="form-control" rows="3" name="address" id="mechanicAddress" placeholder="Enter Address"><?= $data["address"] ?></textarea>
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