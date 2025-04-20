<?php

$router->add('login', 'LoginController@index');  // Login page
$router->add('login/process', 'LoginController@login');  // Login process
$router->add('waiting', 'LoginController@waiting');  // Waiting page for users

$router->add('signup', 'SignupController@index');  // Signup page
$router->add('signup/traveler', 'SignupController@traveler');  // Traveler signup process
$router->add('signup/restaurant', 'SignupController@restaurant');  // Restaurant signup process
$router->add('signup/hotel', 'SignupController@hotel');  // Hotel signup process
$router->add('signup/heritagemarket', 'SignupController@heritagemarket');  // Heritage Market signup process
$router->add('signup/culturaleventorganizer', 'SignupController@culturaleventorganizer');  // Cultural Event Organizer signup process

$router->add('', 'HomeController@index');  // Home route for users
$router->add('loged_home', 'HomeController@loged_index');  // Home route for users after login
$router->add('logout', 'HomeController@logout');  // Logout route for users
$router->add('search/keyword', 'HomeController@keywordsearch');  // Keyword search page for travelers
$router->add('search/location', 'HomeController@locationsearch');  // Search by location page for users

$router->add('keyword', 'KeywordController@loadKeywordPage'); // Keyword page for users
$router->add('keyword/save', 'KeywordController@saveKeywords');  // Save keywords for users
$router->add('keyword/add', 'KeywordController@addKeyword');  // Add keyword by admin
$router->add('keyword/delete', 'KeywordController@deleteKeyword');  // Delete keyword by admin
$router->add('keyword/select', 'KeywordController@keywordselect');  // Search by keyword page
$router->add('keyword/verify', 'KeywordController@verifyKeyword');  // Verify & reject keyword by admin

$router->add('admin', 'AdminController@index');  // Admin login page
$router->add('admin/login', 'AdminController@login');  // Admin login process
$router->add('admin/create', 'AdminController@create');  // Admin signup page
$router->add('admin/signup', 'AdminController@signup');  // Admin signup process
$router->add('admin/waiting', 'AdminController@waiting');  // Admin waiting page
$router->add('admin/dashboard', 'AdminController@dashboard');  // Admin dashboard
$router->add('admin/update', 'AdminController@updateProfile');  // Admin update profile process
$router->add('admin/verifyUser', 'AdminController@verifyUser');  // Admin user verify & reject process
$router->add('admin/changepassword', 'AdminController@changePassword');  // Admin change password process
$router->add('admin/logout', 'AdminController@logout');  // Admin logout

$router->add('forgot', 'ForgotPasswordController@index');  // Forgot password page
$router->add('request', 'ForgotPasswordController@request');  // Forgot password token send
$router->add('reset', 'ForgotPasswordController@reset');  // Reset password page
$router->add('update', 'ForgotPasswordController@update');  // Update new password

$router->add('restaurant/dashboard', 'RestaurantController@dashboard');  // Restaurant dashboard
$router->add('restaurant/addMenu', 'RestaurantController@addMenu');  // Add menu for restaurant
$router->add('restaurant/deleteMenu', 'RestaurantController@deleteMenu');  // Delete menu for restaurant
$router->add('restaurant/update', 'RestaurantController@updateProfile');  // Update profile for restaurant
$router->add('restaurant/changepassword', 'RestaurantController@changePassword');  // Change password for restaurant
$router->add('restaurant/post', 'HomeController@post');  // Add post for restaurant

$router->add('hotel/dashboard', 'HotelController@dashboard');  // Hotel dashboard
$router->add('hotel/addRoom', 'HotelController@addRoom');  // Add room for hotel
$router->add('hotel/deleteRoom', 'HotelController@deleteRoom');  // Delete room for hotel
$router->add('hotel/update', 'HotelController@updateProfile');  // Update profile for hotel
$router->add('hotel/changepassword', 'HotelController@changePassword');  // Change password for hotel

$router->add('heritagemarket/dashboard', 'HeritageMarketController@dashboard');  // Heritage Market dashboard
$router->add('heritagemarket/addProduct', 'HeritageMarketController@addProduct');  // Add product for heritage market
$router->add('heritagemarket/shops', 'HeritageMarketController@shops');
$router->add('heritagemarket/products', 'HeritageMarketController@products');
$router->add('heritagemarket/review', 'HeritageMarketController@review');

$router->add('culturaleventorganizer/dashboard', 'CulturalEventOrganizerController@dashboard');  // Cultural Event Organizer dashboard
$router->add('culturaleventorganizer/addEvent', 'CulturalEventOrganizerController@addEvent');  // Add event for cultural event organizer
$router->add('culturaleventorganizer/deleteEvent', 'CulturalEventOrganizerController@deleteEvent');  // Delete event for cultural event organizer
$router->add('culturaleventorganizer/addPost', 'CulturalEventOrganizerController@addPost');  // Add post for cultural event organizer
$router->add('culturaleventorganizer/deletePost', 'CulturalEventOrganizerController@deletePost');  // Delete post for cultural event organizer
$router->add('culturaleventorganizer/update', 'CulturalEventOrganizerController@updateProfile');  // Update profile for cultural event organizer
$router->add('culturaleventorganizer/changepassword', 'CulturalEventOrganizerController@changePassword');  // Change password for cultural event organizer

$router->add('service/hotel', 'HomeController@travelerside_hotel');  // traveller side hotel view
$router->add('service/restaurant', 'HomeController@travelerside_restaurant');  // traveller side restaurant view
$router->add('service/cultural_event', 'HomeController@travelerside_cultural_event');  // traveller side cultural event view
$router->add('service/menu', 'HomeController@travelerside_menu');  // traveller side menu view

$router->add('reviews', 'HomeController@siteReview');  // Add post for restaurant
