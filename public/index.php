<?php

// Start session
session_start();

// Store user session data
$_SESSION['user_id'] = 1;

// Load the config file
require_once __DIR__ . '/../config/config.php';

// Load the router and other core files
require_once __DIR__ . '/../core/Router.php';

// Initialize the router and route the request
$router = new Router();
$router->route();
