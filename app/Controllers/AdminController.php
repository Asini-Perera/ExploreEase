<?php

namespace app\controllers;

use app\models\AdminModel;

class AdminController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the AdminModel
        require_once __DIR__ . '/../models/AdminModel.php';
    }

    public function index()
    {
        // Logic for admin login page
        require_once __DIR__ . '/../views/admin_login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Use the AdminModel to get the admin data by AdminID
            $adminModel = new AdminModel($this->conn);
            $admin = $adminModel->getAdminByEmail($email);

            // Verify the password
            if ($admin && password_verify($password, $admin['Password'])) {
                // Start session and save admin details
                session_start();
                $_SESSION['AdminID'] = $admin['AdminID'];
                $_SESSION['Email'] = $admin['Email'];
                $_SESSION['Name'] = $admin['FirstName'];

                if (isset($_POST['remember'])) {
                    // Set cookie for admin login
                    setcookie('Email', $admin['Email'], time() + (3600 * 24 * 30), "/");
                } else {
                    // Unset the cookie
                    setcookie('Email', "", time() - 1, "/");
                }

                // Check if the admin is verified
                if ($admin['IsVerified']) {
                    // Redirect to admin dashboard
                    header('Location: ../admin/dashboard');
                } else {
                    // Redirect to admin waiting page
                    header('Location: ../admin/waiting');
                }

                exit();
            } else {
                // If login fails, redirect back to login page and show an error message
                $_SESSION['error'] = "Invalid Email or Password.";
                header('Location: ../admin');
                exit();
            }
        }
    }

    public function create()
    {
        // Logic for admin signup page
        require_once __DIR__ . '/../views/admin_signup.php';
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $contactNo = $_POST['contactNo'];
            $profileImage = $_FILES['profile_image'];

            $adminModel = new AdminModel($this->conn);
            $AdminID = $adminModel->createAdmin($firstName, $lastName, $email, $password, $contactNo);

            // If image is uploaded, set the image path
            if ($AdminID && $profileImage['name']) {
                $adminModel->setImgPath($AdminID, $profileImage);
            }

            // Redirect to admin waiting page
            if ($AdminID) {
                session_start();
                $_SESSION['AdminID'] = $AdminID;
                $_SESSION['Name'] = $firstName;
                $_SESSION['Email'] = $email;
                header('Location: ../admin/waiting');
                exit();
            } else {
                // If signup fails, redirect back to signup page and show an error message
                $_SESSION['error'] = "Failed to create an account";
                header('Location: ../admin/create');
                exit();
            }
        }
    }

    public function waiting()
    {
        // Logic for admin waiting page
        if (isset($_SESSION['AdminID'])) {
            require_once __DIR__ . '/../views/admin_waiting.php';
        } else {
            header('Location: admin');
            exit();
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['AdminID'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : 'admin_main';
            $allowedPages = ['admin_main', 'admin_verify', 'admin', 'traveler', 'restaurant'];
            $mainContent = in_array($page, $allowedPages) ? $page : 'admin_main';

            // Pass data to the view
            $data = [
                'mainContent' => $mainContent,
                'adminName' => $_SESSION['Name']
            ];

            // Load the main dashboard layout
            $this->render('admin_dashboard', $data);
        } else {
            header('Location: admin');
            exit();
        }

        // Logic for admin dashboard
        // if (isset($_SESSION['AdminID'])) {
        //     require_once __DIR__ . '/../views/admin_dashboard.php';
        // } else {
        //     header('Location: admin');
        //     exit();
        // }
    }

    private function render($view, $data = [])
    {
        // Extract the data array to variables
        extract($data);

        // Load the view file
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    public function logout()
    {
        // Logic for admin logout
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../admin');
        exit();
    }
}
