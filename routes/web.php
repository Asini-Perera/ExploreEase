<?php

$router->add('', 'HomeController@index');  // Home route for users
$router->add('admin', 'AdminController@index');  // Admin login page
$router->add('admin/login', 'AdminController@login');  // Admin login
$router->add('admin/dashboard', 'AdminController@dashboard');  // Admin dashboard
$router->add('login', 'LoginController@index');  // Login page
$router->add('signup', 'SignupController@index');  // Signup page
$router->add('signup/traveler', 'SignupController@traveler');  // Signup page for travelers
$router->add('signup/hotel', 'SignupController@hotel');  // Signup page for hotels
$router->add('signup/restaurant', 'SignupController@restaurant');  // Signup page for restaurants
$router->add('signup/heritagemarket', 'SignupController@heritagemarket');  // Signup page for heritage markets
$router->add('signup/culturaleventorganizer', 'SignupController@culturaleventorganizer');  // Signup page for cultural event organizers
$router->add('keyword/traveler', 'KeywordController@traveler');  // Keyword page for travelers
$router->add('keyword/serviceprovider', 'KeywordController@serviceprovider');  // Keyword page for service providers