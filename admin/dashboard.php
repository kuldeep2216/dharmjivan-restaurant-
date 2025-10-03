<?php
$title = 'Dashboard';
require_once("layouts/header.php");
include("config/connection.php");

$dashboard_service =  mysqli_query($con, "SELECT * FROM `services`");
// $dashboard_inquiry =  mysqli_query($con, "SELECT * FROM `inquires`");
$dashboard_users =  mysqli_query($con, "SELECT * FROM `users`");
$dashboard_mechanic =  mysqli_query($con, "SELECT * FROM `mechanic`");
// $dashboard_category =  mysqli_query($con, "SELECT * FROM `category`");
$dashboard_appointment =  mysqli_query($con, "SELECT * FROM `appointment`");

?>

<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <!-- <h3>150</h3> -->
                        <?php
                        if ($service_total = mysqli_num_rows($dashboard_service)) {
                            echo "<h3>" . $service_total . "</h3>";
                        } else {
                            echo "<h3>0</h3>";
                        }
                        ?>
                        <p>Services</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="services.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <!-- <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <?php
                        // if ($inqiry_total = mysqli_num_rows($dashboard_inquiry)) {
                        //     echo "<h3>" . $inqiry_total . "</h3>";
                        // } else {
                        //     echo "<h3>0</h3>";
                        // }
                        ?>
                        <p>Inquiry</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="inquiry.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div> -->
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <!-- <h3>44</h3> -->
                        <?php
                        if ($user_total = mysqli_num_rows($dashboard_users)) {
                            echo "<h3>" . $user_total . "</h3>";
                        } else {
                            echo "<h3>0</h3>";
                        }
                        ?>
                        <p>User Registrations</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="users.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <!-- <h3>65</h3> -->
                        <?php
                        if ($mechanic_total = mysqli_num_rows($dashboard_mechanic)) {
                            echo "<h3>" . $mechanic_total . "</h3>";
                        } else {
                            echo "<h3>0</h3>";
                        }
                        ?>
                        <p>Mechanics</p>
                    </div>
                    <div class="icon">
                  <i class="nav-icon fas fa-duotone fa-user"></i>
                        <!-- <i class="ion ion-pie-graph"></i> -->
                    </div>
                    <a href="mechanic.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <!-- <h3>65</h3> -->
                        <?php
                        if ($appointment_total = mysqli_num_rows($dashboard_appointment)) {
                            echo "<h3>" . $appointment_total . "</h3>";
                        } else {
                            echo "<h3>0</h3>";
                        }
                        ?>
                        <p>Appointment</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                        <!-- <i class="ion ion-pie-graph"></i> -->
                    </div>
                    <a href="category.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
        </div>
    </div>
</section>

<?php
require_once("layouts/footer.php");
?>