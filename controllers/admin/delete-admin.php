<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../models/functions.php';

// Delete an admin (expects JSON input)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read raw POST data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $response = ['success' => false, 'error' => ''];

    if (!isset($data['id']) || !is_numeric($data['id'])) {
        $response['error'] = 'Invalid admin ID.';
    } else {
        $adminId = (int)$data['id'];
        $result = deleteRecord('users', "id = $adminId");

        if ($result) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Failed to delete admin.';
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
