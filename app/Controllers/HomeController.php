<?php

namespace app\Controllers;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . '/../views/home.php';
    }

    public function keyword()
    {
        require_once __DIR__ . '/../views/keyword.php';
    }

    public function keywordsearch()
    {
        require_once __DIR__ . '/../views/keyword_search.php';
    }
}
