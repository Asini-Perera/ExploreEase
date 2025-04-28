<?php

use app\Controllers\RestaurantController;

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
$router->add('service/hotel', 'HomeController@travelerside_hotel');  // traveller side hotel view
$router->add('service/restaurant', 'HomeController@travelerside_restaurant');  // traveller side restaurant view
$router->add('service/cultural_event', 'HomeController@travelerside_cultural_event');  // traveller side cultural event view
$router->add('service/menu', 'HomeController@travelerside_menu');  // traveller side menu view
$router->add('reviews', 'HomeController@siteReview');  // Site reviews page
$router->add('review/save', 'HomeController@saveReview');  // Save review process
$router->add('filter/keyword', 'HomeController@filterKeyword');  // Filter by keyword process
$router->add('link/service', 'HomeController@linkService');  // Link service page for displaying
$router->add('review', 'HomeController@addReview');  // Add review page for users
$router->add('review/save', 'HomeController@saveServiceReview');  // Save review process
$router->add('reviews', 'HomeController@siteReview');
$router->add('TravellerDashboard', 'HomeController@TravellerDashboard');
$router->add('loggedNavbar', 'HomeController@loggednavbar');
$router->add('travllerBooking', 'HomeController@travllerBooking');
$router->add('travellerReview', 'HomeController@travellerReview');
$router->add('Contactus', 'HomeController@Contactus');
$router->add('TravellerPackageList', 'HomeController@TravellerPackageList'); // Traveller package list

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
$router->add('restaurant/addPost', 'RestaurantController@addPost');  // Add post for restaurant
$router->add('restaurant/deletePost', 'RestaurantController@deletePost');  // Delete post for restaurant
$router->add('restaurant/editPost', 'RestaurantController@editPost');  // Edit post for restaurant
$router->add('restaurant/editMenu', 'RestaurantController@editMenu');  // Edit menu for restaurant
$router->add('restaurant/bookings', 'RestaurantController@bookings');  // Restaurant bookings
$router->add('restaurant/booking_list', 'RestaurantController@booking_list');  // Restaurant booking list
$router->add('restaurant/booking_list/delete', 'RestaurantController@deleteBooking');  // Delete booking for restaurant
$router->add('restaurant/booking_list/edit', 'RestaurantController@editBooking');  // Edit booking for restaurant
$router->add('restaurant/booking_list/sendTable', 'RestaurantController@sendTable');  // Send table number for booking
$router->add('restaurant/booking_list/sendTableEmail', 'RestaurantController@sendTableEmail');  // Send table number email for booking
$router->add('restaurant/review', 'RestaurantController@review');  // Restaurant review
$router->add('restaurant/review/reply', 'RestaurantController@deleteReview');   // Restaurant review reply
$router->add('restaurant/reviewForm', 'RestaurantController@reviewForm');  // Restaurant review form
$router->add('restaurant/addReview', 'RestaurantController@addReview');  // Restaurant review  add
$router->add('restaurant/images', 'RestaurantController@images');  // Restaurant images
$router->add('restaurant/addImage', 'RestaurantController@addImage'); //add image
$router->add('restaurant/deleteImage', 'RestaurantController@deleteImage'); // delete image
$router->add('restaurant/sendTableNo', 'RestaurantController@sendTableNo');  // Send table number for restaurant booking


$router->add('hotel/dashboard', 'HotelController@dashboard');  // Hotel dashboard
$router->add('hotel/addRoom', 'HotelController@addRoom');  // Add room for hotel
$router->add('hotel/deleteRoom', 'HotelController@deleteRoom');  // Delete room for hotel
$router->add('hotel/update', 'HotelController@updateProfile');  // Update profile for hotel
$router->add('hotel/changepassword', 'HotelController@changePassword');  // Change password for hotel
$router->add('hotel/updateRoom', 'HotelController@updateRoom');  // Update room details for hotel
$router->add('hotel/addPost', 'HotelController@addPost');  // Add post for hotel
$router->add('hotel/deletePost', 'HotelController@deletePost');  // Delete post for hotel
$router->add('hotel/updatePost', 'HotelController@updatePost');  // Update post for hotel
$router->add('hotel/reviews', 'HotelController@reviews');  // View reviews for hotel
$router->add('hotel/replyReview', 'HotelController@replyReview');  // Process review replies
$router->add('hotel/packages', 'HotelController@packages');  // View packages for hotel
$router->add('hotel/addPackage', 'HotelController@addPackage');  // Add package for hotel
$router->add('hotel/checkAvailableRooms', 'HotelController@checkAvailableRooms');  // Check available rooms for hotel
$router->add('hotel/bookRoom', 'HotelController@bookRoom');  // Book room for hotel


$router->add('heritagemarket/dashboard', 'HeritageMarketController@dashboard');  // Heritage Market dashboard
$router->add('heritagemarket/addProduct', 'HeritageMarketController@addProduct');  // Add product for heritage market
$router->add('heritagemarket/editProduct', 'HeritageMarketController@editProduct');  // Edit product for heritage market
$router->add('heritagemarket/deleteProduct', 'HeritageMarketController@deleteProduct');  // Delete product for heritage market
$router->add('heritagemarket/updateProfile', 'HeritageMarketController@updateProfile');  // Update profile for heritage market
$router->add('heritagemarket/changepassword', 'HeritageMarketController@changePassword');  // Change password for heritage market
$router->add('heritagemarket/reviewResponse', 'HeritageMarketController@reviewResponse');  // Heritage Market review response
$router->add('heritagemarket/shops', 'HeritageMarketController@shops');
$router->add('heritagemarket/products', 'HeritageMarketController@products');
$router->add('heritagemarket/review', 'HeritageMarketController@review');
$router->add('heritagemarket/submitReview', 'HeritageMarketController@submitReview');  // Process review submissions


$router->add('culturaleventorganizer/dashboard', 'CulturalEventOrganizerController@dashboard');  // Cultural Event Organizer dashboard
$router->add('culturaleventorganizer/addEvent', 'CulturalEventOrganizerController@addEvent');  // Add event for cultural event organizer
$router->add('culturaleventorganizer/editEvent', 'CulturalEventOrganizerController@editEvent');  // Edit event for cultural event organizer
$router->add('culturaleventorganizer/updateEvent', 'CulturalEventOrganizerController@updateEvent');  // Process event update for cultural event organizer
$router->add('culturaleventorganizer/deleteEvent', 'CulturalEventOrganizerController@deleteEvent');  // Delete event for cultural event organizer
$router->add('culturaleventorganizer/addPost', 'CulturalEventOrganizerController@addPost');  // Add post for cultural event organizer
$router->add('culturaleventorganizer/updatePost', 'CulturalEventOrganizerController@updatePost');  // Update post for cultural event organizer
$router->add('culturaleventorganizer/deletePost', 'CulturalEventOrganizerController@deletePost');  // Delete post for cultural event organizer
$router->add('culturaleventorganizer/bookings', 'CulturalEventOrganizerController@bookings');  // View bookings for cultural event organizer
$router->add('culturaleventorganizer/updateBooking', 'CulturalEventOrganizerController@updateBooking');  // Update booking for cultural event organizer
$router->add('culturaleventorganizer/reviewResponse', 'CulturalEventOrganizerController@reviewResponse');  // Process review responses
$router->add('culturaleventorganizer/update', 'CulturalEventOrganizerController@updateProfile');  // Update profile for cultural event organizer
$router->add('culturaleventorganizer/changepassword', 'CulturalEventOrganizerController@changePassword');  // Change password for cultural event organizer

$router->add('traveler/editProfile', 'TravelerController@editProfile');  // Edit profile for traveler
