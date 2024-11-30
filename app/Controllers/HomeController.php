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
}
