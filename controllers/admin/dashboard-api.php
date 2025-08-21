<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../../models/functions.php';

try {
    // Get dashboard statistics
    $response = [];

    // Count vegetables/crops
    $cropsCount = countAllRecords('crops');
    $response['crops_count'] = $cropsCount;

    // Count farmers (users with role = 'farmer')
    $farmersCount = countAllRecords('users', "role = 'farmer'");
    $response['farmers_count'] = $farmersCount;

    // Count total data entries (crops count for now, can be expanded)
    $response['data_entries_count'] = $cropsCount;

    // Count recent activities (for now, we'll use a simple count, can be expanded with an activities table)
    $response['activities_count'] = $cropsCount + $farmersCount;

    // Get recent crops added (last 5)
    $recentCrops = getAllRecords('crops', 'ORDER BY created_at DESC LIMIT 5');
    $response['recent_crops'] = $recentCrops;

    // Get recent farmers registered (last 5)
    $recentFarmers = getAllRecords('users', "WHERE role = 'farmer' ORDER BY created_at DESC LIMIT 5");
    $response['recent_farmers'] = $recentFarmers;

    // Create recent activities array
    $recentActivities = [];

    // Add recent crops to activities
    foreach ($recentCrops as $crop) {
        $recentActivities[] = [
            'date' => date('Y-m-d', strtotime($crop['created_at'])),
            'activity' => 'Added ' . $crop['crop_name'] . ' information',
            'user' => 'Admin',
            'type' => 'crop'
        ];
    }

    // Add recent farmers to activities
    foreach ($recentFarmers as $farmer) {
        $recentActivities[] = [
            'date' => date('Y-m-d', strtotime($farmer['created_at'])),
            'activity' => 'Registered new farmer: ' . $farmer['first_name'] . ' ' . $farmer['last_name'],
            'user' => 'Admin',
            'type' => 'farmer'
        ];
    }

    // Sort activities by date (most recent first)
    usort($recentActivities, function ($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });

    // Take only the 10 most recent activities
    $response['recent_activities'] = array_slice($recentActivities, 0, 10);

    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
