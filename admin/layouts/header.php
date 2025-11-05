<?php
session_start();
$activePage = basename($_SERVER['SCRIPT_NAME']);

// Check if user is logged in
if (isset($_SESSION["email"])) {
    include("config/connection.php");

    // Fetch counts for sidebar badges
    $reservations_result = mysqli_query($con, "SELECT id FROM `reservations`");
    $all_reservations = mysqli_num_rows($reservations_result);
    
    $menu_result = mysqli_query($con, "SELECT id FROM `menu_items`");
    $all_menu_items = mysqli_num_rows($menu_result);

?>
  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title . " | Dharmjivan Admin" ?></title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  </head>

  <body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

      <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
      </div>

      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard.php" class="nav-link">Home</a>
          </li>
        </ul>
        
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
              <i class="fas fa-expand-arrows-alt"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php" role="button" title="Log Out">
              <i class="fas fa-sign-out-alt"></i>
            </a>
          </li>
        </ul>
      </nav>
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="dashboard.php" class="brand-link">
          <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">Dharmjivan Admin</span>
        </a>

        <div class="sidebar">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="dist/img/user8-128x128.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="#" class="d-block"><?= htmlspecialchars($_SESSION['email']) ?></a>
            </div>
          </div>

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

          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              
              <li class="nav-item">
                <a href="dashboard.php" class="nav-link <?= ($activePage == 'dashboard.php') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="reservations.php" class="nav-link <?= ($activePage == 'reservations.php') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-calendar-check"></i>
                  <p>
                    Reservations
                    <span class="badge badge-info right"><?= $all_reservations ?></span>
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="menu_management.php" class="nav-link <?= ($activePage == 'menu_management.php') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-utensils"></i>
                  <p>
                    Manage Menu
                    <span class="badge badge-success right"><?= $all_menu_items ?></span>
                  </p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="hours_management.php" class="nav-link <?= ($activePage == 'hours_management.php') ? 'active':''; ?>">
                  <i class="nav-icon fas fa-clock"></i>
                  <p>Manage Hours</p>
                </a>
              </li>

            </ul>
          </nav>
          </div>
        </aside>

      <div class="content-wrapper">
        <?php
    } else {
      // If session is not set, redirect to login page
      header('location:index.php');
      exit();
    } ?>