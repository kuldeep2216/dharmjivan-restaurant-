<?php
$title = 'Edit Testimonial';
require_once("layouts/header.php");
include("config/connection.php");

$datas = mysqli_query($con, "SELECT * FROM `testimonial` where `id`='" . $_GET["id"] . "'");
$data = mysqli_fetch_assoc($datas);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Testimonial</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Testimonial</li>
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
                        <h3 class="card-title">Testimonial</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form id="testimonial" action="testimonial/edit.php" method="post">
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= $data["id"] ?>">
                            <div class="form-group">
                                <label for="serviceName">Name</label>
                                <input type="text" name="name" class="form-control" value="<?= $data["name"] ?>" id="serviceName" placeholder="Enter Name">
                            </div>

                            <div class="form-group">
                                <label for="summernote">Description</label>
                                <textarea class="form-control" rows="3" name="description" id="summernote"><?= $data["description"] ?></textarea>
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