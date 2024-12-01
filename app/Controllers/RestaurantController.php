<?php

namespace app\Controllers;

use app\Models\RestaurantModel;
use app\Models\SignupModel;

class RestaurantController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the RestaurantModel and SignupModel
        require_once __DIR__ . '/../models/RestaurantModel.php';
        require_once __DIR__ . '/../models/SignupModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['RestaurantID'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
            $allowed_pages = ['dashboard', 'profile', 'menu', 'post', 'bookings','booking_list', 'reviews'];
            $mainContent = in_array($page, $allowed_pages) ? $page : '404';

            // Check if the user is allowed to perform the action
            if ($mainContent == 'profile') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'edit') {
                    $verifiedAction = 'edit';
                }
            } elseif ($mainContent == 'menu') {
                $menus = $this->viewMenu();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deleteMenu();
                } else {
                    $verifiedAction = null;
                }
                // $verifiedAction = in_array($action, ['add', 'edit']) ? $action : null;
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

        return $menus;
    }

    public function addMenu()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $image = $_FILES['menu-image'];
            $popularDish = $_POST['popular-dish'];
            $restaurantID = $_SESSION['RestaurantID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $menuID = $restaurantModel->addMenu($name, $price, $category, $popularDish, $restaurantID);

            // If image is uploaded, set the image path
            if($menuID && $image['name']) {
                $restaurantModel->setImgPath($menuID, $image);
            }

            header('Location: ../restaurant/dashboard?page=menu');
        }
    }

    public function deleteMenu()
    {
        if (isset($_GET['id'])) {
            $menuID = $_GET['id'];

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->deleteMenu($menuID);

            header('Location: ../restaurant/dashboard?page=menu');
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $restaurantID = $_SESSION['RestaurantID'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNo = $_POST['contact_no'];
            $email = $_POST['email'];
            $website = $_POST['website'];
            $openHours = $_POST['open_hours'];
            $cuisineType = $_POST['cuisine_types'];
            $description = $_POST['description'];

            // Check if the email is already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                header('Location: ../restaurant/dashboard?page=profile');
                exit();
            }

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->updateRestaurant($restaurantID, $name, $address, $contactNo, $email, $website, $openHours, $cuisineType, $description);

            $_SESSION['Name'] = $name;  
            $_SESSION['Address'] = $address;
            $_SESSION['ContactNo'] = $contactNo;
            $_SESSION['Email'] = $email;
            $_SESSION['Website'] = $website;
            $_SESSION['OpenHours'] = $openHours;
            $_SESSION['CuisineType'] = $cuisineType;
            $_SESSION['Description'] = $description;

            header('Location: ../restaurant/dashboard?page=profile');
            exit();
        }
    }


}
