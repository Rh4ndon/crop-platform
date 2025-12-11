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
        $id = filter_var(trim($_POST['id']), FILTER_SANITIZE_NUMBER_INT);
        $first_name = filter_var(trim($_POST['first_name']), FILTER_SANITIZE_STRING);
        $last_name = filter_var(trim($_POST['last_name']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = filter_var(trim($_POST['phone']), FILTER_SANITIZE_STRING);

        $gender = isset($_POST['gender']) ? filter_var(trim($_POST['gender']), FILTER_SANITIZE_STRING) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Please enter a valid email address.");
        }

        // if password is empty, do not update it
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,

                'gender' => $gender,
                'password' => $password,
                'updated_at' => date('Y-m-d H:i:s')
            ];
        } else {
            $data = [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,

                'gender' => $gender,
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }





        // Insert the admin into the database
        $result = updateRecord('users', $data, "id = $id");

        if ($result) {
            $response['success'] = true;
        } else {
            $response['error'] = 'Failed to update admin in database.';
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
