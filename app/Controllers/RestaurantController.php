<?php

namespace app\Controllers;

use app\Models\RestaurantModel;
use app\Models\SignupModel;

// Include PHPMailer classes
require_once __DIR__ . '/../../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../libs/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../../libs/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class RestaurantController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the RestaurantModel and SignupModel
        require_once __DIR__ . '/../models/RestaurantModel.php';
        require_once __DIR__ . '/../models/SignupModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['RestaurantID'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
<<<<<<< HEAD
            $allowed_pages = ['dashboard', 'profile', 'menu', 'post', 'bookings', 'booking_list', 'reviews', 'packages'];
=======

            $allowed_pages = ['dashboard', 'profile', 'menu', 'post', 'bookings', 'booking_list', 'reviews', 'images'];

>>>>>>> cc271b72a003c69515347da7af55f09154ca5813
            $mainContent = in_array($page, $allowed_pages) ? $page : '404';

            // Check if this is a package action
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            if ($page == 'packages' && $action == 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->createPackage();
                return; // Stop execution after processing
            }

            // Check if the user is allowed to perform the action
            if ($mainContent == 'dashboard') {
                $restaurantModel = new RestaurantModel($this->conn);
                $TotalBookings = $restaurantModel->getTotalBookings($_SESSION['RestaurantID']);
                $TotalReviews = $restaurantModel->getTotalReviews($_SESSION['RestaurantID']);
<<<<<<< HEAD
                //$TotalPosts = $restaurantModel->getTotalPosts($_SESSION['RestaurantID']);
=======
                // $TotalPosts = $restaurantModel->getTotalPosts($_SESSION['RestaurantID']);
>>>>>>> cc271b72a003c69515347da7af55f09154ca5813
                $TotalMenus = $restaurantModel->getTotalMenus($_SESSION['RestaurantID']);
                $AverageRatings = $restaurantModel->getAverageRating($_SESSION['RestaurantID']);
                // $TotalPackages = $restaurantModel->getTotalPackages($_SESSION['RestaurantID']);
            } elseif ($mainContent == 'profile') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'edit') {
                    $verifiedAction = 'edit';
                } elseif ($action == 'change-password') {
                    $verifiedAction = 'change-password';
                }
            } elseif ($mainContent == 'menu') {
                $menus = $this->viewMenu();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';

                    $menuID = isset($_GET['id']) ? $_GET['id'] : null;

                    $restaurantModel = new RestaurantModel($this->conn);
                    $menuItem = $restaurantModel->getMenuItem($menuID);
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deleteMenu();
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'post') {
                //$action = isset($_GET['action']) ? $_GET['action'] : null;
                //$verifiedAction = in_array($action, ['add', 'edit']) ? $action : null;
                $posts = $this->viewPosts();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';

                    $postID = isset($_GET['id']) ? $_GET['id'] : null;
                    $restaurantModel = new RestaurantModel($this->conn);
                    $postItem = $restaurantModel->getPostItem($postID);
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deletePost();
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'bookings') {
                $restaurantModel = new RestaurantModel($this->conn);
                $bookings = $restaurantModel->bookingWithoutTableNo($_SESSION['RestaurantID']);

                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'sendTN') {
                    $verifiedAction = 'sendTN';
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'booking_list') {
                $bookings = $this->viewBooking();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'reviews') {
                $reviews = $this->viewReview();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'reply'  && $_SERVER['REQUEST_METHOD'] === 'POST') {
                    // $verifiedAction = 'reply';
                    $this->replyReview();

                    $reviewID = isset($_GET['id']) ? $_GET['id'] : null;
                    $restaurantModel = new RestaurantModel($this->conn);
                    $reviewItem = $restaurantModel->getReviewItem($reviewID);
                } else {
                    $verifiedAction = null;
                }
