<?php
// Start the session
session_start();

// Include the database connection
include("../config/connection.php");

// Check if the form was submitted
if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Check if fields are empty
    if (empty($email) || empty($password)) {
        header("location:../index.php?error=empty");
        exit();
    }

    // Query the admin_users table
    $sql = "SELECT * FROM admin_users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        // Verify the password
        if (password_verify($password, $row['password_hash'])) {
            // Password is correct!
            // Set session variables
            $_SESSION['admin_logged_in'] = true; // For compatibility with old system if needed
            $_SESSION['email'] = $row['email'];
            $_SESSION['admin_id'] = $row['id'];

            // Redirect to the dashboard
            header("location:../dashboard.php");
            exit();
        } else {
            // Invalid password
            header("location:../index.php?error=invalid");
            exit();
        }
    } else {
        // No user found with that email
        header("location:../index.php?error=invalid");
        exit();
    }
} else {
    // If not accessed via form, redirect to login
    header("location:../index.php");
    exit();
}
?>