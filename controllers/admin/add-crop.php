<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering
ob_start();
// Add this at the top after require_once
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../../models/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = ['success' => false, 'error' => ''];

    try {
        // Validate required fields
        $required_fields = [
            'crop_name',
            'category',
            'description',
            'growth_period',
            'preferred_season',
            'soil_type',
            'soil_ph',
            'crop_calendar',
            'soil_properties',
            'weather_season',
            'field_topography',
            'common_pests_diseases',
            'recommended_pesticides',
            'spray_method',
            'recommended_fertilizers',
            'fertilizer_application'
        ];

        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Please fill in the '$field' field.");
            }
        }

        // Validate file upload
        if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Image file is required and must be uploaded successfully.");
        }

        // Sanitize input (FIXED: Use proper filters)
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

        // Handle file upload
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

        // Prepare data
        $data = [
            'crop_name' => $crop_name,
            'category' => $category,
            'image_path' => $image_name,
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
            'created_at' => date('Y-m-d H:i:s'),
            'created_by' => $_SESSION['id'], // Make sure session is started and has 'id'
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Insert the crop into the database
        $result = insertRecord('crops', $data);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Crop added successfully!';
        } else {
            // Get more detailed error information
            global $conn;
            if (isset($conn) && method_exists($conn, 'error')) {
                $response['error'] = 'Database error: ' . $conn->error;
                error_log("Database error: " . $conn->error); // Log the error
            } else {
                $response['error'] = 'Failed to add crop to database. Unknown error.';
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
