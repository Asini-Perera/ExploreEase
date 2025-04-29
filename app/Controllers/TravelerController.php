<?php

namespace app\Controllers;

use app\Models\TravelerModel;
use app\Models\SignupModel;

class TravelerController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the TravelerModel and SignupModel
        require_once __DIR__ . '/../Models/TravelerModel.php';
        require_once __DIR__ . '/../Models/SignupModel.php';
    }

    public function editProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $travelerID = $_SESSION['TravelerID'];
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $gender = isset($_POST['gender']) ? $_POST['gender'] : null;
            $dob = isset($_POST['dob']) ? $_POST['dob'] : null;
            $contactNumber = isset($_POST['contact_number']) ? $_POST['contact_number'] : null;
            $profileImage = isset($_FILES['profile_image']) ? $_FILES['profile_image'] : null;

            // Check if email already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user && $user['TravelerID'] != $travelerID) {
                $_SESSION['error'] = "Email already exists. Please use a different email.";
                header("Location: ../TravellerDashboard");
                exit();
            }

            // Update the profile
            $travelerModel = new TravelerModel($this->conn);
            $travelerModel->updateProfile($travelerID, $firstName, $lastName, $email, $gender, $dob, $contactNumber);
            $travelerModel->setImgPath($travelerID, $profileImage);

            // Update the session variables
            $_SESSION['FirstName'] = $firstName;
            $_SESSION['LastName'] = $lastName;
            $_SESSION['Email'] = $email;
            $_SESSION['Gender'] = $gender;
            $_SESSION['DOB'] = $dob;
            $_SESSION['ContactNo'] = $contactNumber;

            $_SESSION['success'] = "Profile updated successfully.";
            header("Location: ../TravellerDashboard");
            exit();
        }
    }

    public function registerPackage()
    {
        $packageID = $_GET['id'];
        $travelerID = $_SESSION['TravelerID'];

        $travelerModel = new TravelerModel($this->conn);
        $success = $travelerModel->registerPackage($travelerID, $packageID);

        if ($success) {
            $_SESSION['success'] = "Registered to the package successfully.";
        } else {
            $_SESSION['error'] = "Failed to register to the package. Please try again.";
        }
        header("Location: ../TravellerDashboard");
        exit();
    }
}
