<?php
session_start();
$activePage = basename($_SERVER['SCRIPT_NAME']);
if (isset($_SESSION["email"])) {
include("config/connection.php");

$appointment_all = mysqli_query($con, "SELECT id FROM `appointment`");
$all_appointment = mysqli_num_rows($appointment_all);
$appointment_new = mysqli_query($con, "SELECT id FROM `appointment` WHERE status = 'new'");
$count_appointment_new = mysqli_num_rows($appointment_new);
$appointment_accepted = mysqli_query($con, "SELECT id FROM `appointment` WHERE status = 'accept'");
$count_appointment_accepted = mysqli_num_rows($appointment_accepted);
$appointment_rejected = mysqli_query($con, "SELECT id FROM `appointment` WHERE status = 'reject'");
$count_appointment_rejected = mysqli_num_rows($appointment_rejected);

$contact_read = mysqli_query($con, "SELECT id FROM `contact` WHERE is_read = '1'");
$count_contact_read = mysqli_num_rows($contact_read);
$contact_unread = mysqli_query($con, "SELECT id FROM `contact` WHERE is_read = '0'");
$count_contact_unread = mysqli_num_rows($contact_unread);

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title . " | Admin" ?></title>
    <!-- <title>AdminLTE 3 | Dashboard</title> -->

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
     <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div>

      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="contact-read.php" class="nav-link">Contact</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">

          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" role="button" >
              <i class="fas fa-sign-out-alt"></i>
            </a>
          </li>
      </nav>
      <!-- /.navbar -->

      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index.php" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> -->
              <img src="dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?= $_SESSION['email'] ?></a>
            </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
              <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-sidebar">
                  <i class="fas fa-search fa-fw"></i>
                </button>
              </div>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?= ($activePage == 'dashboard.php') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="mechanic.php" class="nav-link <?= ($activePage == 'mechanic.php') ? 'active':''; ?>">
                  <!-- <i class="nav-icon fas fa-th"></i> -->
                  <i class="nav-icon fas fa-duotone fa-user"></i>
                  <p>
                    Mechanic
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="customers.php" class="nav-link <?= ($activePage == 'customers.php') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Customers
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="appointment.php" class="nav-link <?= ($activePage == 'appointment.php') ? 'active':''; ?>">
                <i class="nav-icon fas fa-calendar-check"></i>
                  <p>
                    Appointment
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                   <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="appointment.php" class="nav-link <?= ($activePage == 'appointment.php') ? 'active':''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>All Appointment <span class="badge badge-info right"><?= $all_appointment ?></span></p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="newappointment.php" class="nav-link <?= ($activePage == 'newappointment.php') ? 'active':''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>New Appointment <span class="badge badge-info right"><?= $count_appointment_new ?></span></p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="acceptedappointment.php" class="nav-link <?= ($activePage == 'acceptedappointment.php') ? 'active':''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Accepted Appointment <span class="badge badge-info right"><?= $count_appointment_accepted ?></span></p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="rejectedappointment.php" class="nav-link <?= ($activePage == 'rejectedappointment.php') ? 'active':''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Rejected Appointment <span class="badge badge-info right"><?= $count_appointment_rejected ?></span></p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="services.php" class="nav-link <?= ($activePage == 'services.php') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-table"></i>
                  <p>
                    Services
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="testimonial.php" class="nav-link <?= ($activePage == 'testimonial.php') ? 'active':''; ?>">
                  <i class="nav-icon fa fa-quote-left"></i>
                  <p>
                    Testimonial 
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link <?= ($activePage == 'unreadcontact_query.php' || $activePage == 'readcontact_query.php') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-thin fa-address-book"></i>
                  <p>
                    Contact Us
                     <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="unreadcontact_query.php" class="nav-link <?= ($activePage == 'unreadcontact_query.php') ? 'active':''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Unread
                        <span class="badge badge-info right"><?= $count_contact_unread ?></span>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="readcontact_query.php" class="nav-link <?= ($activePage == 'readcontact_query.php') ? 'active':''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Read
                        <span class="badge badge-info right"><?= $count_contact_read ?></span>
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="" class="nav-link <?= ($activePage == 'social_media.php' || $activePage == 'contact_detail.php'  ) ? 'active':''; ?>">
                <i class="nav-icon fas fa fa-file"></i>
                  <p>
                    Pages
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="contact_detail.php" class="nav-link <?= ($activePage == 'contact_detail.php') ? 'active':''; ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        Contact Detail
                      </p>
                    </a>
                  </li>
                </ul>
              </li>
            
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- /.content-header -->
      <?php
    } else {
      header('location:index.php');
    } ?>