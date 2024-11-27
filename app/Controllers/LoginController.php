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

            // Use the LoginModel to get the user data by Email
            $loginModel = new LoginModel($this->conn);
            $user = $loginModel->getUserByEmail($email);

            // Verify the password
            if ($user && password_verify($password, $user['Password'])) {
                // Start session and save user details
                session_start();
                $_SESSION['UserID'] = $user['UserID'];
                $_SESSION['Email'] = $user['Email'];
                $_SESSION['Name'] = $user['FirstName'];

                if (isset($_POST['remember'])) {
                    // Set cookie for user login
                    setcookie('Email', $user['Email'], time() + (3600 * 24 * 30), "/");
                } else {
                    // Unset the cookie
                    setcookie('Email', "", time() - 1, "/");
                }

                // Redirect to user dashboard
                header('Location: ../user/dashboard');
            } else {
                // Redirect to login page with error message
                header('Location: ../login?error=1');
            }
        }
    }
}
