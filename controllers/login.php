<?php
include '../models/functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getRecord('users', 'email = "' . $email . '"');

    if ($user && password_verify($password, $user['password'])) {
        //Insert to login
        insertRecord('login', [
            'user_id' => $user['id'],
        ]);
        if ($user['role'] == 'admin') {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_logged_in'] = true;
            $_SESSION['login_time'] = time();
            // save data to sessionStorage
            echo "<script>
                sessionStorage.setItem('id', '" . $user['id'] . "');
                sessionStorage.setItem('role', '" . $user['role'] . "');
                sessionStorage.setItem('first_name', '" . $user['first_name'] . "');
                sessionStorage.setItem('last_name', '" . $user['last_name'] . "');
                sessionStorage.setItem('email', '" . $user['email'] . "');
                sessionStorage.setItem('gender', '" . $user['gender'] . "');
                sessionStorage.setItem('phone', '" . $user['phone'] . "');
                sessionStorage.setItem('is_logged_in', true);
                sessionStorage.setItem('login_time', " . time() . ");
                window.location.href = '../view/admin/dashboard.html?msg=Welcome " . $user['first_name'] . " " . $user['last_name'] . "';
            </script>";
            exit();
        } else {
            session_start();
            $_SESSION['id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['is_logged_in'] = true;
            $_SESSION['login_time'] = time();
            // save data to sessionStorage
            echo "<script>
                sessionStorage.setItem('id', '" . $user['id'] . "');
                sessionStorage.setItem('role', '" . $user['role'] . "');
                sessionStorage.setItem('first_name', '" . $user['first_name'] . "');
                sessionStorage.setItem('last_name', '" . $user['last_name'] . "');
                sessionStorage.setItem('email', '" . $user['email'] . "');
                sessionStorage.setItem('gender', '" . $user['gender'] . "');
                sessionStorage.setItem('phone', '" . $user['phone'] . "');
                sessionStorage.setItem('profile_picture', '" . $user['profile_picture'] . "');
                sessionStorage.setItem('is_logged_in', true);
                sessionStorage.setItem('login_time', " . time() . ");
                window.location.href = '../view/farmer/dashboard.html?msg=Welcome " . $user['first_name'] . " " . $user['last_name'] . "';
            </script>";
            exit();
        }
    } else if ($user && !password_verify($password, $user['password'])) {
        header('Location: ../index.html?error=Invalid password.');
        exit();
    } else if (!$user) {
        header('Location: ../index.html?error=Invalid email');
        exit();
    }
}
