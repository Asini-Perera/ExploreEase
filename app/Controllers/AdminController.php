<?php

namespace app\controllers;

use app\models\AdminModel;

class AdminController {
    private $conn;

    public function __construct() {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the AdminModel
        require_once __DIR__ . '/../models/AdminModel.php';
    }
    
    public function index() {
        // Logic for admin login page
        require_once __DIR__ . '/../views/admin_login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $AdminID = $_POST['AdminID'];
            $password = $_POST['password'];
            
            // Use the AdminModel to get the admin data by AdminID
            $adminModel = new AdminModel($this->conn);
            $admin = $adminModel->getAdminByID($AdminID);

            // Verify the password
            // if ($admin && password_verify($password, $admin['Password'])) {
            if ($admin && $password == $admin['Password']) {
                // Start session and save admin details
                session_start();
                $_SESSION['AdminID'] = $admin['AdminID'];
                $_SESSION['Name'] = $admin['FirstName'];

                // Redirect to admin dashboard
                header('Location: ../admin/dashboard');
                exit();
            } else {
                // If login fails, redirect back to login page and show an error message
                $error = "Invalid AdminID or password";
                // Redirect to admin login page
                header('Location: ../admin');
            }
        }
    }

    public function dashboard() {
        // Logic for admin dashboard
        //session_start();
        if (isset($_SESSION['AdminID'])) {
            require_once __DIR__ . '/../views/admin_dashboard.php';
        } else {
            header('Location: admin');
            exit();
        }
    }
}
