<?php

namespace app\Controllers;

use app\Models\CulturalEventOrganizerModel;

class CulturalEventOrganizerController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the CulturalEventOrganizerModel
        require_once __DIR__ . '/../models/CulturalEventOrganizerModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['EventID'])) {
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
        $allowed_pages = ['dashboard', 'profile', 'event', 'post', 'bookings', 'reviews'];
        $mainContent = in_array($page, $allowed_pages) ? $page : '404';

        if ($mainContent == 'profile') {
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            if ($action == 'edit') {
                $verifiedAction = 'edit';
            }
        } elseif ($mainContent == 'event') {
            $events = $this->viewEvent();
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            if($action == 'add') {
                $verifiedAction = 'add';
            } elseif ($action == 'edit') {
                $verifiedAction = 'edit';
            } elseif ($action == 'delete') {
                $verifiedAction = null;
                $this->deleteEvent();
            } else {
                $verifiedAction = null;
            }
        } elseif ($mainContent == 'post') {
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            $verifiedAction = in_array($action, ['add', 'edit']) ? $action : null;
        }


        require_once __DIR__ . '/../Views/culturaleventorganizer_dashboard/main.php';
    }else {
        header('Location: ../login');
        exit();
    }
    
    }

    public function viewEvent()
    {
        $eventModel = new CulturalEventOrganizerModel($this->conn);
        $events = $eventModel->getEvent($_SESSION['EventID']);

        return $events;
    }

    public function addEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $address = $_POST['address'];
            $date = $_POST['date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $description = $_POST['description'];
            $capacity = $_POST['capacity'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $eventID = $_SESSION['EventID'];

            $eventModel = new CulturalEventOrganizerModel($this->conn);
            $eventID = $eventModel->addEvent($title, $address, $date,$start_time,$end_time,$description, $capacity,$price,$status,$eventID);

            // If image is uploaded, set the image path
            if($eventID && $image['name']) {
                $eventModel->setImgPath($eventID, $image);
            }

            header('Location: ../culturalevent/dashboard?page=event');
        }
    }

    public function deleteEvent()
    {
        if (isset($_GET['id'])) {
            $roomID = $_GET['id'];

            $eventModel = new CulturalEventOrganizerModel($this->conn);
            $eventModel->deleteEvent($roomID);

            header('Location: ../culturalevent/dashboard?page=event');
        }
    }
}