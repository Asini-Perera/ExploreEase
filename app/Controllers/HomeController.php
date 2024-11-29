<?php

namespace app\Controllers;

class HomeController
{
    public function index()
    {
        require_once __DIR__ . '/../Views/home.php';
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
