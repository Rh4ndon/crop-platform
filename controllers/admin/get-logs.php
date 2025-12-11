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



    // Get recent logins registered (last 5)
    $recentLogins = getAllRecords('login', 'ORDER BY login_time DESC');

    foreach ($recentLogins as $key => $login) {
        $user = getRecord('users', 'id = "' . $login['user_id'] . '"');
        $recentLogins[$key]['first_name'] = $user['first_name'];
        $recentLogins[$key]['last_name'] = $user['last_name'];
        $recentLogins[$key]['email'] = $user['email'];
    }

    $response['recentLogins'] = $recentLogins;


    echo json_encode($response);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Database error: ' . $e->getMessage()
    ]);
}
