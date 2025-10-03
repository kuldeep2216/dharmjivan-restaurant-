<?php
$title = 'Appointment';
require_once("layouts/header.php");
include("config/connection.php");

$datas = mysqli_query($con, "SELECT * FROM `appointment` WHERE `id` = '" . $_GET['id'] . "'");

$data = mysqli_fetch_assoc($datas);
// print_r($data);

?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Appointment</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Appointment</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Appointment</h3>
                        <!-- Button trigger modal -->
                        <!-- <a href="category_create.php" class="btn btn-primary float-right">Add</a> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Customer Name : </label> <?= $data['name'] ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Customer Email : </label> <?= $data['email'] ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Customer Mobile : </label> <?= $data['mobile'] ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Appoitment Date : </label> <?= date("d/m/Y", strtotime($data["date"])) ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Vehical name : </label> <?= $data['vehicle'] ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-12">
                                <div class="form-group">
                                    <?php 
                                        $service_qry =  "SELECT * FROM `services` WHERE id='".$data['service']."'";
                                        $service = mysqli_query($con, $service_qry);
                                        $service_nm = mysqli_fetch_assoc($service);
                                    ?>
                                    <label for="CategoryName">Service Name : </label> <?= $service_nm["name"] ?>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label for="CategoryName">Subject : </label> <?= $data['subject'] ?>
                                </div>
                            </div>
                            <?php if($data['status'] == 'new'){?>
                                <div class="col-lg-6 col-12">
                                    <form action="appointment/appointment_status_update.php" method="post">
                                        <input type="hidden" name="id" value="<?=$data["id"]?>">
                                            <div class="form-group">
                                                <label for="CategoryName">Accept Appointment : </label>
                                                <select class="form-control" name="status">
                                                    <option value="accept">Accept</option>
                                                    <option value="reject">Reject</option>
                                                </select>
                                            </div>
                                        <a href="javascript:history.go(-1)" class="btn btn-danger" title="Return to the previous page">Back</a>
                                        <input type="submit" value="submit" class="btn btn-primary">
                                    </form>
                                </div>
                            <?php }else if($data['status'] == 'accept'){?>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="CategoryName">Status : </label> <?php if($data['status']=='accept'){echo "Accepted";} ?>
                                    </div>
                                </div>
                            <?php }else if($data['status'] == 'reject'){?>
                                <div class="col-lg-6 col-12">
                                    <div class="form-group">
                                        <label for="CategoryName">Status : </label> <?php if($data['status']=='reject'){echo "Rejected";} ?>
                                    </div>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</section>

<?php
require_once("layouts/footer.php");
?>