<?php
include '../models/functions.php';

session_start();
// Check if the user is logged in
if (isset($_SESSION['is_logged_in'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    echo "<script>
        sessionStorage.clear();
        window.location.href = '../index.html?msg=You have been logged out successfully.';
        </script>";
} else {
    // If the user is not logged in, redirect to the login page
    header('Location: ../index.html?error=You are not logged in.');
    exit();
}
