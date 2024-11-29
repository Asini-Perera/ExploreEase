<?php

namespace app\Controllers;

use app\Models\SignupModel;
use app\Models\TravelerModel;

class SignupController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the Models
        require_once __DIR__ . '/../models/SignupModel.php';
        require_once __DIR__ . '/../models/TravelerModel.php';
    }

    public function index()
    {
        $user = isset($_GET['user']) ? $_GET['user'] : null;
        $allowedUsers = ['traveler', 'hotel', 'restaurant', 'heritagemarket', 'culturaleventorganizer'];
        $user = in_array($user, $allowedUsers) ? $user : null;

        if ($user) {
            require_once __DIR__ . '/../Views/signup/signup_' . $user . '.php';
        } else {
            require_once __DIR__ . '/../Views/signup/signup.php';
        }
    }

    public function traveler()
    {
       if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['firstname'];
            $lastName = $_POST['lastname'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
            $dob = isset($_POST['dob']) && $_POST['dob'] !== '0000-00-00' ? $_POST['dob'] : null;
            $contactNo = $_POST['contactNo'];
            $profileImage = isset($_FILES['profile_image']) ? $_FILES['profile_image'] : null;

            // Check if email already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                $_SESSION['error'] = "Email already exists";
                header('Location: ../signup/traveler');
                exit();
            }

            // Check if password and confirm password match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match";
                header('Location: ../signup/traveler');
                exit();
            }

            $TravelerID = $signupModel->traveler($firstName, $lastName, $email, $password, $gender, $dob, $contactNo);

            // If image is uploaded, set the image path
            if ($TravelerID && $profileImage['name']) {
                $travelerModel = new TravelerModel($this->conn);
                $travelerModel->setImgPath($TravelerID, $profileImage);
            }

            // Redirect to Keyword entry page
            if ($TravelerID) {
                session_start();
                $_SESSION['TravelerID'] = $TravelerID;
                $_SESSION['Name'] = $firstName;
                $_SESSION['Email'] = $email;
                header('Location: ../keyword/');
                exit();
            } else {
                // If signup fails, redirect back to signup page and show an error message
                $_SESSION['error'] = "Failed to create an account";
                header('Location: ../signup?user=traveler');
                exit();
            }
       }
    }
}
