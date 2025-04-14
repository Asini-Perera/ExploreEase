<?php

namespace app\Controllers;

use app\Models\HotelModel;
use app\Models\SignupModel;

class HotelController
{
    private $conn;
    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the HoteltModel and SignupModel
        require_once __DIR__ . '/../models/HotelModel.php';
        require_once __DIR__ . '/../models/SignupModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['HotelID'])) {
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
        $allowed_pages = ['dashboard', 'profile', 'room','post', 'bookings', 'reviews'];
        $mainContent = in_array($page, $allowed_pages) ? $page : '404';
        
        if($mainContent == 'dashboard') {
            $hotalModel = new HotelModel($this->conn);
            $TotalBookings = $hotalModel->getTotalBookings($_SESSION['HotelID']);
            $TotalRooms = $hotalModel->getTotalRooms($_SESSION['HotelID']);
            $TotalRevenue = $hotalModel->getTotalRevenue($_SESSION['HotelID']);
            $TotalRevenueInLastWeek = $hotalModel->getTotalRevenueInLastWeek($_SESSION['HotelID']);
            $TotalRatings = $hotalModel->getTotalRatings($_SESSION['HotelID']);
            $TotalFeedbacks = $hotalModel->getTotalFeedbacks($_SESSION['HotelID']);

        }else if ($mainContent == 'profile') {
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            if ($action == 'edit') {
                $verifiedAction = 'edit';
            }elseif ($action == 'change-password') {
                $verifiedAction = 'change-password';
            } 
        } elseif ($mainContent == 'room') {
            $rooms = $this->viewRoom();
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            if($action == 'add') {
                $verifiedAction = 'add';
            } elseif ($action == 'edit') {
                $verifiedAction = 'edit';
            } elseif ($action == 'delete') {
                $verifiedAction = null;
                $this->deleteRoom();
            } else {
                $verifiedAction = null;
            }
        } elseif ($mainContent == 'post') {
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            $verifiedAction = in_array($action, ['add', 'edit']) ? $action : null;
        }

            require_once __DIR__ . '/../Views/hotel_dashboard/main.php';
        } else {
            header('Location: ../login');
            exit();
        }
    }

    public function viewRoom()
    {
        $hotelModel = new HotelModel($this->conn);
        $rooms = $hotelModel->getRoom($_SESSION['HotelID']);

        return $rooms;
    }

    public function addRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $room_type = $_POST['room_type'];
            $price = $_POST['price'];
            $capacity = $_POST['capacity'];
            $description = $_POST['description'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $hotelID = $_SESSION['HotelID'];

            $hotelModel = new HotelModel($this->conn);
            $roomID = $hotelModel->addRoom($room_type, $price, $capacity,$description, $hotelID);

            // If image is uploaded, set the image path
            if($roomID && $image['name']) {
                $hotelModel->setImgPath($roomID, $image);
            }

            header('Location: ../hotel/dashboard?page=room');
        }
    }

    public function deleteRoom()
    {
        if (isset($_GET['id'])) {
            $roomID = $_GET['id'];

            $hotelModel = new HotelModel($this->conn);
            $hotelModel->deleteRoom($roomID);

            header('Location: ../hotel/dashboard?page=room');
        }
    }

    public function viewBookings()
    {
        $hotelModel = new HotelModel($this->conn);
        $bookings = $hotelModel->getBookings($_SESSION['HotelID']);
    }

    // public function viewReviews()
    // {
    //     $hotelModel = new HotelModel($this->conn);
    //     $reviews = $hotelModel->getReviews($_SESSION['HotelID']);
    // }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelID = $_SESSION['HotelID'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNo = $_POST['contact_no'];
            $description = $_POST['description'];
            $website = $_POST['website'];
            $sm_link = $_POST['sm_link'];
            
            // Check if the email is already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                header('Location: ../hotel/dashboard?page=profile');
                exit();
            }

            $hotelModel = new HotelModel($this->conn);
            $hotelModel->updateHotel($hotelID, $email, $name,  $address, $contactNo, $description,  $website, $sm_link );

            $_SESSION['Email'] = $email; 
            $_SESSION['Name'] = $name; 
            $_SESSION['Address'] = $address;
            $_SESSION['ContactNo'] = $contactNo;
            $_SESSION['Description'] = $description;
            $_SESSION['Website'] = $website;
            $_SESSION['SMLink'] = $sm_link;

            header('Location: ../hotel/dashboard?page=profile');
            exit();
        }
    }


    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelID = $_SESSION['HotelID'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $hotelModel = new HotelModel($this->conn);
            $valid = $hotelModel->checkCurrentPassword($hotelID, $currentPassword);

            if ($valid) {
                if ($newPassword === $confirmPassword) {
                    $hotelModel->changePassword($hotelID, $newPassword);
                    header('Location: ../hotel/dashboard?page=profile');
                    exit();
                } else {
                    header('Location: ../hotel/dashboard?page=profile&action=change-password');
                    exit();
                }
            } else {
                header('Location: ../hotel/dashboard?page=profile&action=change-password');
                exit();
            }
        }
    }

}