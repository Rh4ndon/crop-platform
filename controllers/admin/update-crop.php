<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../models/functions.php';

// Get crop ID from GET parameter or POST data
$crop_id = isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null);

if (!$crop_id) {
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode(['success' => false, 'error' => 'Crop ID is required']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'error' => ''];

    try {

        // Sanitize input
        $crop_name = htmlspecialchars(trim($_POST['crop_name']));
        $category = htmlspecialchars(trim($_POST['category']));
        $description = htmlspecialchars(trim($_POST['description']));
        $growth_period = htmlspecialchars(trim($_POST['growth_period']));
        $preferred_season = htmlspecialchars(trim($_POST['preferred_season']));
        $soil_type = htmlspecialchars(trim($_POST['soil_type']));
        $soil_ph = htmlspecialchars(trim($_POST['soil_ph']));
        $crop_calendar = htmlspecialchars(trim($_POST['crop_calendar']));
        $soil_properties = htmlspecialchars(trim($_POST['soil_properties']));
        $weather_season = htmlspecialchars(trim($_POST['weather_season']));
        $field_topography = htmlspecialchars(trim($_POST['field_topography']));
        $common_pests_diseases = htmlspecialchars(trim($_POST['common_pests_diseases']));
        $recommended_pesticides = htmlspecialchars(trim($_POST['recommended_pesticides']));
        $spray_method = htmlspecialchars(trim($_POST['spray_method']));
        $recommended_fertilizers = htmlspecialchars(trim($_POST['recommended_fertilizers']));
        $fertilizer_application = htmlspecialchars(trim($_POST['fertilizer_application']));

        // Prepare base data
        $data = [
            'crop_name' => $crop_name,
            'category' => $category,
            'description' => $description,
            'growth_period' => $growth_period,
            'preferred_season' => $preferred_season,
            'soil_type' => $soil_type,
            'soil_ph' => $soil_ph,
            'crop_calendar' => $crop_calendar,
            'soil_properties' => $soil_properties,
            'weather_season' => $weather_season,
            'field_topography' => $field_topography,
            'common_pests_diseases' => $common_pests_diseases,
            'recommended_pesticides' => $recommended_pesticides,
            'spray_method' => $spray_method,
            'recommended_fertilizers' => $recommended_fertilizers,
            'fertilizer_application' => $fertilizer_application,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Handle file upload (optional for updates)
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

            if (!in_array($image['type'], $allowed_types)) {
                throw new Exception("Invalid image type. Only JPG, PNG, and GIF are allowed.");
            }

            $upload_dir = '../../uploads/crops/';

            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                if (!mkdir($upload_dir, 0755, true)) {
                    throw new Exception("Failed to create upload directory.");
                }
            }

            // Generate unique filename
            $image_name = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $image['name']);
            $upload_file = $upload_dir . $image_name;

            if (!move_uploaded_file($image['tmp_name'], $upload_file)) {
                throw new Exception("Failed to upload image. Check directory permissions.");
            }

            // Get old image path before updating
            $old_crop = getRecord('crops', 'id = ' . intval($crop_id));
            if ($old_crop && !empty($old_crop['image_path'])) {
                $old_image_path = $upload_dir . $old_crop['image_path'];
                // Delete old image if it exists
                if (file_exists($old_image_path) && is_file($old_image_path)) {
                    if (!unlink($old_image_path)) {
                        error_log("Warning: Failed to delete old image: " . $old_image_path);
                    }
                }
            }

            $data['image_path'] = $image_name;
        }

        // Update the crop in the database
        $result = updateRecord('crops', $data, 'id = ' . intval($crop_id));

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Crop updated successfully!';
        } else {
            global $conn;
            if (isset($conn) && method_exists($conn, 'error')) {
                $response['error'] = 'Database error: ' . $conn->error;
                error_log("Database error: " . $conn->error);
            } else {
                $response['error'] = 'Failed to update crop in database.';
                error_log("Unknown database error occurred");
            }
        }
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }

    // Clear output and send JSON response
    ob_end_clean();
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// If not a POST request
ob_end_clean();
header('HTTP/1.1 405 Method Not Allowed');
echo json_encode(['success' => false, 'error' => 'Method not allowed']);
exit();
