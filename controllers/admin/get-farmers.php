<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../models/functions.php';


// Get farmers with condition
$farmers = getAllRecords("users", "WHERE role = 'farmer'");

$response = array();

// Check if we got any results
if ($farmers && count($farmers) > 0) {
    foreach ($farmers as $farmer) { // Changed variable name to avoid conflict
        $response[] = array(
            'id' => $farmer['id'],
            'first_name' => $farmer['first_name'],
            'last_name' => $farmer['last_name'],
            'email' => $farmer['email'],
            'phone' => $farmer['phone'],
            'address' => $farmer['address'],
            'gender' => $farmer['gender'],
            'created_at' => $farmer['created_at'],
            'updated_at' => $farmer['updated_at']
        );
    }
} else {
    // No records found or error
    $response = array(
        'error' => true,
        'message' => 'No farmers found or database error'
    );
}

header('Content-Type: application/json');
echo json_encode($response);
