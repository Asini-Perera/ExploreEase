<?php

namespace app\Controllers;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/home.php';
    }

    public function loged_index()
    {
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

     
}
