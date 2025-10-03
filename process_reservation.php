<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the centralized database configuration
include("db_config.php"); 

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $date = $conn->real_escape_string($_POST['date']);
    $time = $conn->real_escape_string($_POST['time']);
    $guests = $conn->real_escape_string($_POST['guests']);

    // --- NEW VALIDATION: CHECK FOR CLOSED DAYS ---
    // N: Day of the week (1=Monday, 7=Sunday)
    $day_of_week_num = date('N', strtotime($date)); 

    // Friday is 5, Saturday is 6 (based on your existing opening hours data)
    if ($day_of_week_num == 5 || $day_of_week_num == 6) { 
        die("
            <!DOCTYPE html>
            <html lang='en'><head><title>Booking Error</title></head><body>
            <div style='padding-top: 100px; text-align: center;'>
                <h2 style='color: #a94442;'>Booking Error</h2>
                <p>We apologize, but we are closed on **Fridays and Saturdays**. Please select an alternative date.</p>
                <a href='reservation.php' class='main-button'>Back to Reservation</a>
            </div>
            </body></html>
        ");
        exit();
    }
    // --- END VALIDATION ---

    // Prepare and bind SQL statement
    $sql = "INSERT INTO reservations (name, phone, email, reservation_date, reservation_time, guests) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $name, $phone, $email, $date, $time, $guests);

    if ($stmt->execute()) {
        header("Location: reservation_success.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>