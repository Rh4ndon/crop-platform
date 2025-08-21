<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../models/functions.php';

// Delete a crop (expects JSON input)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read raw POST data
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    $response = ['success' => false, 'error' => ''];

    if (!isset($data['id']) || !is_numeric($data['id'])) {
        $response['error'] = 'Invalid crop ID.';
    } else {
        $cropId = (int)$data['id'];

        // Get old image path before updating
        $old_crop = getRecord('crops', 'id = ' . intval($cropId));

        $upload_dir = '../../uploads/crops/';
        if ($old_crop && !empty($old_crop['image_path'])) {
            $old_image_path = $upload_dir . $old_crop['image_path'];
            // Delete old image if it exists
            if (file_exists($old_image_path) && is_file($old_image_path)) {
                if (!unlink($old_image_path)) {
                    error_log("Warning: Failed to delete old image: " . $old_image_path);
                }
            }
        }

        $result = deleteRecord('crops', "id = $cropId");



        if ($result) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Failed to delete crop.';
        }
    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