<<<<<<< HEAD
            } elseif ($mainContent == 'packages') {
                $restaurantModel = new RestaurantModel($this->conn);
                
                // Always load the list of packages created by this restaurant
                $packages = $restaurantModel->getPackages($_SESSION['RestaurantID']);
                
                // Fetch all package users
                $packageUsers = $restaurantModel->getAllPackageUsers($_SESSION['RestaurantID']);
                
                // Organize users by package
                $packageUsersByPackage = [];
                foreach ($packageUsers as $user) {
                    if (!isset($packageUsersByPackage[$user['PackageID']])) {
                        $packageUsersByPackage[$user['PackageID']] = [];
                    }
                    $packageUsersByPackage[$user['PackageID']][] = $user;
                }
                
                // Always load service providers for the request buttons
                $hotels = $restaurantModel->getAllServiceProviders('Hotel');
                $restaurants = $restaurantModel->getAllServiceProviders('Restaurant');
                $culturalEvents = $restaurantModel->getAllServiceProviders('CulturalEvent');
                $heritageMarkets = $restaurantModel->getAllServiceProviders('HeritageMarket');
                
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';
                    // Fetch package details when editing
                    if (isset($_GET['id'])) {
                        $packageID = $_GET['id'];
                        $package = $restaurantModel->getPackage($packageID);
                        
                        if ($package) {
                            // Store package details in session for the edit form
                            $_SESSION['PackageID'] = $package['PackageID'];
                            $_SESSION['Name'] = $package['Name'];
                            $_SESSION['Description'] = $package['Description'];
                            $_SESSION['Discount'] = $package['Discount'];
                            $_SESSION['StartDate'] = $package['StartDate'];
                            $_SESSION['EndDate'] = $package['EndDate'];
                            $_SESSION['Owner'] = $package['Owner'];
                            $_SESSION['ImgPath'] = $package['ImgPath'];
                            
                            // Store the appropriate ID based on owner type
                            switch($package['Owner']) {
                                case 'hotel':
                                    $_SESSION['HotelID'] = $package['HotelID'];
                                    break;
                                case 'restaurant':
                                    $_SESSION['RestaurantID'] = $package['RestaurantID'];
                                    break;
                                case 'heritagemarket':
                                    $_SESSION['ShopID'] = $package['ShopID'];
                                    break;
                                case 'culturaleventorganizer':
                                    $_SESSION['EventID'] = $package['EventID'];
                                    break;
                            }
                        }
                    }
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    if (isset($_GET['id'])) {
                        $packageID = $_GET['id'];
                        $success = $restaurantModel->deletePackage($packageID, $_SESSION['RestaurantID']);
                        
                        if ($success) {
                            $_SESSION['success'] = "Package deleted successfully";
                        } else {
                            $_SESSION['error'] = "Failed to delete package";
                        }
                        
                        // Redirect to avoid resubmission
                        header('Location: ../restaurant/dashboard?page=packages');
                        exit();
                    }
                } else {
                    $verifiedAction = null;
                }
