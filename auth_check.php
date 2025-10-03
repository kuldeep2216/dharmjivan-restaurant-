<?php
// Set session cookie parameters before starting the session
// This forces the session cookie to expire when the browser closes.
session_set_cookie_params(0);

// MUST BE THE FIRST LINE after the PHP open tag, but after session_set_cookie_params
session_start();

// Check if the user is NOT logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}
// If the script reaches this point, the user is authenticated.
?>