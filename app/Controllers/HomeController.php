<?php

namespace app\Controllers;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/home.php';
    }

    public function keyword()
    {
        require_once __DIR__ . '/../Views/keyword.php';
    }

    public function keywordsearch()
    {
        require_once __DIR__ . '/../Views/keyword_search.php';
    }
}
