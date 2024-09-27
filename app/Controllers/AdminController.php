<?php

namespace app\controllers;

class AdminController {
    public function index() {
        // Logic for admin dashboard
        require_once __DIR__ . '/../views/admin_dashboard.php';
    }
}
