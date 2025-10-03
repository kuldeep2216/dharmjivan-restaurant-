<?php
// 1. AUTHENTICATION CHECK
include("auth_check.php"); 

// Include the centralized database configuration
include("db_config.php"); 

$update_status = '';

// --- Handle Form Submission (Update Hours) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_hours'])) {
    $success = true;
    
    // Loop through all 7 days
    for ($i = 1; $i <= 7; $i++) {
        $day_id = $i;
        
        // Get form values for the day. Closed days will have 'closed' checkbox checked.
        $is_closed = isset($_POST["closed_$i"]);
        $open_time = $is_closed ? NULL : $conn->real_escape_string($_POST["open_$i"]);
        $close_time = $is_closed ? NULL : $conn->real_escape_string($_POST["close_$i"]);

        // Update the database
        if ($is_closed) {
            $stmt = $conn->prepare("UPDATE opening_hours SET hours_open = NULL, hours_close = NULL WHERE day_id = ?");
            $stmt->bind_param("i", $day_id);
        } else {
            // Note: If times are submitted blank, they will be saved as empty strings, which TIME columns usually treat as '00:00:00'.
            // Simple validation: check if times are provided when not closed.
            if (empty($open_time) || empty($close_time)) {
                $success = false;
                $update_status = "<div class='alert alert-danger text-center'>Error: Open and Close times must be set for all open days.</div>";
                break; // Stop execution on error
            }
            $stmt = $conn->prepare("UPDATE opening_hours SET hours_open = ?, hours_close = ? WHERE day_id = ?");
            $stmt->bind_param("ssi", $open_time, $close_time, $day_id);
        }
        
        if (!$stmt->execute()) {
            $success = false;
            $update_status = "<div class='alert alert-danger text-center'>Database Error: " . $stmt->error . "</div>";
            break; 
        }
        $stmt->close();
    }
    
    if ($success && empty($update_status)) {
        $update_status = "<div class='alert alert-success text-center'>Opening hours updated successfully!</div>";
    }
}

// --- Fetch Current Hours for Display ---
$hours = [];
$hours_sql = "SELECT day_id, day_name, hours_open, hours_close FROM opening_hours ORDER BY day_id";
$hours_result = $conn->query($hours_sql);

while ($row = $hours_result->fetch_assoc()) {
    // Reorder days to start with Sunday (day_id 1) for the form structure
    // We fetch in order (1=Sun to 7=Sat) to match the table.
    $hours[] = $row;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Hours</title>
    <link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/> 
    <link type="text/css" rel="stylesheet" href="css/style.css"/> 
    <style>
        body {padding-top: 20px; background-color: #f9f9f9;}
        .admin-logo-container { 
            background-color: #fff; 
            border-bottom: 1px solid #ECECEC; 
            margin-bottom: 30px; 
            max-width: 970px; 
            margin-left: auto;
            margin-right: auto;
            border-radius: 4px; 
        }
        .admin-header-content {
            display: flex; 
            justify-content: space-between; 
            align-items: center;
            padding: 10px 30px 10px 15px; 
        }
        .admin-header-content .logo { float: none; }
        .day-label { font-weight: bold; padding-top: 7px; }
        .closed-checkbox { margin-top: 10px !important; }
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
    <div id="main-content" class="section" style="padding-top: 0px; padding-bottom: 80px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header text-center">
                    <h4 class="sub-title">Admin Panel</h4>
                    <h2 class="title">Opening Hours Management</h2>
                </div>
                
                <div style="margin-bottom: 30px; text-align: center;">
                    <a href="admin_panel.php" class="main-button" style="margin-right: 10px;">Manage Reservations</a>
                    <a href="menu_management.php" class="main-button">Manage Menu Items</a>
                </div>

                <?php echo $update_status; ?>

                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title">Edit Daily Hours</h3></div>
                    <div class="panel-body">
                        <form method="POST" action="hours_management.php" class="form-horizontal">
                            <input type="hidden" name="update_hours" value="1">

                            <?php foreach ($hours as $row): ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label day-label"><?php echo htmlspecialchars($row['day_name']); ?></label>
                                
                                <div class="col-sm-3">
                                    <input type="time" class="form-control" name="open_<?php echo $row['day_id']; ?>" 
                                           value="<?php echo htmlspecialchars($row['hours_open'] ?? ''); ?>"
                                           <?php echo (is_null($row['hours_open']) && is_null($row['hours_close'])) ? 'disabled' : ''; ?>
                                    >
                                </div>
                                <label class="col-sm-1 control-label day-label">to</label>
                                <div class="col-sm-3">
                                    <input type="time" class="form-control" name="close_<?php echo $row['day_id']; ?>" 
                                           value="<?php echo htmlspecialchars($row['hours_close'] ?? ''); ?>"
                                           <?php echo (is_null($row['hours_open']) && is_null($row['hours_close'])) ? 'disabled' : ''; ?>
                                    >
                                </div>
                                
                                <div class="col-sm-3">
                                    <div class="checkbox closed-checkbox">
                                        <label>
                                            <input type="checkbox" name="closed_<?php echo $row['day_id']; ?>" 
                                                   value="1" 
                                                   <?php echo (is_null($row['hours_open']) && is_null($row['hours_close'])) ? 'checked' : ''; ?>
                                                   onclick="toggleHourInputs(<?php echo $row['day_id']; ?>)"
                                            > Closed
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>

                            <div class="form-group" style="margin-top: 30px;">
                                <div class="col-sm-offset-2 col-sm-10 text-center">
                                    <button type="submit" class="main-button">Save Hours</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleHourInputs(dayId) {
        const checkbox = document.querySelector(`input[name="closed_${dayId}"]`);
        const openInput = document.querySelector(`input[name="open_${dayId}"]`);
        const closeInput = document.querySelector(`input[name="close_${dayId}"]`);

        if (checkbox.checked) {
            openInput.disabled = true;
            closeInput.disabled = true;
            openInput.value = '';
            closeInput.value = '';
        } else {
            openInput.disabled = false;
            closeInput.disabled = false;
            // Optionally restore default times here if needed, but leaving blank is fine for TIME inputs
        }
    }
    
    // Initialize state on page load
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($hours as $row): ?>
            toggleHourInputs(<?php echo $row['day_id']; ?>);
        <?php endforeach; ?>
    });
</script>

</body>
</html>