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
        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
        $allowed_pages = ['dashboard', 'profile', 'add_post', 'post_list', 'bookings', 'reviews'];
        $mainContent = in_array($page, $allowed_pages) ? $page : '404';

        require_once __DIR__ . '/../Views/hotel_dashboard/main.php';
    }

}