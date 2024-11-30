<?php

namespace app\Controllers;

use app\Models\RestaurantModel;

class RestaurantController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the RestaurantModel
        require_once __DIR__ . '/../models/RestaurantModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['RestaurantID'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
            $allowed_pages = ['dashboard', 'profile', 'menu', 'post', 'bookings', 'reviews'];
            $mainContent = in_array($page, $allowed_pages) ? $page : '404';

            if ($mainContent == 'profile') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'edit') {
                    $verifiedAction = 'edit';
                }
            } elseif ($mainContent == 'menu') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                }
            } elseif ($mainContent == 'post') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                $verifiedAction = in_array($action, ['add', 'edit']) ? $action : null;
            }

            require_once __DIR__ . '/../Views/restaurant_dashboard/main.php';
        } else {
            header('Location: ../login');
            exit();
        }
    }

    public function viewMenu()
    {
        $restaurantModel = new RestaurantModel($this->conn);
        $menus = $restaurantModel->getMenu($_SESSION['RestaurantID']);
    }

    public function addMenu()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $restaurantID = $_SESSION['RestaurantID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $menuID = $restaurantModel->addMenu($name, $price, $category, $restaurantID);

            // If image is uploaded, set the image path
            if($menuID && $image['name']) {
                $restaurantModel->setImgPath($menuID, $image);
            }

            header('Location: ../restaurant/dashboard?page=menu');
        }
    }
}
