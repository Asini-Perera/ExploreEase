<?php

$router->add('', 'HomeController@index');  // Home route for users
$router->add('admin', 'AdminController@index');  // Admin login page
$router->add('admin/login', 'AdminController@login');  // Admin login process
$router->add('admin/create', 'AdminController@create');  // Admin signup page
$router->add('admin/signup', 'AdminController@signup');  // Admin signup process
$router->add('admin/waiting', 'AdminController@waiting');  // Admin waiting page
$router->add('admin/dashboard', 'AdminController@dashboard');  // Admin dashboard
$router->add('forgot', 'ForgotPasswordController@index');  // Forgot password page
$router->add('request', 'ForgotPasswordController@request');  // Forgot password token send
$router->add('reset', 'ForgotPasswordController@reset');  // Reset password page
$router->add('update', 'ForgotPasswordController@update');  // Update new password
$router->add('admin/logout', 'AdminController@logout');  // Admin logout
$router->add('login', 'LoginController@index');  // Login page
$router->add('signup', 'SignupController@index');  // Signup page
$router->add('keyword/traveler', 'KeywordController@traveler');  // Keyword page for travelers
$router->add('keyword/serviceprovider', 'KeywordController@serviceprovider');  // Keyword page for service providers
$router->add('keyword/keywordsearch', 'KeywordController@keywordsearch');  // Keyword search page for travelers
$router->add('restaurant/dashboard','RestaurantController@dashboard');  // Restaurant dashboard
$router->add('restaurant/logout','RestaurantController@logout');// Restaurant logout

