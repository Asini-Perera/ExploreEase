<?php

$router->add('', 'HomeController@index');  // Home route for users
$router->add('admin', 'AdminController@index');  // Admin login page
$router->add('admin/login', 'AdminController@login');  // Admin login process
$router->add('admin/create', 'AdminController@create');  // Admin signup page
$router->add('admin/signup', 'AdminController@signup');  // Admin signup process
$router->add('admin/waiting', 'AdminController@waiting');  // Admin waiting page
$router->add('admin/dashboard', 'AdminController@dashboard');  // Admin dashboard
$router->add('admin/forgot', 'AdminController@forgot');  // Admin forgot password page
$router->add('admin/logout', 'AdminController@logout');  // Admin logout
$router->add('login', 'LoginController@index');  // Login page
$router->add('signup', 'SignupController@index');  // Signup page
$router->add('signup/traveler', 'SignupController@traveler');  // Signup page for travelers
$router->add('signup/hotel', 'SignupController@hotel');  // Signup page for hotels
$router->add('signup/restaurant', 'SignupController@restaurant');  // Signup page for restaurants
$router->add('signup/heritagemarket', 'SignupController@heritagemarket');  // Signup page for heritage markets
$router->add('signup/culturaleventorganizer', 'SignupController@culturaleventorganizer');  // Signup page for cultural event organizers
$router->add('keyword/traveler', 'KeywordController@traveler');  // Keyword page for travelers
$router->add('keyword/serviceprovider', 'KeywordController@serviceprovider');  // Keyword page for service providers