<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../models/functions.php';


session_start();

// Get admins with condition
$admins = getAllRecords("users", "WHERE role = 'admin'"); // Exclude the super admin with id 1
$response = array();

// Check if we got any results
if ($admins && count($admins) > 0) {
    foreach ($admins as $admin) { // Changed variable name to avoid conflict
        $response[] = array(
            'id' => $admin['id'],
            'first_name' => $admin['first_name'],
            'last_name' => $admin['last_name'],
            'email' => $admin['email'],
            'phone' => $admin['phone'],

            'gender' => $admin['gender'],
            'created_at' => $admin['created_at'],
            'updated_at' => $admin['updated_at']
        );
    }
} else {
    // No records found or error
    $response = array(
        'error' => true,
        'message' => 'No admins found or database error'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