=======
            } elseif ($mainContent == 'images') {
                $images = $this->viewImage();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deleteImage();
                } else {
                    $verifiedAction = null;
                }
            } else {
                $verifiedAction = null;
>>>>>>> cc271b72a003c69515347da7af55f09154ca5813
            }

            require_once __DIR__ . '/../Views/restaurant_dashboard/main.php';
        } else {
            header('Location: ../login');
            exit();
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $restaurantID = $_SESSION['RestaurantID'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNo = $_POST['contact_no'];
            $email = $_POST['email'];
            $website = $_POST['website'];
            $weekdaysOpenHours = $_POST['weekdays_openhours'];
            $weekendsOpenHours = $_POST['weekends_openhours'];
            $cuisineType = $_POST['cuisine_types'];
            $description = $_POST['description'];
            $tagline = $_POST['tagline'];
            $facebookLink = $_POST['facebook_link'];
            $instagramLink = $_POST['instagram_link'];
            $tiktokLink = $_POST['tiktok_link'];
            $youtubeLink = $_POST['youtube_link'];

            // Check if the email already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user && $user['Email'] !== $_SESSION['Email']) {
                $_SESSION['error'] = "Email already exists!";
                header('Location: ../restaurant/dashboard?page=profile');
                exit();
            }

            $restaurantModel = new RestaurantModel($this->conn);

            // Initialize menuPDFPath variable
            $menuPDFPath = $_SESSION['MenuPDF'] ?? '';

            // If a new menu PDF was uploaded, process it
            if (isset($_FILES['menupdf']) && $_FILES['menupdf']['error'] == 0) {
                $menuPDFPath = $restaurantModel->setMenuPDFPath($restaurantID, $_FILES['menupdf']);
            }

            $success = $restaurantModel->updateRestaurant(
                $restaurantID,
                $name,
                $address,
                $contactNo,
                $email,
                $website,
                $weekdaysOpenHours,
                $weekendsOpenHours,
                $cuisineType,
                $description,
                $facebookLink,
                $instagramLink,
                $tiktokLink,
                $youtubeLink,
                $tagline,
                $menuPDFPath
            );

            if ($success) {
                $_SESSION['Name'] = $name;
                $_SESSION['Address'] = $address;
                $_SESSION['ContactNo'] = $contactNo;
                $_SESSION['Email'] = $email;
                $_SESSION['Website'] = $website;
                $_SESSION['WeekdayOpenHours'] = $weekdaysOpenHours;
                $_SESSION['WeekendOpenHours'] = $weekendsOpenHours;
                $_SESSION['CuisineType'] = $cuisineType;
                $_SESSION['Description'] = $description;
                $_SESSION['Tagline'] = $tagline;
                $_SESSION['FacebookLink'] = $facebookLink;
                $_SESSION['InstagramLink'] = $instagramLink;
                $_SESSION['TikTokLink'] = $tiktokLink;
                $_SESSION['YouTubeLink'] = $youtubeLink;
                $_SESSION['MenuPDF'] = $menuPDFPath;

                $_SESSION['success'] = "Profile updated successfully!";
            } else {
                $_SESSION['error'] = "Failed to update profile!";
            }

            header('Location: ../restaurant/dashboard?page=profile');
            exit();
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $restaurantID = $_SESSION['RestaurantID'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $restaurantModel = new RestaurantModel($this->conn);
            $valid = $restaurantModel->checkCurrentPassword($restaurantID, $currentPassword);

            if ($valid) {
                if ($newPassword === $confirmPassword) {
                    $restaurantModel->changePassword($restaurantID, $newPassword);
                    header('Location: ../restaurant/dashboard?page=profile');
                    exit();
                } else {
                    header('Location: ../restaurant/dashboard?page=profile&action=change-password');
                    exit();
                }
            } else {
                header('Location: ../restaurant/dashboard?page=profile&action=change-password');
                exit();
            }
        }
    }

    public function addMenu()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $image = $_FILES['menu-image'];
            $popularDish = $_POST['popular-dish'];
            $restaurantID = $_SESSION['RestaurantID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $menuID = $restaurantModel->addMenu($name, $price, $category, $popularDish, $restaurantID);

            // If image is uploaded, set the image path
            if ($menuID && $image['name']) {
                $restaurantModel->setImgPath($menuID, $image);
            }

            header('Location: ../restaurant/dashboard?page=menu');
        }
    }

    public function viewMenu()
    {
        $restaurantModel = new RestaurantModel($this->conn);
        $menus = $restaurantModel->getMenu($_SESSION['RestaurantID']);

        return $menus;
    }


    public function editMenu()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $menuID = $_POST['menuID'];
            $name = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $image = $_FILES['menu-image'];
            $popularDish = $_POST['popular-dish'];
            $restaurantID = $_SESSION['RestaurantID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->updateMenu($name, $price, $category, $popularDish, $menuID);

            //If a new image is uploaded, update the image path
            if ($image['name']) {
                $restaurantModel->setImgPath($menuID, $image);
            }

            header("Location: dashboard?page=menu");
            exit();
        }
    }
    public function deleteMenu()
    {
        if (isset($_GET['id'])) {
            $menuID = $_GET['id'];

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->deleteMenu($menuID);

            header('Location: ../restaurant/dashboard?page=menu');
        }
    }



    //Posts

    public function addPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['post-image'];
            $restaurantID = $_SESSION['RestaurantID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $postID = $restaurantModel->addPost($title, $description,  $restaurantID);


            // If image is uploaded, set the image path
            if ($postID && $image['name']) {
                $restaurantModel->setPostImgPath($postID, $image);
            }

            header('Location: ../restaurant/dashboard?page=post');
        }
    }


    public function viewPosts()
    {
        $restaurantModel = new RestaurantModel($this->conn);
        $posts = $restaurantModel->getPost($_SESSION['RestaurantID']);

        return $posts;
    }

    public function editPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postID = $_POST['postID'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['post-image'];
            $restaurantID = $_SESSION['RestaurantID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->updatePost($title, $description, $postID);

            //If a new image is uploaded, update the image path
            if ($image['name']) {
                $restaurantModel->setPostImgPath($postID, $image);
            }

            header("Location: dashboard?page=post");
            exit();
        }
    }
    public function deletePost()
    {
        if (isset($_GET['id'])) {
            $postID = $_GET['id'];

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->deletePost($postID);
            header('Location: ../restaurant/dashboard?page=post');
        }
    }



    //bookings 

    public function addBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['customer_name'];
            $email = $_POST['email'];
            $date_booking = $_POST['date_booking'];
            $time_booking = $_POST['time_booking'];
            $no_people = $_POST['no_people'];
            $special_request = $_POST['special_Request'];
            $restaurantID = $_SESSION['RestaurantID'];
            $travelerID = $_SESSION['TravelerID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $bookingID = $restaurantModel->saveBooking($name, $email, $date_booking, $time_booking, $no_people, $special_request, $restaurantID,  $travelerID);


            header('Location: ../views/service_traveller_sice_view/restaurant.php?restaurant_id=' . $restaurantID . '&booking_id=' . $bookingID);
        }
    }

    public function viewBooking()
    {
        $restaurantModel = new RestaurantModel($this->conn);
        $bookings = $restaurantModel->getBookings($_SESSION['RestaurantID']);

        return $bookings; // Return the bookings data
    }



    public function viewReview()
    {
        $restaurantID = $_SESSION['RestaurantID'];

        $restaurantModel = new RestaurantModel($this->conn);
        $reviews = $restaurantModel->getReview($restaurantID);

        return $reviews; // Return the reviews data
    }


    public function replyReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewID = $_POST['reviewID'];
            $reply = $_POST['reply'];

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->replyReview($reviewID, $reply);

            header('Location: ../restaurant/dashboard?page=reviews');
        }
    }


    //images
    public function addImage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $image = $_FILES['rest-image'];
            $restaurantID = $_SESSION['RestaurantID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $imageID = $restaurantModel->addImage($title, $restaurantID);


            // If image is uploaded, set the image path
            if ($imageID && $image['name']) {
                $restaurantModel->setRestImgPath($imageID, $image);
            }

            header('Location: ../restaurant/dashboard?page=images');
            exit();
        }
    }

    public function viewImage()
    {
        $restaurantModel = new RestaurantModel($this->conn);
        $images = $restaurantModel->getImage($_SESSION['RestaurantID']);

        return $images;
    }

    public function deleteImage()
    {
        if (isset($_GET['id'])) {
            $imageID = $_GET['id'];

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->deleteImage($imageID);

            header('Location: ../restaurant/dashboard?page=images');
            exit();
        }
    }


    public function sendTableNo()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingID = $_POST['booking_id'];
            $bookingEmail = $_POST['booking_email'];
            $customerName = $_POST['customer_name'];
            $bookingDate = $_POST['booking_date'];
            $bookingTime = $_POST['booking_time'];
            $restaurantName = $_POST['restaurant_name'];
            $tableNo = $_POST['table_no'];

            // Send email to the customer with the table number
            if (isset($bookingEmail)) {
                $mail = new PHPMailer(true);

                //Server settings
                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'exploreease10@gmail.com'; // SMTP username
                $mail->Password = 'tzes gckv czrx kgso';             // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                  // TCP port to connect to

                // Recipients
                $mail->setFrom('exploreease10@gmail.com', 'ExploreEase');
                $mail->addAddress($bookingEmail);

                // Content
                $mail->isHTML(true); // Set email format to HTML
                $mail->Subject = 'Table Number for Your Booking of ' . $restaurantName;
                $mail->Body = '<p>Dear ' . htmlspecialchars($customerName) . ',</p>' .
                    '<p>Thank you for choosing <strong>' . htmlspecialchars($restaurantName) . '</strong> for your dining experience! We are delighted to confirm your booking with the following details:</p>' .
                    '<ul>' .
                    '<li><strong>Restaurant Name:</strong> ' . htmlspecialchars($restaurantName) . '</li>' .
                    '<li><strong>Booking Date:</strong> ' . htmlspecialchars($bookingDate) . '</li>' .
                    '<li><strong>Booking Time:</strong> ' . htmlspecialchars($bookingTime) . '</li>' .
                    '<li><strong>Table Number:</strong> ' . htmlspecialchars($tableNo) . '</li>' .
                    '</ul>' .
                    '<p>We look forward to welcoming you and ensuring you have a wonderful dining experience. If you have any special requests or need further assistance, please don’t hesitate to contact us.</p>' .
                    '<p>Best regards,<br>' .
                    '<strong>The ExploreEase Team</strong></p>';

                $success = $mail->send();
                if ($success) {
                    $restaurantModel = new RestaurantModel($this->conn);
                    $restaurantModel->updateTableNo($bookingID, $tableNo);
                }
            }
        }




        header('Location: ../restaurant/dashboard?page=bookings');
    }

    public function createPackage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['discount']) || 
                empty($_POST['startDate']) || empty($_POST['endDate']) || empty($_POST['partner_ids'])) {
                $_SESSION['error'] = "All required fields must be filled";
                header('Location: ../restaurant/dashboard?page=packages&action=add');
                exit();
            }
            
            // Get form data
            $name = $_POST['name'];
            $description = $_POST['description'];
            $discount = $_POST['discount'];
            $startDate = $_POST['startDate'];
            $endDate = $_POST['endDate'];
            
            // Get the selected partners data
            $selectedTypes = !empty($_POST['selectedTypes']) ? json_decode($_POST['selectedTypes'], true) : [];
            
            // Handle image upload if provided
            $imgPath = null;
            if (isset($_FILES['packageImage']) && $_FILES['packageImage']['name']) {
                $restaurantModel = new RestaurantModel($this->conn);
                $imgPath = $restaurantModel->uploadPackageImage($_FILES['packageImage']);
                
                if (!$imgPath) {
                    $_SESSION['error'] = "Failed to upload image. Please try again.";
                    header('Location: ../restaurant/dashboard?page=packages&action=add');
                    exit();
                }
            }
            
            // Create a single package with the current restaurant as owner
            $restaurantModel = new RestaurantModel($this->conn);
            
            // Initialize all partner IDs
            $hotelID = null;
            $shopID = null;
            $eventID = null;
            $partnerRestaurantID = null;
            
            // Set the appropriate partner IDs from selections
            if (!empty($selectedTypes)) {
                // Set hotel partner if selected
                if (!empty($selectedTypes['hotel'])) {
                    $hotelID = $selectedTypes['hotel'][0]; // Use the first selected hotel
                }
                
                // Set heritage market partner if selected
                if (!empty($selectedTypes['heritagemarket'])) {
                    $shopID = $selectedTypes['heritagemarket'][0]; // Use the first selected market
                }
                
                // Set cultural event partner if selected
                if (!empty($selectedTypes['culturaleventorganizer'])) {
                    $eventID = $selectedTypes['culturaleventorganizer'][0]; // Use the first selected event
                }
                
                // Set partner restaurant if selected
                if (!empty($selectedTypes['restaurant'])) {
                    $partnerRestaurantID = $selectedTypes['restaurant'][0]; // Use the first selected restaurant
                }
            }
            
            // Current restaurant is always the owner
            $restaurantID = $_SESSION['RestaurantID'];
            $owner = 'restaurant';
            
            // Create a single package with all selected partners
            $success = $restaurantModel->createPackage(
                $name, $description, $discount, $startDate, $endDate, 
                $imgPath, $owner, $hotelID, $restaurantID, $shopID, $eventID
            );
            
            if ($success) {
                $_SESSION['success'] = "Package created successfully!";
                header('Location: ../restaurant/dashboard?page=packages');
            } else {
                $_SESSION['error'] = "Failed to create package. Please try again.";
                header('Location: ../restaurant/dashboard?page=packages&action=add');
            }
            exit();
        }
    }
}
