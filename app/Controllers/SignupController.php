<?php

namespace app\Controllers;

class SignupController
{
    public function index()
    {
        $user = isset($_GET['user']) ? $_GET['user'] : null;
        $allowedUsers = ['traveler', 'hotel', 'restaurant', 'heritagemarket', 'culturaleventorganizer'];
        $user = in_array($user, $allowedUsers) ? $user : null;

        if ($user) {
            require_once __DIR__ . '/../Views/signup/signup_' . $user . '.php';
        } else {
            require_once __DIR__ . '/../Views/signup/signup.php';
        }
    }

    public function traveler()
    {
        
    }
}
