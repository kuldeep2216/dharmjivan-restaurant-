<?php
$title = 'Edit Contact Detail';
require_once("layouts/header.php");
include("config/connection.php");

$datas = mysqli_query($con, "SELECT * FROM `contact_detail` where `id`='" . $_GET["id"] . "'");
$data = mysqli_fetch_assoc($datas);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Contact Detail</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Contact Detail Edit</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Contact Detail</h3>
            </div>
            <form action="pages/contact_detail_edit.php" id="contact_detail" method="post">
            <input type="hidden" name="id" value="<?=$data["id"]?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" name="email_address" class="form-control" value="<?= $data["email_address"] ?>" id="email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="contact_number">Contact Number</label>
                                <input type="text" name="contact_number" class="form-control" value="<?= $data["contact_number"] ?>" id="contact_number" placeholder="Enter Contact Number">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <textarea class="form-control" rows="3" name="address" id="address"><?= $data["address"] ?></textarea>
                            </div>
                        </div>
                    </div>                                            
                </div>
                <div class="card-footer">
                    <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php
require_once("layouts/footer.php");
?>