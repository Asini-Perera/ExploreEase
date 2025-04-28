<?php

namespace app\Controllers;

use app\Models\AdminModel;
use app\Models\SignupModel;

use app\Controllers\KeywordController;

class AdminController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the AdminModel and SignupModel
        require_once __DIR__ . '/../models/AdminModel.php';
        require_once __DIR__ . '/../models/SignupModel.php';

        // Include the KeywordController
        require_once __DIR__ . '/KeywordController.php';
    }

    public function index()
    {
        // Logic for admin login page
        require_once __DIR__ . '/../Views/admin_login.php';
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Use the AdminModel to get the admin data by Email
            $adminModel = new AdminModel($this->conn);
            $admin = $adminModel->getAdminByEmail($email);

            // Verify the password
            if ($admin && password_verify($password, $admin['Password'])) {
                // Start session and save admin details
                session_start();
                $_SESSION['AdminID'] = $admin['AdminID'];
                $_SESSION['Email'] = $admin['Email'];
                $_SESSION['FirstName'] = $admin['FirstName'];
                $_SESSION['LastName'] = $admin['LastName'];
                $_SESSION['ContactNo'] = $admin['ContactNo'];
                $_SESSION['ProfileImage'] = $admin['ImgPath'];

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
        require_once __DIR__ . '/../Views/admin_signup.php';
    }

    public function signup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $contactNo = $_POST['contactNo'];
            $profileImage = $_FILES['profile_image'];

            // Check if email already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                $_SESSION['error'] = "Email already exists";
                header('Location: ../admin/create');
                exit();
            }

            // Check if password and confirm password match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match";
                header('Location: ../admin/create');
                exit();
            }

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
        if (isset($_SESSION['Email'])) {
            require_once __DIR__ . '/../Views/waiting.php';
        } else {
            header('Location: admin');
            exit();
        }
    }

    public function dashboard()
    {
        if (isset($_SESSION['AdminID'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
            $allowedPages = ['dashboard', 'verifyuser', 'viewkeyword', 'verifykeyword', 'search', 'profile'];
            $mainContent = in_array($page, $allowedPages) ? $page : '404';

            if ($mainContent == 'dashboard') {
                $adminModel = new AdminModel($this->conn);
                $totalTravelers = $adminModel->getTotalUsers('traveler');
                $totalAdmins = $adminModel->getTotalUsers('admin');
                $totalRestaurants = $adminModel->getTotalUsers('restaurant');
                $totalHotels = $adminModel->getTotalUsers('hotel');
                $totalHeritageMarkets = $adminModel->getTotalUsers('heritagemarket');
                $totalCulturalEventOrganizers = $adminModel->getTotalUsers('culturaleventorganizer');
            } elseif ($mainContent == 'verifyuser') {
                $user = isset($_GET['user']) ? $_GET['user'] : 'admin';
                $allowedUsers = ['admin', 'restaurant', 'hotel', 'heritagemarket', 'culturaleventorganizer'];
                $verifyUser = in_array($user, $allowedUsers) ? $user : '404';
                if ($verifyUser === '404') {
                    $mainContent = '404';
                } else {
                    $adminModel = new AdminModel($this->conn);
                    $users = $adminModel->getUnverifiedUsers($verifyUser);
                    if ($verifyUser === 'admin') {
                        $type = 'admin';
                    } elseif ($verifyUser === 'culturaleventorganizer') {
                        $type = 'culturaleventorganizer';
                    } else {
                        $type = 'service';
                    }
                }
            } elseif ($mainContent == 'viewkeyword') {
                $keywordController = new KeywordController();
                $categories = $keywordController->getCategoriesWithKeywords();
            } elseif ($mainContent == 'verifykeyword') {
                $user = isset($_GET['user']) ? $_GET['user'] : 'restaurant';
                $allowedUsers = ['restaurant', 'hotel', 'heritagemarket', 'culturaleventorganizer'];
                $verifyKeyword = in_array($user, $allowedUsers) ? $user : '404';
                if ($verifyKeyword === '404') {
                    $mainContent = '404';
                } else {
                    $keywordController = new KeywordController();
                    $serviceProviders = $keywordController->getUnverifiedKeywords($verifyKeyword);
                }
            } elseif ($mainContent == 'search') {
                $user = isset($_GET['user']) ? $_GET['user'] : 'traveler';
                $allowedUsers = ['traveler', 'admin', 'restaurant', 'hotel', 'heritagemarket', 'culturaleventorganizer'];
                $searchUser = in_array($user, $allowedUsers) ? $user : '404';
                if ($searchUser === '404') {
                    $mainContent = '404';
                } else {
                    $adminModel = new AdminModel($this->conn);
                    $searchQuery = isset($_GET['query']) ? $_GET['query'] : "";
                    $searchResults = $adminModel->searchUsers($searchUser, $searchQuery);
                    if ($searchUser === 'traveler') {
                        $type = 'traveler';
                    } elseif ($searchUser === 'admin') {
                        $type = 'admin';
                    } elseif ($searchUser === 'culturaleventorganizer') {
                        $type = 'culturaleventorganizer';
                    } else {
                        $type = 'service';
                    }
                }
            } elseif ($mainContent == 'profile') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                $allowedActions = ['edit', 'changepassword'];
                $profileAction = in_array($action, $allowedActions) ? $action : null;
                if ($profileAction === '404') {
                    $mainContent = '404';
                }
            }

            // Load the main dashboard layout
            require_once __DIR__ . '/../Views/admin_dashboard/main.php';
        } else {
            header('Location: ../admin');
            exit();
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminID = $_SESSION['AdminID'];
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $contactNo = $_POST['contactNo'];
            $profileImage = $_FILES['profile_image'];

            // Check if email already exists and it's not the current user's email
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user && $user['AdminID'] !== $adminID) {
                $_SESSION['error'] = "Email already exists";
                header('Location: ../admin/dashboard?page=profile&action=edit');
                exit();
            }

            $adminModel = new AdminModel($this->conn);
            $success = $adminModel->updateAdmin($adminID, $firstName, $lastName, $email, $contactNo);

            if ($success) {
                $_SESSION['success'] = "Profile updated successfully";
            } else {
                $_SESSION['error'] = "Failed to update profile";
            }

            if ($profileImage['name']) {
                $adminModel->setImgPath($adminID, $profileImage);
            }

            $_SESSION['FirstName'] = $firstName;
            $_SESSION['LastName'] = $lastName;
            $_SESSION['Email'] = $email;
            $_SESSION['ContactNo'] = $contactNo;
            $_SESSION['ProfileImage'] = $adminModel->getImgPath($adminID);

            header('Location: ../admin/dashboard?page=profile');
            exit();
        }
    }

    public function verifyUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $userType = $_POST['userType'];
            $page = $_POST['page'];
            $action = $_POST['action'];

            $adminModel = new AdminModel($this->conn);
            if ($action === 'verify') {
                $success = $adminModel->verifyUser($email, $userType);
                if ($success) {
                    $_SESSION['success'] = "User verified successfully.";
                } else {
                    $_SESSION['error'] = "Verification failed.";
                }
            } elseif ($action === 'reject') {
                $success = $adminModel->rejectUser($email, $userType);
                if ($success) {
                    $_SESSION['success'] = "User removed successfully.";
                } else {
                    $_SESSION['error'] = "Removal failed.";
                }
            }

            header('Location: ../admin/dashboard?page=' . $page . '&user=' . $userType);
            exit();
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $adminID = $_SESSION['AdminID'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $adminModel = new AdminModel($this->conn);
            $valid = $adminModel->checkCurrentPassword($adminID, $currentPassword);

            if ($valid) {
                if ($newPassword === $confirmPassword) {
                    $success = $adminModel->changePassword($adminID, $newPassword);
                    if ($success) {
                        $_SESSION['success'] = 'Password changed successfully';
                    } else {
                        $_SESSION['error'] = 'Failed to change password';
                    }
                    header('Location: ../admin/dashboard?page=profile');
                    exit();
                } else {
                    $_SESSION['error'] = 'New password and confirm password do not match';
                    header('Location: ../admin/dashboard?page=profile&action=changepassword');
                    exit();
                }
            } else {
                $_SESSION['error'] = 'Current password is incorrect';
                header('Location: ../admin/dashboard?page=profile&action=changepassword');
                exit();
            }
        }
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../admin');
        exit();
    }
}
