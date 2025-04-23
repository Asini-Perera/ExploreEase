<?php

namespace app\Controllers;

use app\Models\HomeModel;

use app\Controllers\KeywordController;

class HomeController
{
    private $conn;
    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the HomeModel
        require_once __DIR__ . '/../models/HomeModel.php';

        // Include the KeywordController
        require_once __DIR__ . '/../controllers/KeywordController.php';
    }

    public function index()
    {
        $homeModel = new HomeModel($this->conn);
        $reviews = $homeModel->getReviews();
        require_once __DIR__ . '/../Views/home.php';
    }

    public function loged_index()
    {
        $homeModel = new HomeModel($this->conn);
        $reviews = $homeModel->getReviews();
        require_once __DIR__ . '/../Views/loged_home.php';
    }

    public function keywordsearch()
    {
        require_once __DIR__ . '/../Views/keyword_search.php';
    }

    public function locationsearch()
    {
        require_once __DIR__ . '/../Views/search_by_location.php';
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../ExploreEase');
        exit();
    }

    public function travelerside_hotel()
    {
        require_once __DIR__ . '/../Views/service_traveller_side_view/hotel.php';
    }

    public function travelerside_restaurant()
    {
        require_once __DIR__ . '/../Views/service_traveller_side_view/restaurant.php';
    }


    public function travelerside_cultural_event()
    {
        require_once __DIR__ . '/../Views/service_traveller_side_view/cultural_event.php';
    }

    public function travelerside_menu()
    {
        require_once __DIR__ . '/../Views/restaurant/menu_pdf.php';
    }

    public function post()
    {
        require_once __DIR__ . '/../Views/restaurant_dashboard/edit_post.php';
    }
    public function siteReview()
    {
        require_once __DIR__ . '/../Views/siteReview.php';
    }

    public function saveReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $rating = $_POST['rating'];
            $comment = $_POST['comments'];

            $homeModel = new HomeModel($this->conn);
            $homeModel->saveReview($name, $email, $rating, $comment);

            header('Location: ../loged_home');
            exit();
        }
    }
}
