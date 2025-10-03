<?php
$title = 'Create Service';
require_once("layouts/header.php");
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Service</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Service Create</li>
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
                        <h3 class="card-title">Service</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="service" action="service/create.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="serviceName">Name</label>
                                <input type="text" name="name" class="form-control" id="serviceName" placeholder="Enter Name">
                            </div>
                            <div class="form-group">
                                <label for="serviceImage">Service Image</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="service_image" name="service_image">
                                        <label class="custom-file-label" for="serviceImage">Choose Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="servicePrice">Price</label>
                                        <input type="text" name="price" class="form-control" id="servicePrice" placeholder="Enter Price">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="serviceTime">Approx Time <small><b>(Time in Hours)</b></small></label>
                                        <input type="text" name="approx_time" class="form-control" id="serviceTime" placeholder="Enter Approx Time">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="serviceTime">Status</label>
                                            <select class="form-control" name="status">
                                                <option>Select Status</option>
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="summernote">Discription</label>
                                    <textarea class="form-control" rows="3" name="description" id="summernote"></textarea>
                                <!-- <textarea class="form-control" rows="3" name="description" id="serviceDiscription" placeholder="Enter Description"></textarea> -->
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                            <button type="submit" name="submit" value="add" class="btn btn-primary">Submit</button>
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