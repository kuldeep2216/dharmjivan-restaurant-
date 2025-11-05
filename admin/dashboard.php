<?php
$title = 'Dashboard';
require_once("layouts/header.php"); // Includes connection and session check

// --- Fetch Stats ---

// 1. Total Reservations
$reservations_result = mysqli_query($con, "SELECT COUNT(id) as count FROM reservations");
$total_reservations = mysqli_fetch_assoc($reservations_result)['count'];

// 2. Total Menu Items
$menu_result = mysqli_query($con, "SELECT COUNT(id) as count FROM menu_items");
$total_menu_items = mysqli_fetch_assoc($menu_result)['count'];

// 3. Guests Today
$today = date("Y-m-d");
$today_guests_result = mysqli_query($con, "SELECT SUM(guests) as count FROM reservations WHERE reservation_date = '$today'");
// Use null coalescing (??) in case there are no guests today, to avoid errors
$today_guests = mysqli_fetch_assoc($today_guests_result)['count'] ?? 0;

// 4. Total Admin Users
$users_result = mysqli_query($con, "SELECT COUNT(id) as count FROM admin_users");
$total_users = mysqli_fetch_assoc($users_result)['count'];

?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
    </div></section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $total_reservations; ?></h3>
                        <p>Total Reservations</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <a href="reservations.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $total_menu_items; ?></h3>
                        <p>Total Menu Items</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <a href="menu_management.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3><?php echo $today_guests; ?></h3>
                        <p>Guests Booked Today</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="reservations.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3><?php echo $total_users; ?></h3>
                        <p>Admin Users</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <a href="#" class="small-box-footer">&nbsp;</a> </div>
            </div>

        </div>
        </div></section>
<?php
require_once("layouts/footer.php");
?>