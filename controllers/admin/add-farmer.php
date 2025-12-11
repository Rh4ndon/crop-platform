<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering to prevent any accidental output
ob_start();

require_once '../../models/functions.php';

/**
 * Generate the next ULI (Unique Learner Identifier)
 * Format: ALF-90-606-02031-XXX (where XXX is auto-incremented)
 * 
 * @return string The generated ULI
 */
function generateULI()
{
    $prefix = 'ALF-90-606-02031-';
    $next_number = 1; // Default starting number

    try {
        // Get the latest ULI from the database
        $latest_user = getAllRecords('users', "WHERE role = 'farmer' AND uli IS NOT NULL AND uli != '' ORDER BY id DESC LIMIT 1");

        // Check if we found any existing records with ULI
        if ($latest_user && is_array($latest_user) && count($latest_user) > 0 && isset($latest_user[0]['uli'])) {
            $latest_uli = $latest_user[0]['uli'];

            // Extract the numeric part after the last dash
            $parts = explode('-', $latest_uli);

            // Validate that we have the expected format
            if (count($parts) >= 5) {
                $last_number = intval(end($parts));

                // Only increment if we got a valid number
                if ($last_number > 0) {
                    $next_number = $last_number + 1;
                }
            }
        }

        // Format the number with leading zeros (3 digits)
        $formatted_number = str_pad($next_number, 3, '0', STR_PAD_LEFT);

        return $prefix . $formatted_number;
    } catch (Exception $e) {
        // If there's any error, log it and return the first ULI
        error_log("Error generating ULI: " . $e->getMessage());
        return $prefix . '001';
    }
}

