<?php

namespace app\Controllers;

use app\Models\LoginModel;

class LoginController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the AdminModel
        require_once __DIR__ . '/../models/LoginModel.php';
    }

    public function index()
    {
        require_once __DIR__ . '/../Views/login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Use the LoginModel to get the user by email
            $userModel = new LoginModel($this->conn);
            $user = $userModel->getUserByEmail($email);

            // Verify the password
            if ($user && password_verify($password, $user['Password'])) {
                // Start session and save admin details
                session_start();
                $_SESSION['Email'] = $user['Email'];
                $_SESSION['Name'] = $user['FirstName'];

                if (isset($_POST['remember'])) {
                    // Set cookie for admin login
                    setcookie('Email', $user['Email'], time() + (3600 * 24 * 30), "/");
                } else {
                    // Unset the cookie
                    setcookie('Email', "", time() - 1, "/");
                }

                // Redirect to pages based on user type
                switch ($user['Type']) {
                    case 'traveler':
                        header('Location: ../ExploreEase');
                        break;
                    case 'hotel':
                        header('Location: ../hotel/dashboard');
                        break;
                    case 'restaurant':
                        header('Location: ../restaurant/dashboard');
                        break;
                    case 'heritagemarket':
                        header('Location: ../heritagemarket/dashboard');
                        break;
                    case 'culturaleventorganizer':
                        header('Location: ../culturaleventorganizer/dashboard');
                        break;
                }

                exit();
            } else {
                // If login fails, redirect back to login page and show an error message
                $_SESSION['error'] = "Invalid Email or Password.";
                header('Location: ../login');
                exit();
            }
        }
    }
}
