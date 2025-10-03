<?php
$title = 'Edit Service';
require_once("layouts/header.php");
include("config/connection.php");

$datas = mysqli_query($con, "SELECT * FROM `services` where `id`='" . $_GET["id"] . "'");
$data = mysqli_fetch_assoc($datas);
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
                    <li class="breadcrumb-item active">Service Edit</li>
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
                    <form id="service" action="service/edit.php" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= $data["id"] ?>">
                            <div class="form-group">
                                <label for="serviceName">Name</label>
                                <input type="text" name="name" class="form-control" value="<?= $data["name"] ?>" id="serviceName" placeholder="Enter Name">
                            </div>

                            <div class="form-group">
                                <label for="serviceImage">Service Image</label>
                                <div>
                                    <img class="image-disp mb-2" src="../admin/images/services/<?php echo $data["service_image"]; ?>" alt="" height="100px " width="100px">
                                </div>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="service_image" name="service_image" value="<?php echo $data["service_image"]; ?>">
                                        <label class="custom-file-label" for="serviceImage">Choose Image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="servicePrice">Price</label>
                                        <input type="text" name="price" class="form-control" value="<?= $data["price"] ?>" id="servicePrice" placeholder="Enter Price">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <label for="serviceTime">Approx Time <small><b>(Time in Hours)</b></small></label>
                                        <input type="text" name="approx_time" class="form-control" value="<?= $data["approx_time"] ?>" id="serviceTime" placeholder="Enter Approx Time">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="serviceTime">Status</label>
                                            <select class="form-control" name="status">
                                                <option>Select Status</option>
                                                <option value="1"<?= $data['status'] == 1 ? 'selected':''?>>Active</option>
                                                <option value="0"<?= $data['status'] == 0 ? 'selected':''?>>InActive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="summernote">Description</label>
                                <textarea class="form-control" rows="3" name="description" id="summernote"><?= $data["description"] ?></textarea>
                            </div>

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                            <button type="submit" name="submit" value="edit" class="btn btn-primary">Update</button>
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