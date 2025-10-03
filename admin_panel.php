<?php
// 1. AUTHENTICATION CHECK - MUST BE THE FIRST LINE
include("auth_check.php"); 

// Include the centralized database configuration
include("db_config.php"); 
// ... (rest of the PHP login logic) ...

// Fetch all reservations
$sql = "SELECT * FROM reservations ORDER BY reservation_date DESC, created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Reservations</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/> 
    <link type="text/css" rel="stylesheet" href="css/style.css"/> 
    <style>
        body {padding-top: 20px; background-color: #f9f9f9;}
        .admin-logo-container { 
            background-color: #fff; 
            border-bottom: 1px solid #ECECEC; 
            margin-bottom: 30px; 
            max-width: 1150px; 
            margin-left: auto;
            margin-right: auto;
            border-radius: 4px; 
        }
        /* Use Flexbox to ensure spacing between the two elements */
        .admin-header-content {
            display: flex; 
            justify-content: space-between; /* Pushes items to opposite ends */
            align-items: center;
            padding: 10px 30px 10px 15px; 
        }
        /* Style the logo wrapper to remove its float property inherited from style.css */
        .admin-header-content .logo {
            float: none; /* Override default float:left */
        }
    </style>
</head>
<body>

    <div class="admin-logo-container">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 admin-header-content">
                    
                    <a class="logo" href="index.php">
                        <img src="./img/logo.png" alt="Dharmjivan Restaurant Logo">
                    </a>
                    
                    <a href="logout.php" class="main-button btn-xs" style="background-color: #888; padding: 8px 15px;">Log Out</a>
                </div>
            </div>
        </div>
    </div>
    <div id="main-content" style="padding-top: 0px; padding-bottom: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center">
                    <h4 class="sub-title">Admin Panel</h4>
                    <h2 class="title">Reservations Management</h2>
                </div>
                
                <div style="margin-bottom: 30px; text-align: center;">
                    <a href="menu_management.php" class="main-button" style="margin-right: 10px;">Manage Menu Items</a>
                    <a href="hours_management.php" class="main-button" style="margin-left: 10px;">Manage Hours</a>
                </div>

                <div class="table-responsive" style="background-color: white; border: 1px solid #ddd;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Guests</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["reservation_date"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["reservation_time"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["guests"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($row["created_at"]) . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8' style='text-align: center;'>No reservations found.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 20px; text-align: center;">
                    <a href="index.php" class="main-button">Go to Home Page</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$conn->close();
?>

</body>
</html>