<?php
// Start session
session_start();

// Load the config file
require_once __DIR__ . '/../config/config.php';

// Load the router and other core files
require_once __DIR__ . '/../core/Router.php';

// Instantiate the router
$router = new Router();

// Load routes from the web.php file
require_once __DIR__ . '/../routes/web.php';

// Route the request
$router->route();
