<?php
$title = 'Hours Management';
require_once("layouts/header.php"); // Includes session check and $con database connection

$update_status = '';

// --- Handle Form Submission (Update Hours) ---
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_hours'])) {
    $success = true;
    
    // Loop through all 7 days
    for ($i = 1; $i <= 7; $i++) {
        $day_id = $i;
        
        // Get form values for the day. Closed days will have 'closed' checkbox checked.
        $is_closed = isset($_POST["closed_$i"]);
        $open_time = $is_closed ? NULL : mysqli_real_escape_string($con, $_POST["open_$i"]);
        $close_time = $is_closed ? NULL : mysqli_real_escape_string($con, $_POST["close_$i"]);

        // Update the database
        if ($is_closed) {
            $stmt = mysqli_prepare($con, "UPDATE opening_hours SET hours_open = NULL, hours_close = NULL WHERE day_id = ?");
            mysqli_stmt_bind_param($stmt, "i", $day_id);
        } else {
            // Simple validation: check if times are provided when not closed.
            if (empty($open_time) || empty($close_time)) {
                $success = false;
                $update_status = "<div class='alert alert-danger text-center'>Error: Open and Close times must be set for all open days.</div>";
                break; // Stop execution on error
            }
            $stmt = mysqli_prepare($con, "UPDATE opening_hours SET hours_open = ?, hours_close = ? WHERE day_id = ?");
            mysqli_stmt_bind_param($stmt, "ssi", $open_time, $close_time, $day_id);
        }
        
        if (!mysqli_stmt_execute($stmt)) {
            $success = false;
            $update_status = "<div class='alert alert-danger text-center'>Database Error: " . mysqli_stmt_error($stmt) . "</div>";
            break; 
        }
        mysqli_stmt_close($stmt);
    }
    
    if ($success && empty($update_status)) {
        $update_status = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            Opening hours updated successfully!
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                          </div>";
    }
}

// --- Fetch Current Hours for Display ---
$hours = [];
$hours_sql = "SELECT day_id, day_name, hours_open, hours_close FROM opening_hours ORDER BY day_id";
$hours_result = mysqli_query($con, $hours_sql);

if ($hours_result) {
    while ($row = mysqli_fetch_assoc($hours_result)) {
        $hours[] = $row;
    }
}
?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Opening Hours Management</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active">Manage Hours</li>
                </ol>
            </div>
        </div>
    </div></section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                
                <?php echo $update_status; ?>

                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Daily Hours</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="hours_management.php" class="form-horizontal">
                            <input type="hidden" name="update_hours" value="1">

                            <?php foreach ($hours as $row): ?>
                                <?php $day_id = htmlspecialchars($row['day_id']); ?>
                                <div class="form-group row align-items-center">
                                    <label class="col-sm-2 col-form-label"><?php echo htmlspecialchars($row['day_name']); ?></label>
                                    
                                    <div class="col-sm-3">
                                        <input type="time" class="form-control" name="open_<?php echo $day_id; ?>" 
                                               value="<?php echo htmlspecialchars($row['hours_open'] ?? ''); ?>"
                                               <?php echo (is_null($row['hours_open']) && is_null($row['hours_close'])) ? 'disabled' : ''; ?>
                                        >
                                    </div>
                                    <label class="col-sm-1 col-form-label text-center">to</label>
                                    <div class="col-sm-3">
                                        <input type="time" class="form-control" name="close_<?php echo $day_id; ?>" 
                                               value="<?php echo htmlspecialchars($row['hours_close'] ?? ''); ?>"
                                               <?php echo (is_null($row['hours_open']) && is_null($row['hours_close'])) ? 'disabled' : ''; ?>
                                        >
                                    </div>
                                    
                                    <div class="col-sm-3">
                                        <div class="form-check" style="padding-top: 5px;">
                                            <input type="checkbox" class="form-check-input" name="closed_<?php echo $day_id; ?>" 
                                                   id="closed_<?php echo $day_id; ?>"
                                                   value="1" 
                                                   <?php echo (is_null($row['hours_open']) && is_null($row['hours_close'])) ? 'checked' : ''; ?>
                                                   onclick="toggleHourInputs(<?php echo $day_id; ?>)"
                                            >
                                            <label class="form-check-label" for="closed_<?php echo $day_id; ?>">Closed</label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                            <div class="form-group row" style="margin-top: 30px;">
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary">Save Hours</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
        </div>
    </div></section>
<?php
require_once("layouts/footer.php");
?>

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
        }
    }
    
    // Initialize state on page load
    document.addEventListener('DOMContentLoaded', function() {
        <?php foreach ($hours as $row): ?>
            toggleHourInputs(<?php echo $row['day_id']; ?>);
        <?php endforeach; ?>
    });
</script>