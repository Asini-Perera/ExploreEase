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
$router->add('keyword/keywordsearch', 'KeywordController@keywordsearch');  // Keyword search page for travelers
$router->add('keyword/keywordselect', 'KeywordController@keywordselect');  // Keyword search page for travelers