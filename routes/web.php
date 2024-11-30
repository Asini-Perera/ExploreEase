<?php

$router->add('login', 'LoginController@index');  // Login page
$router->add('login/process', 'LoginController@login');  // Login process

$router->add('signup', 'SignupController@index');  // Signup page
$router->add('signup/traveler', 'SignupController@traveler');  // Traveler signup process
$router->add('signup/restaurant', 'SignupController@restaurant');  // Restaurant signup process

$router->add('home', 'HomeController@index');  // Home route for users
$router->add('loged_home', 'HomeController@loged_index');  // Home route for users after login

$router->add('keyword', 'KeywordController@loadKeywordPage'); // Keyword page for users
$router->add('keyword/save', 'KeywordController@saveKeywords');  // Save keywords for users
$router->add('keyword/search', 'KeywordController@keywordsearch');  // Keyword search page for travelers

$router->add('location/location_search', 'HomeController@location_search');  // SearchbyLocation page for users

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

$router->add('hotel/dashboard','HotelController@dashboard');  // Hotel dashboard

$router->add('heritagemarket/dashboard','HeritageMarketController@dashboard');  // Heritage Market dashboard

$router->add('culturaleventorganizer/dashboard','CulturalEventOrganizerController@dashboard');  // Cultural Event Organizer dashboard

$router->add('service/hotel', 'HomeController@travelerside_hotel');  // traveller side hotel view
$router->add('service/restaurant', 'HomeController@travelerside_restaurant');  // traveller side restaurant view
$router->add('service/cultural_event', 'HomeController@travelerside_cultural_event');  // traveller side cultural event view
$router->add('service/menu', 'HomeController@travelerside_menu');  // traveller side menu view