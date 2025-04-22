<?php

namespace app\Controllers;

use app\Models\RestaurantModel;
use app\Models\SignupModel;

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
            $allowed_pages = ['dashboard', 'profile', 'menu', 'post', 'bookings','booking_list', 'reviews'];
            $mainContent = in_array($page, $allowed_pages) ? $page : '404';

            // Check if the user is allowed to perform the action
            if($mainContent == 'dashboard'){
                // $restaurantModel = new RestaurantModel($this->conn);
                // $TotalBookings = $restaurantModel->getTotalBookings($_SESSION['RestaurantID']);
                // $TotalReviews = $restaurantModel->getTotalReviews($_SESSION['RestaurantID']);
                // $TotalPosts = $restaurantModel->getTotalPosts($_SESSION['RestaurantID']);
                // $TotalMenus = $restaurantModel->getTotalMenus($_SESSION['RestaurantID']);
                // $TotalRatings = $restaurantModel->getTotalRatings($_SESSION['RestaurantID']);
            }
            elseif($mainContent == 'profile') {
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
                // $verifiedAction = in_array($action, ['add', 'edit']) ? $action : null;
            } elseif ($mainContent == 'post') {
                //$action = isset($_GET['action']) ? $_GET['action'] : null;
                //$verifiedAction = in_array($action, ['add', 'edit']) ? $action : null;
                $posts = $this -> viewPosts();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if($action == 'add'){
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deletePost();
                } else {
                    $verifiedAction = null;
                }
            // }elseif($mainContent == 'post'){
            //     $reviews = $this -> viewBookings();
            //     $action = isset($_GET['action']) ? $_GET['action'] : null;
            //     if($action == 'add'){
            //         $verifiedAction = 'add';
            //     } elseif ($action == 'sendTN') {
            //         $verifiedAction = 'sendTN';
            //     } elseif ($action == 'delete') {
            //         $verifiedAction = null;
            //         $this->deleteBooking();
            //     } else {
            //         $verifiedAction = null;
            //     }
            }elseif($mainContent == 'reviews'){
                $reviews = $this -> viewReview();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if($action == 'add'){
                    $verifiedAction = 'add';
                } elseif ($action == 'reply') {
                    $verifiedAction = 'reply';
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deleteReview();
                } else {
                    $verifiedAction = null;
                }
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
            $openHours = $_POST['open_hours'];
            $cuisineType = $_POST['cuisine_types'];
            $description = $_POST['description'];
            $socialMediaLinks = $_POST['smlink'];
            $menupdf = $_FILES['menupdf'];

            // Check if the email is already exists
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user) {
                header('Location: ../restaurant/dashboard?page=profile');
                exit();
            }

            $restaurantModel = new RestaurantModel($this->conn);
            $sucess = $restaurantModel->updateRestaurant($restaurantID, $name, $address, $contactNo, $email, $website, $openHours, $cuisineType, $description, $socialMediaLinks, $menupdf);

           if($sucess) {
            $_SESSION['Name'] = $name;  
            $_SESSION['Address'] = $address;
            $_SESSION['ContactNo'] = $contactNo;
            $_SESSION['Email'] = $email;
            $_SESSION['Website'] = $website;
            $_SESSION['OpenHours'] = $openHours;
            $_SESSION['CuisineType'] = $cuisineType;
            $_SESSION['Description'] = $description;
            $_SESSION['SMLink'] = $socialMediaLinks;
            $_SESSION['MenuPDF'] = $menupdf;

            $_SESSION['success'] = "Profile updated successfully!";
           }else{
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
            if($menuID && $image['name']) {
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

    
    public function editMenu(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $menuID = $_POST['menuID'];
            $name = $_POST['title'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $image = $_FILES['menu-image'];
            $popularDish = $_POST['popular-dish'];
            $restaurantID = $_SESSION['RestaurantID'];
        
            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->updateMenu( $name, $price, $category,    $popularDish,$menuID);
        
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

            // Check if all required fields are provided
            // if (empty($_POST['title']) || empty($_POST['description'])) {
            //     $_SESSION['error'] = "All fields are required!";
            //     header('Location: ../restaurant/dashboard?page=post&action=add');
            //     exit();
            // }

            // Check if image is uploaded
            // if (!isset($_FILES['postImage']) || empty($_FILES['postImage']['name'])) {
            //     $_SESSION['error'] = "Post image is required!";
            //     header('Location: ../restaurant/dashboard?page=post&action=add');
            //     exit();
            // }

            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['post-image']; 
            $restaurantID = $_SESSION['RestaurantID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $postID = $restaurantModel->addPost($title,$description,  $restaurantID);

            
            // If image is uploaded, set the image path
            // if($postID && $image['name']) {
            //     $restaurantModel->setPostImgPath($postID, $image);
            // }

            header('Location: ../restaurant/dashboard?page=post');
        }
    }


    public function viewPosts()
    {
        $restaurantModel = new RestaurantModel($this->conn);
        $posts = $restaurantModel->getPost($_SESSION['RestaurantID']);

        return $posts;
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

    // public function addBooking()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $name = $_POST['name'];
    //         $email = $_POST['email'];
    //         $date_booking = $_POST['date_booking']; 
    //         $no_people = $_POST['no_people'];
    //         $special_request = $_POST['special_Request']; 
    //         $restaurantID = $_SESSION['UserID'];

    //         $restaurantModel = new RestaurantModel($this->conn);
    //         $bookingID = $restaurantModel->addBooking($title,$description,  $restaurantID);


    //         header('Location: ../restaurant/dashboard?page=bookings');
    //     } 
    // }

    //reviews
    public function reviewForm(): void
    {
       require_once __DIR__ . '/../Views/restaurant_dashboard/add_review.php';
    }


    public function addReview(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $rating = $_POST['rating'];
            $comment = $_POST['review'];
            $restaurantID = $_SESSION['RestaurantID'];
            $travelerID = $_SESSION['TravelerID'];

            $restaurantModel = new RestaurantModel($this->conn);
            $feedbackID = $restaurantModel->addReview($name, $email, $rating,$comment, $restaurantID, $travelerID);

            header('Location: ../restaurant/dashboard?page=reviews');
        }
    }

    public function viewReview()
    {
        $restaurantID = $_SESSION['RestaurantID']; 
    
        $restaurantModel = new RestaurantModel($this->conn);
        $reviews = $restaurantModel->getReview($restaurantID);
    
        return $reviews; // Return the reviews data
    }
    

    public function deleteReview()
    {
        if (isset($_GET['id'])) {
            $reviewID = $_GET['id'];

            $restaurantModel = new RestaurantModel($this->conn);
            $restaurantModel->deleteReview($reviewID);

            header('Location: ../restaurant/dashboard?page=reviews');
        }
    }
    
    // public function replyReview()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $reviewID = $_POST['review_id'];
    //         $reply = $_POST['reply'];

    //         $restaurantModel = new RestaurantModel($this->conn);
    //         $restaurantModel->replyReview($reviewID, $reply);

    //         header('Location: ../restaurant/dashboard?page=reviews');
    //     }
    // }

    // public function viewBooking()
    // {
    //     $hotelModel = new RestaurantModel ($this->conn);
    //     $bookings = $hotelModel->getBookings($_SESSION['RestaurantID']);
        
    //     return $bookings; // Return the bookings data
    // }

    // public function updatePost()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $postID = $_POST['postID'];
    //         $title = $_POST['title'];
    //         $description = $_POST['description'];
    //         $image = $_FILES['postImage'];

    //         $hotelModel = new HotelModel($this->conn);

    //         // Update post details in the database
    //         $hotelModel->updatePost($postID, $title, $description);

    //         // If a new image is uploaded, update the image path
    //         if ($image['name']) {
    //             $hotelModel->setImagePath($postID, $image);
    //         }

    //         // Clear session variables
    //         unset($_SESSION['PostID']);
    //         unset($_SESSION['Title']);
    //         unset($_SESSION['Description']);
    //         unset($_SESSION['ImgPath']);

    //         header('Location: ../hotel/dashboard?page=post');
    //         exit();
    //     }
    // }

    // public function editBooking()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $bookingID = $_POST['bookingID'];
    //         $checkInDate = $_POST['checkInDate'];
    //         $checkOutDate = $_POST['checkOutDate'];
    //         $date = $_POST['date'];
    //         $status = $_POST['paymentStatus'];

    //         $hotelModel = new RestaurantModel($this->conn);
    //         $hotelModel->updateBooking($bookingID, $checkInDate, $checkOutDate, $date, $status);
            
    //         // Clear session variables
    //         unset($_SESSION['BookingID']);
    //         unset($_SESSION['CheckInDate']);
    //         unset($_SESSION['CheckOutDate']);
    //         unset($_SESSION['Date']);
    //         unset($_SESSION['Status']);

    //         header('Location: ../hotel/dashboard?page=bookings');
    //         exit();
    //     }
    // }

    // public function deleteBooking()
    // {
    //     if (isset($_GET['id'])) {
    //         $bookingID = $_GET['id'];

    //         $restaurantModel = new RestaurantModel($this->conn);
    //         $restaurantModel->deleteBooking($bookingID);

    //         header('Location: ../restaurant/dashboard?page=booking_list');
    //     }
    // }

}