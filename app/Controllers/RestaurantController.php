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

    public function dashboard(){
        // if(isset($_SESSION['RestaurantID'])){
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
            $allowed_pages = ['dashboard', 'profile', 'add_post', 'post_list', 'bookings', 'reviews'];
            $mainContent = in_array($page, $allowed_pages) ? $page : '404';

            require_once __DIR__ . '/../Views/restaurant_dashboard/main.php';
        // }
        //  else{
        //     header('Location: /login');
        //     exit(); 
        // }
    }

    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../');
        exit();
    }
}

