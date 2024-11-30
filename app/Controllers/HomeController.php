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

    public function location_search()
    {
        require_once __DIR__ . '/../Views/search_by_location.php';
    }
}
