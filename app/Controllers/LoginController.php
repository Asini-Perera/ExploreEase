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
                $_SESSION['Name'] = $user['Name'];

                if (isset($_POST['remember'])) {
                    // Set cookie for admin login
                    setcookie('Email', $user['Email'], time() + (3600 * 24 * 30), "/");
                } else {
                    // Unset the cookie
                    setcookie('Email', "", time() - 1, "/");
                }

                if ($user['Type'] !== 'traveler' && $user['IsVerified'] == 0) {
                    // If user is not verified and not a traveler, redirect to waiting page
                    header('Location: ../waiting/');
                    exit();
                }

                // Redirect to pages based on user type
                switch ($user['Type']) {
                    case 'traveler':
                        $_SESSION['TravelerID'] = $user['TravelerID'];
                        $_SESSION['Email'] = $user['Email'];
                        $_SESSION['FirstName'] = $user['FirstName'];
                        $_SESSION['LastName'] = $user['LastName'];
                        $_SESSION['Gender'] = $user['Gender'];
                        header('Location: ../ExploreEase');
                        break;
                    case 'hotel':
                        $_SESSION['HotelID'] = $user['HotelID'];
                        header('Location: ../hotel/dashboard');
                        break;
                    case 'restaurant':
                        $_SESSION['RestaurantID'] = $user['RestaurantID'];
                        $_SESSION['Email'] = $user['Email'];
                        $_SESSION['Name'] = $user['Name'];
                        header('Location: ../restaurant/dashboard');
                        break;
                    case 'heritagemarket':
                        $_SESSION['ShopID'] = $user['ShopID'];
                        header('Location: ../heritagemarket/dashboard');
                        break;
                    case 'culturaleventorganizer':
                        $_SESSION['OrganizerID'] = $user['OrganizerID'];
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

    public function waiting()
    {
        if (isset($_SESSION['Name'])) {
            require_once __DIR__ . '/../Views/waiting.php';
        } else {
            header('Location: ../login');
        }
    }
}
