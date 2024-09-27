<?php

namespace app\controllers;

class SignupController {
    public function index() {
        require_once __DIR__ . '/../views/signup.php';
    }

    public function traveler() {
        require_once __DIR__ . '/../views/signup_traveler.php';
    }

    public function hotel() {
        require_once __DIR__ . '/../views/signup_hotel.php';
    }

    public function restaurant() {
        require_once __DIR__ . '/../views/signup_restaurant.php';
    }

    public function heritagemarket() {
        require_once __DIR__ . '/../views/signup_heritagemarket.php';
    }

    public function culturaleventorganizer() {
        require_once __DIR__ . '/../views/signup_culturaleventorganizer.php';
    }
}