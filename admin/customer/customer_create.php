<?php
$title = 'Create Customer';
require_once("layouts/header.php");
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
                    <li class="breadcrumb-item active">Customer Create</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <?php if (!empty($response)) { ?>
            <div class="response <?php echo $response["type"]; ?>">
                <?php echo $response["message"]; ?>
            </div>
        <?php } ?>
    </div>
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
                    <form id="users" action="customer/create.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label for="userFirstName">First Name</label>
                                        <input type="text" name="fname" id="userFirstName" class="form-control" placeholder="Enter First Name">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="userLastName">Last Name</label>
                                        <input type="text" name="lname" id="userLastName" class="form-control" placeholder="Enter Last Name">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="userMobile">Mobile Number</label>
                                        <input type="text" name="mobile" class="form-control" id="userMobile" placeholder="Enter Mobile Number">
                                    </div>
                                </div>

                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="userEmail">Email address</label>
                                        <input type="email" name="user_email" class="form-control" id="userEmail" placeholder="Enter email">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="userPassword">Password</label>
                                <input type="password" name="password" class="form-control" id="userPassword" placeholder="Enter Password" value="Password@123" readonly>
                            </div>

                            <div class="form-group clearfix">
                                <label for="userRadio">Gender </label>
                                <br>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="userRadio" value="Male">
                                    <label for="radioPrimary1">
                                        Male
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="userRadio" value="Female">
                                    <label for="radioPrimary2">
                                        Female
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary3" name="userRadio" value="Other">
                                    <label for="radioPrimary3">
                                        Other
                                    </label>
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
                                <textarea class="form-control" rows="3" name="address" id="mechanicAddress" placeholder="Enter Address"></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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