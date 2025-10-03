<?php
$title = 'New Appointment';
require_once("layouts/header.php");
include("config/connection.php");
$datas = mysqli_query($con, "SELECT * FROM `appointment` WHERE status='new'");
?>
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>New Appointment</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">New Appointment</li>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Vehicle Name</th>
                                    <th>Service Name</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($datas)) {
                                    $service_qry =  "SELECT * FROM `services` WHERE id='".$row['service']."'";
                                    $service = mysqli_query($con, $service_qry);
                                    $service_nm = mysqli_fetch_assoc($service);
                                ?>
                                    <tr>
                                        <td><?= $row["id"] ?></td>
                                        <td><?= $row["name"] ?></td>
                                        <td><?= $row["mobile"] ?></td>
                                        <td><?= $row["email"] ?></td>
                                        <td><?= date("d/m/Y", strtotime($row["date"])) ?></td>
                                        <td><?= $row["vehicle"] ?></td>
                                        <td><?= $service_nm["name"] ?></td>
                                        <td><?= $row["subject"] ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic example">
                                                <!-- <a type="button" class="btn btn-danger" href="appointment/delete.php?id=<?= $row["id"] ?>" onclick="return confirm('Are you sure?')">Delete</a> -->
                                                <a type="button" class="btn btn-info" href="appointment_view.php?id=<?= $row["id"] ?>">View</a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Vehicle Name</th>
                                    <th>Service Name</th>
                                    <th>Subject</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once("layouts/footer.php");
?>