// Insert a new student/farmer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize response array
    $response = ['success' => false, 'error' => ''];

    try {
        // Validate required fields based on your form
        $required_fields = ['first_name', 'last_name', 'barangay', 'city', 'province', 'phone', 'gender', 'birth_month', 'birth_day', 'birth_year'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Please fill in all required fields: " . str_replace('_', ' ', $field));
            }
        }

        // Generate ULI
        $uli = generateULI();

        // Handle profile picture upload
        $profile_picture = null;
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
            $file_type = $_FILES['profile_picture']['type'];

            if (!in_array($file_type, $allowed_types)) {
                throw new Exception("Invalid file type. Only JPG, PNG, and GIF images are allowed.");
            }

            // Check file size (limit to 5MB)
            if ($_FILES['profile_picture']['size'] > 5 * 1024 * 1024) {
                throw new Exception("File size too large. Maximum size is 5MB.");
            }

            // Create upload directory if it doesn't exist
            $upload_dir = '../../uploads/profiles/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Generate unique filename
            $file_extension = pathinfo($_FILES['profile_picture']['name'], PATHINFO_EXTENSION);
            $profile_picture = uniqid('profile_') . '.' . $file_extension;
            $upload_path = $upload_dir . $profile_picture;

            if (!move_uploaded_file($_FILES['profile_picture']['tmp_name'], $upload_path)) {
                throw new Exception("Failed to upload profile picture.");
            }
        } else if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] !== UPLOAD_ERR_NO_FILE) {
            throw new Exception("Error uploading profile picture. Please try again.");
        }

        // Sanitize basic information
        $first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);
        $last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
        $middle_name = isset($_POST['middle_name']) ? filter_var(trim($_POST['middle_name']), FILTER_SANITIZE_STRING) : '';

        // Sanitize address information
        $street = isset($_POST['street']) ? filter_var(trim($_POST['street']), FILTER_SANITIZE_STRING) : '';
        $barangay = filter_var(trim($_POST['barangay']), FILTER_SANITIZE_STRING);
        $district = isset($_POST['district']) ? filter_var(trim($_POST['district']), FILTER_SANITIZE_STRING) : '';
        $city = filter_var(trim($_POST['city']), FILTER_SANITIZE_STRING);
        $province = filter_var(trim($_POST['province']), FILTER_SANITIZE_STRING);
        $region = isset($_POST['region']) ? filter_var(trim($_POST['region']), FILTER_SANITIZE_STRING) : '';

        // Sanitize contact information
        $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
        $nationality = isset($_POST['nationality']) ? filter_var(trim($_POST['nationality']), FILTER_SANITIZE_STRING) : '';

        // Validate email if provided
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Please enter a valid email address.");
        }

        // Check if email already exists (if email is provided)
        if (!empty($email)) {
            $existing_email = getAllRecords('users', "WHERE email = '$email' AND role = 'farmer'");
            if ($existing_email) {
                throw new Exception("Email already exists. Please use a different email.");
            }
        }

        // Check if student with same name already exists
        $existing_name = getAllRecords('users', "WHERE first_name = '$first_name' AND last_name = '$last_name' AND role = 'farmer'");
        if ($existing_name) {
            throw new Exception("Student with this name already exists.");
        }

        // Personal information
        $gender = filter_var(trim($_POST['gender']), FILTER_SANITIZE_STRING);
        $civil_status = isset($_POST['civil_status']) ? filter_var(trim($_POST['civil_status']), FILTER_SANITIZE_STRING) : '';
        $employment_status = isset($_POST['employment_status']) ? filter_var(trim($_POST['employment_status']), FILTER_SANITIZE_STRING) : '';

        // Birthdate and age
        $birth_month = filter_var(trim($_POST['birth_month']), FILTER_SANITIZE_STRING);
        $birth_day = filter_var(trim($_POST['birth_day']), FILTER_SANITIZE_NUMBER_INT);
        $birth_year = filter_var(trim($_POST['birth_year']), FILTER_SANITIZE_NUMBER_INT);
        $birthdate = "$birth_year-" . date('m', strtotime($birth_month)) . "-" . str_pad($birth_day, 2, '0', STR_PAD_LEFT);
        $age = isset($_POST['age']) ? filter_var(trim($_POST['age']), FILTER_SANITIZE_NUMBER_INT) : '';

        // Birthplace
        $birthplace_city = isset($_POST['birthplace_city']) ? filter_var(trim($_POST['birthplace_city']), FILTER_SANITIZE_STRING) : '';
        $birthplace_province = isset($_POST['birthplace_province']) ? filter_var(trim($_POST['birthplace_province']), FILTER_SANITIZE_STRING) : '';
        $birthplace_region = isset($_POST['birthplace_region']) ? filter_var(trim($_POST['birthplace_region']), FILTER_SANITIZE_STRING) : '';

        // Educational attainment
        $education = isset($_POST['education']) ? filter_var(trim($_POST['education']), FILTER_SANITIZE_STRING) : '';

        // Classification
        $classification = isset($_POST['classification']) ? filter_var(trim($_POST['classification']), FILTER_SANITIZE_STRING) : '';

        // Generate default password
        $password = password_hash('farmer123', PASSWORD_BCRYPT);

        // Prepare data array for insertion
        $data = [
            'uli' => $uli,
            'first_name' => $first_name,
            'last_name' => $last_name,
            'middle_name' => $middle_name,
            'email' => $email,
            'phone' => $phone,
            'gender' => $gender,
            'role' => 'farmer', // Keep as 'farmer' to maintain compatibility with your existing system
            'password' => $password,
            'profile_picture' => $profile_picture,
            'number_street' => $street,
            'barangay' => $barangay,
            'district' => $district,
            'city_municipality' => $city,
            'province' => $province,
            'region' => $region,
            'nationality' => $nationality,
            'civil_status' => $civil_status,
            'employment_status' => $employment_status,
            'birthdate' => $birthdate,
            'birthplace_city' => $birthplace_city,
            'birthplace_province' => $birthplace_province,
            'birthplace_region' => $birthplace_region,
            'education_level' => $education,
            'classification' => $classification,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Insert the student into the database
        $result = insertRecord('users', $data);

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Student registered successfully!';
            $response['uli'] = $uli; // Return the generated ULI
        } else {
            // If insert failed and we uploaded a file, delete it
            if ($profile_picture && file_exists($upload_dir . $profile_picture)) {
                unlink($upload_dir . $profile_picture);
            }
            throw new Exception('Failed to add student to database.');
        }
    } catch (Exception $e) {
        // If there was an error and we uploaded a file, delete it
        if (isset($profile_picture) && isset($upload_dir) && file_exists($upload_dir . $profile_picture)) {
            unlink($upload_dir . $profile_picture);
        }
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
