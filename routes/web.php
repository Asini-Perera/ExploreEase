<?php

$router->add('', 'HomeController@index');  // Home route for users
$router->add('admin', 'AdminController@index');  // Admin dashboard
$router->add('login', 'LoginController@index');  // Login page