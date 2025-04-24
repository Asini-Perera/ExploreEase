<?php

namespace app\Controllers;

use app\Models\SignupModel;
use app\Models\TravelerModel;
use app\Models\CulturalEventOrganizerModel;

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
        require_once __DIR__ . '/../models/CulturalEventOrganizerModel.php';
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
                header('Location: ../signup?user=traveler');
                exit();
            }

            // Check if password and confirm password match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match";
                header('Location: ../signup?user=traveler');
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

    public function restaurant()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNo = $_POST['contactNo'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];
            $website = $_POST['website'];
            $description = $_POST['description'];
            $weekdaysOpenHours = $_POST['weekdays_openhours'];
            $weekendsOpenHours = $_POST['weekends_openhours'];
            $cuisineType = $_POST['cuisinetype'];
            $tagline = $_POST['tagline'];
            $facebookLink = $_POST['facebook_link'];
            $instagramLink = $_POST['instagram_link'];
            $tiktokLink = $_POST['tiktok_link'];
            $youtubeLink = $_POST['youtube_link'];
            // Check if email already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                $_SESSION['error'] = "Email already exists";
                header('Location: ../signup?user=restaurant');
                exit();
            }

            // Check if password and confirm password match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match";
                header('Location: ../signup?user=restaurant');
                exit();
            }

            $RestaurantID = $signupModel->restaurant($name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $weekdaysOpenHours, $weekendsOpenHours, $cuisineType, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink);

            // Redirect to Keyword entry page
            if ($RestaurantID) {
                session_start();
                $_SESSION['RestaurantID'] = $RestaurantID;
                $_SESSION['Name'] = $name;
                $_SESSION['Email'] = $email;
                header('Location: ../keyword/');
                exit();
            } else {
                // If signup fails, redirect back to signup page and show an error message
                $_SESSION['error'] = "Failed to create an account";
                header('Location: ../signup?user=restaurant');
                exit();
            }
        }
    }

    public function hotel()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNo = $_POST['contactNo'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];
            $website = $_POST['website'];
            $description = $_POST['description'];
            $tagline = $_POST['tagline'];
            $facebookLink = $_POST['facebook_link'];
            $instagramLink = $_POST['instagram_link'];
            $tiktokLink = $_POST['tiktok_link'];
            $youtubeLink = $_POST['youtube_link'];

            // Check if email already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                $_SESSION['error'] = "Email already exists";
                header('Location: ../signup?user=hotel');
                exit();
            }

            // Check if password and confirm password match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match";
                header('Location: ../signup?user=hotel');
                exit();
            }

            $HotelID = $signupModel->hotel($name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink);

            // Redirect to Keyword entry page
            if ($HotelID) {
                session_start();
                $_SESSION['HotelID'] = $HotelID;
                $_SESSION['Name'] = $name;
                $_SESSION['Email'] = $email;
                header('Location: ../keyword/');
                exit();
            } else {
                // If signup fails, redirect back to signup page and show an error message
                $_SESSION['error'] = "Failed to create an account";
                header('Location: ../signup?user=hotel');
                exit();
            }
        }
    }

    public function heritagemarket()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNo = $_POST['contactNo'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];
            $website = $_POST['website'];
            $description = $_POST['description'];
            $weekdaysOpenHours = $_POST['weekdays_openhours'];
            $weekendsOpenHours = $_POST['weekends_openhours'];
            $tagline = $_POST['tagline'];
            $facebookLink = $_POST['facebook_link'];
            $instagramLink = $_POST['instagram_link'];
            $tiktokLink = $_POST['tiktok_link'];
            $youtubeLink = $_POST['youtube_link'];


            // Check if email already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                $_SESSION['error'] = "Email already exists";
                header('Location: ../signup?user=heritagemarket');
                exit();
            }

            // Check if password and confirm password match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match";
                header('Location: ../signup?user=heritagemarket');
                exit();
            }

            $ShopID = $signupModel->heritageMarket($name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $weekdaysOpenHours, $weekendsOpenHours, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink);

            // Redirect to Keyword entry page
            if ($ShopID) {
                session_start();
                $_SESSION['ShopID'] = $ShopID;
                $_SESSION['Name'] = $name;
                $_SESSION['Email'] = $email;
                header('Location: ../keyword/');
                exit();
            } else {
                // If signup fails, redirect back to signup page and show an error message
                $_SESSION['error'] = "Failed to create an account";
                header('Location: ../signup?user=heritagemarket');
                exit();
            }
        }
    }

    public function culturaleventorganizer()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            $contactNo = $_POST['contactNo'];
            $description = $_POST['description'];
            $socialMediaLinks = $_POST['smlink'];
            $profileImage = isset($_FILES['profile_image']) ? $_FILES['profile_image'] : null;

            // Check if email already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                $_SESSION['error'] = "Email already exists";
                header('Location: ../signup?user=culturaleventorganizer');
                exit();
            }

            // Check if password and confirm password match
            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match";
                header('Location: ../signup?user=culturaleventorganizer');
                exit();
            }

            $OrganizerID = $signupModel->culturalEventOrganizer($name, $email, $password, $contactNo, $description, $socialMediaLinks);

            // If image is uploaded, set the image path
            if ($OrganizerID && $profileImage['name']) {
                $culturalEventOrganizerModel = new CulturalEventOrganizerModel($this->conn);
                $culturalEventOrganizerModel->setImgPath($OrganizerID, $profileImage);
            }

            // Redirect to Keyword entry page
            if ($OrganizerID) {
                session_start();
                $_SESSION['OrganizerID'] = $OrganizerID;
                $_SESSION['Name'] = $name;
                $_SESSION['Email'] = $email;
                header('Location: ../keyword/');
                exit();
            } else {
                // If signup fails, redirect back to signup page and show an error message
                $_SESSION['error'] = "Failed to create an account";
                header('Location: ../signup?user=culturaleventorganizer');
                exit();
            }
        }
    }
}
