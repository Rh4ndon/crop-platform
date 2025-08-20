<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start output buffering to prevent any accidental output
ob_start();

require_once '../../models/functions.php';

// Insert a new farmer
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize response array
    $response = ['success' => false, 'error' => ''];

    try {
        // Validate required fields
        $required_fields = ['first_name', 'last_name', 'email', 'phone'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("Please fill in all required fields.");
            }
        }

        // Sanitize input
        $first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);
        $last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);
        $address = isset($_POST['address']) ? filter_var(trim($_POST['address']), FILTER_SANITIZE_STRING) : '';
        $gender = isset($_POST['gender']) ? filter_var(trim($_POST['gender']), FILTER_SANITIZE_STRING) : '';

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Please enter a valid email address.");
        }

        // Check if email already exists
        // You'll need to implement this check based on your database structure
        $existing_email = getAllRecords('users', "WHERE email = '$email'");
        if ($existing_email) {
            throw new Exception("Email already exists. Please use a different email.");
        }
        $existing_name = getAllRecords('users', "WHERE first_name = '$first_name' AND last_name = '$last_name'");
        if ($existing_name) {
            throw new Exception("Farmer with this name already exists. Please use a different name.");
        }

        // Generate default password
        $password = password_hash('admin123', PASSWORD_BCRYPT);

        $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'phone' => $phone,
            'address' => $address,
            'gender' => $gender,
            'role' => 'admin', // Set role to admin
            'password' => $password,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Insert the admin into the database
        $result = insertRecord('users', $data);

        if ($result) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Failed to add admin to database.';
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
