<?php
include '../models/functions.php';

session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

echo "<script>
        sessionStorage.clear();
        window.location.href = '../index.html?msg=You have been logged out successfully.';
        </script>";
