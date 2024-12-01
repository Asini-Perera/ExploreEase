<?php

namespace app\Controllers;

use app\Models\HotelModel;

class HotelController
{
    private $conn;
    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the HoteltModel
        require_once __DIR__ . '/../models/HotelModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['HotelID'])) {
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
        $allowed_pages = ['dashboard', 'profile', 'room','post', 'bookings', 'reviews'];
        $mainContent = in_array($page, $allowed_pages) ? $page : '404';

        if ($mainContent == 'profile') {
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            if ($action == 'edit') {
                $verifiedAction = 'edit';
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
            $room_type = $_POST['title'];
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

            header('Location: ../restaurant/dashboard?page=room');
        }
    }

    public function viewPost()
    {
        $hotelModel = new HotelModel($this->conn);
        $menus = $hotelModel->getPost($_SESSION['HotelID']);
    }

    public function addPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $room_type = $_POST['title'];
            $price = $_POST['price'];
            $capacity = $_POST['capacity'];
            $description = $_POST['description'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $hotelID = $_SESSION['HotelID'];

            $hotelModel = new HotelModel($this->conn);
            $postID = $hotelModel->addRoom($room_type, $price, $capacity,$description, $hotelID);

            // If image is uploaded, set the image path
            if($postID && $image['name']) {
                $hotelModel->setImgPath($postID, $image);
            }

            header('Location: ../hotel/dashboard?page=post');
        }
    }

    public function viewBookings()
    {
        $hotelModel = new HotelModel($this->conn);
        $bookings = $hotelModel->getBookings($_SESSION['HotelID']);
    }

    public function viewReviews()
    {
        $hotelModel = new HotelModel($this->conn);
        $reviews = $hotelModel->getReviews($_SESSION['HotelID']);
    }


}