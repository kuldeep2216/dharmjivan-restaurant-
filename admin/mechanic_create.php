<?php
$title = 'Create Mechanic';
require_once("layouts/header.php");
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
                    <li class="breadcrumb-item active">Mechanic Create</li>
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
                    <form id="mechanic" action="mechanic/create.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicFName">First Name</label>
                                        <input type="text" name="fname" class="form-control" id="mechanicFName" placeholder="Enter First Name">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicLName">Last Name</label>
                                        <input type="text" name="lname" class="form-control" id="mechanicLName" placeholder="Enter Last Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicExprince">Exprince</label>
                                        <input type="text" name="exprince" class="form-control" id="mechanicExprince" placeholder="Enter Exprince">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicPreWork">Previous Work Station</label>
                                        <input type="text" name="preWork" class="form-control" id="mechanicPreWork" placeholder="Enter Previous Work Station Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicMobile">Mobile Number</label>
                                        <input type="text" name="mobile" class="form-control" id="mechanicMobile" placeholder="Enter Mobile Number">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="mechanicEmail">Email address</label>
                                        <input type="email" name="email" class="form-control" id="mechanicEmail" placeholder="Enter email">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="userProfile">Profile Picture</label>
                                <div id="imagePreview"></div>

                                <div class="input-group">
                                    <div class="custom-file">
                                        <div id="imagePreview"></div>
                                        <input type="file" name="profile" class="custom-file-input" id="userProfile" value="users.jpg" onchange="return profileValidation();" readonly>
                                        <label class="custom-file-label" for="userProfile">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="mechanicAddress">Address</label>
                                <textarea class="form-control" rows="3" name="address" id="mechanicAddress" placeholder="Enter ..."></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                        <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
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