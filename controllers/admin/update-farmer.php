<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering to prevent any accidental output
ob_start();

require_once '../../models/functions.php';

// Update farmer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize response array
    $response = ['success' => false, 'error' => ''];

    try {
        // Validate required fields
        $required_fields = ['first_name', 'last_name', 'barangay', 'city_municipality', 'province', 'phone', 'gender', 'birthdate'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Please fill in all required fields. Missing: " . $field);
            }
        }

        // Sanitize input
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_NUMBER_INT);
        $first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);
        $middle_name = isset($_POST['middle_name']) ? filter_var(trim($_POST['middle_name']), FILTER_SANITIZE_STRING) : '';
        $last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
        $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);

        // Address fields
        $number_street = isset($_POST['number_street']) ? filter_var(trim($_POST['number_street']), FILTER_SANITIZE_STRING) : '';
        $barangay = filter_var(trim($_POST['barangay']), FILTER_SANITIZE_STRING);
        $district = isset($_POST['district']) ? filter_var(trim($_POST['district']), FILTER_SANITIZE_STRING) : '';
        $city_municipality = filter_var(trim($_POST['city_municipality']), FILTER_SANITIZE_STRING);
        $province = filter_var(trim($_POST['province']), FILTER_SANITIZE_STRING);
        $region = isset($_POST['region']) ? filter_var(trim($_POST['region']), FILTER_SANITIZE_STRING) : '';

        // Personal information
        $nationality = isset($_POST['nationality']) ? filter_var(trim($_POST['nationality']), FILTER_SANITIZE_STRING) : 'Filipino';
        $gender = filter_var(trim($_POST['gender']), FILTER_SANITIZE_STRING);
        $birthdate = filter_var(trim($_POST['birthdate']), FILTER_SANITIZE_STRING);
        $birthplace_city = isset($_POST['birthplace_city']) ? filter_var(trim($_POST['birthplace_city']), FILTER_SANITIZE_STRING) : '';
        $birthplace_province = isset($_POST['birthplace_province']) ? filter_var(trim($_POST['birthplace_province']), FILTER_SANITIZE_STRING) : '';
        $birthplace_region = isset($_POST['birthplace_region']) ? filter_var(trim($_POST['birthplace_region']), FILTER_SANITIZE_STRING) : '';
        $civil_status = isset($_POST['civil_status']) ? filter_var(trim($_POST['civil_status']), FILTER_SANITIZE_STRING) : '';
        $employment_status = isset($_POST['employment_status']) ? filter_var(trim($_POST['employment_status']), FILTER_SANITIZE_STRING) : '';
        $education_level = isset($_POST['education_level']) ? filter_var(trim($_POST['education_level']), FILTER_SANITIZE_STRING) : '';
        $classification = isset($_POST['classification']) ? filter_var(trim($_POST['classification']), FILTER_SANITIZE_STRING) : '';

        // Validate email format if provided
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Please enter a valid email address.");
        }

        // Validate birthdate format
        if (!empty($birthdate) && !strtotime($birthdate)) {
            throw new Exception("Please enter a valid birthdate.");
        }

        // Handle file upload for profile picture
        $profile_picture = null;
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../../../uploads/profiles/';

            // Create directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $file_extension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array(strtolower($file_extension), $allowed_extensions)) {
                throw new Exception("Only JPG, JPEG, PNG, and GIF files are allowed.");
            }

            // Generate unique filename
            $profile_picture = 'profile_' . uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $profile_picture;

            if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
                throw new Exception("Failed to upload profile picture.");
            }
        }

        // Prepare data for update
        $data = [
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'number_street' => $number_street,
            'barangay' => $barangay,
            'district' => $district,
            'city_municipality' => $city_municipality,
            'province' => $province,
            'region' => $region,
            'email' => $email,
            'phone' => $phone,
            'nationality' => $nationality,
            'gender' => $gender,
            'birthdate' => $birthdate,
            'birthplace_city' => $birthplace_city,
            'birthplace_province' => $birthplace_province,
            'birthplace_region' => $birthplace_region,
            'civil_status' => $civil_status,
            'employment_status' => $employment_status,
            'education_level' => $education_level,
            'classification' => $classification,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Add profile picture to data if uploaded
        if ($profile_picture) {
            $data['profile_picture'] = $profile_picture;

            // Get current profile picture to delete it later
            $current_farmer = getRecord('users', "id =" . $id);
            if ($current_farmer && !empty($current_farmer['profile_picture'])) {
                $old_picture_path = $upload_dir . $current_farmer['profile_picture'];
                if (file_exists($old_picture_path)) {
                    unlink($old_picture_path);
                }
            }
        }

        // Update the farmer in the database
        $result = updateRecord('users', $data, "id = $id");

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Student updated successfully!';
        } else {
            throw new Exception('Failed to update student in database.');
        }
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }

    // Clear any previous output
    ob_end_clean();

    // Set proper header and return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// If not a POST request
ob_end_clean();
header('HTTP/1.1 405 Method Not Allowed');
echo json_encode(['success' => false, 'error' => 'Method not allowed']);
exit();
