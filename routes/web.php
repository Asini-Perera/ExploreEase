<?php
$router->add('login', 'LoginController@index');  // Login page
$router->add('login/process', 'LoginController@login');  // Login process
$router->add('signup', 'SignupController@index');  // Signup page

$router->add('', 'HomeController@index');  // Home route for users
$router->add('keyword', 'HomeController@keyword');  // Keyword page for users
$router->add('keyword/search', 'HomeController@keywordsearch');  // Keyword search page for travelers

$router->add('admin', 'AdminController@index');  // Admin login page
$router->add('admin/login', 'AdminController@login');  // Admin login process
$router->add('admin/create', 'AdminController@create');  // Admin signup page
$router->add('admin/signup', 'AdminController@signup');  // Admin signup process
$router->add('admin/waiting', 'AdminController@waiting');  // Admin waiting page
$router->add('admin/dashboard', 'AdminController@dashboard');  // Admin dashboard
$router->add('admin/logout', 'AdminController@logout');  // Admin logout

$router->add('forgot', 'ForgotPasswordController@index');  // Forgot password page
$router->add('request', 'ForgotPasswordController@request');  // Forgot password token send
$router->add('reset', 'ForgotPasswordController@reset');  // Reset password page
$router->add('update', 'ForgotPasswordController@update');  // Update new password

$router->add('restaurant/dashboard','RestaurantController@dashboard');  // Restaurant dashboard
$router->add('restaurant/logout','RestaurantController@logout');// Restaurant logout

