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
            $hotelModel = new HotelModel($this->conn);
            $TotalBookings = $hotelModel->getTotalBookings($_SESSION['HotelID']);
            $TotalRooms = $hotelModel->getTotalRooms($_SESSION['HotelID']);
            $TotalRevenue = $hotelModel->getTotalRevenue($_SESSION['HotelID']);
            $TotalRevenueInLastWeek = $hotelModel->getTotalRevenueInLastWeek($_SESSION['HotelID']);
            $TotalRatings = $hotelModel->getTotalRatings($_SESSION['HotelID']);
            $TotalFeedbacks = $hotelModel->getTotalFeedbacks($_SESSION['HotelID']);

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
                                // Fetch room details when editing
                if (isset($_GET['id'])) {
                    $roomID = $_GET['id'];
                    $hotelModel = new HotelModel($this->conn);
                    $room = $hotelModel->getRoom($_SESSION['HotelID'], $roomID);
                    
                    if ($room) {
                        // Store room details in session for the edit form
                        $_SESSION['RoomID'] = $room['RoomID'];
                        $_SESSION['RoomType'] = $room['Type'];
                        $_SESSION['Price'] = $room['Price'];
                        $_SESSION['Capacity'] = $room['MaxOccupancy'];
                        $_SESSION['Description'] = $room['Description'];
                        // If you have image path, uncomment this line
                        $_SESSION['ImgPath'] = $room['ImgPath'];
                    }
                }

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
            // Check if all required fields are provided
            if (empty($_POST['room_type']) || empty($_POST['price']) || empty($_POST['capacity']) || empty($_POST['description'])) {
                $_SESSION['error'] = "All fields are required!";
                header('Location: ../hotel/dashboard?page=room&action=add');
                exit();
            }

            // Check if image is uploaded
            if (!isset($_FILES['roomImage']) || empty($_FILES['roomImage']['name'])) {
                $_SESSION['error'] = "Room image is required!";
                header('Location: ../hotel/dashboard?page=room&action=add');
                exit();
            }

            $room_type = $_POST['room_type'];
            $price = $_POST['price'];
            $capacity = $_POST['capacity'];
            $description = $_POST['description'];
            $image = $_FILES['roomImage'];
            $hotelID = $_SESSION['HotelID'];

            $hotelModel = new HotelModel($this->conn);
            $roomID = $hotelModel->addRoom($room_type, $price, $capacity, $description, $hotelID);

            // Set the image path
            if ($roomID) {
                $hotelModel->setImgPath($roomID, $image);
            } else {
                $_SESSION['error'] = "Failed to add room. Please try again.";
                header('Location: ../hotel/dashboard?page=room&action=add');
                exit();
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

    public function updateRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelID = $_SESSION['HotelID'];
            $roomID = $_POST['roomID'];
            $room_type = $_POST['room_type'];
            $price = $_POST['price'];
            $capacity = $_POST['capacity'];
            $description = $_POST['description'];
            $image = $_FILES['roomImage'];

            $hotelModel = new HotelModel($this->conn);

            // Update room details in the database
            $hotelModel->updateRoom($roomID, $room_type, $price, $capacity, $description);

            // If a new image is uploaded, update the image path
            if ($image['name']) {
                $hotelModel->setImgPath($roomID, $image);
            }
            
            // Clear session variables
            unset($_SESSION['RoomID']);
            unset($_SESSION['RoomType']);
            unset($_SESSION['Price']);
            unset($_SESSION['Capacity']);
            unset($_SESSION['Description']);
            unset($_SESSION['ImgPath']);
            
            header('Location: ../hotel/dashboard?page=room');
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