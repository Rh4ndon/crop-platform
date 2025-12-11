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
    foreach ($farmers as $farmer) {
        $response[] = array(
            'id' => $farmer['id'],
            'uli' => $farmer['uli'],
            'first_name' => $farmer['first_name'],
            'middle_name' => $farmer['middle_name'],
            'last_name' => $farmer['last_name'],
            'number_street' => $farmer['number_street'],
            'barangay' => $farmer['barangay'],
            'district' => $farmer['district'],
            'city_municipality' => $farmer['city_municipality'],
            'province' => $farmer['province'],
            'region' => $farmer['region'],
            'email' => $farmer['email'],
            'phone' => $farmer['phone'],
            'nationality' => $farmer['nationality'],
            'gender' => $farmer['gender'],
            'birthdate' => $farmer['birthdate'],
            'birthplace_city' => $farmer['birthplace_city'],
            'birthplace_province' => $farmer['birthplace_province'],
            'birthplace_region' => $farmer['birthplace_region'],
            'civil_status' => $farmer['civil_status'],
            'employment_status' => $farmer['employment_status'],
            'education_level' => $farmer['education_level'],
            'classification' => $farmer['classification'],
            'profile_picture' => $farmer['profile_picture'],
            'role' => $farmer['role'],
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
