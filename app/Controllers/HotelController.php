<?php

namespace app\Controllers;

use app\Models\HotelModel;
use app\Models\SignupModel;

class HotelController
{
    private $conn;
    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the HoteltModel and SignupModel
        require_once __DIR__ . '/../models/HotelModel.php';
        require_once __DIR__ . '/../models/SignupModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['HotelID'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            
            // Check if this is an updateBooking action (form submission)
            if ($action === 'updateBooking' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                // Call the editBooking method directly
                $this->editBooking();
                return; // Stop execution after processing
            }
            
            $allowed_pages = ['dashboard', 'profile', 'room','post', 'bookings', 'reviews'];
            $mainContent = in_array($page, $allowed_pages) ? $page : '404';
            
            if($mainContent == 'dashboard') {
                $hotelModel = new HotelModel($this->conn);
                $TotalBookings = $hotelModel->getTotalBookings($_SESSION['HotelID']);
                $TotalRooms = $hotelModel->getTotalRooms($_SESSION['HotelID']);
                // $TotalRevenue = $hotelModel->getTotalRevenue($_SESSION['HotelID']);
                // $TotalRevenueInLastWeek = $hotelModel->getTotalRevenueInLastWeek($_SESSION['HotelID']);
                $TotalCustomers = $hotelModel->getTotalCustomers($_SESSION['HotelID']);
                $TotalPosts = $hotelModel->getTotalPosts($_SESSION['HotelID']);
                $TotalRatings = $hotelModel->getTotalRatings($_SESSION['HotelID']);
                $TotalFeedbacks = $hotelModel->getTotalFeedbacks($_SESSION['HotelID']);

            }else if ($mainContent == 'profile') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'edit') {
                    $verifiedAction = 'edit';
                }elseif ($action == 'change-password') {
                    $verifiedAction = 'change-password';
                } 
            } elseif ($mainContent == 'room') {
                $rooms = $this->viewRoom();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';
                                    // Fetch room details when editing
                    if (isset($_GET['id'])) {
                        $roomID = $_GET['id'];
                        $hotelModel = new HotelModel($this->conn);
                        $room = $hotelModel->getRoom($_SESSION['HotelID'], $roomID);
                        
                        if ($room) {
                            // Store room details in session for the edit form
                            $_SESSION['RoomID'] = $room['RoomID'];
                            $_SESSION['RoomType'] = $room['Type'];
                            $_SESSION['Price'] = $room['Price'];
                            $_SESSION['Capacity'] = $room['MaxOccupancy'];
                            $_SESSION['Description'] = $room['Description'];
                            // If you have image path, uncomment this line
                            $_SESSION['ImgPath'] = $room['ImgPath'];
                        }
                    }

                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deleteRoom();
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'post') {
                $posts = $this->viewPosts();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';
                    // Fetch post details when editing
                    if (isset($_GET['id'])) {
                        $postID = $_GET['id'];
                        $hotelModel = new HotelModel($this->conn);
                        $post = $hotelModel->getPost($_SESSION['HotelID'], $postID);
                        
                        if ($post) {
                            // Store post details in session for the edit form
                            $_SESSION['PostID'] = $post['PostID'];
                            $_SESSION['Title'] = $post['Title'];
                            $_SESSION['Description'] = $post['Description'];
                            $_SESSION['ImgPath'] = $post['ImgPath'];
                        }
                    }
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deletePost();
                } else {
                    $verifiedAction = null;
                }

            } elseif ($mainContent == 'bookings') {
                
                // Fetch bookings data for the hotel
                $bookings = $this->viewBookings();
                
                // Check if we have a specific booking action
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'edit') {
                    $verifiedAction = 'edit';
                    // Fetch booking details when editing
                    if (isset($_GET['id'])) {
                        $bookingID = $_GET['id'];
                        $hotelModel = new HotelModel($this->conn);
                        $booking = $hotelModel->getBookingById($bookingID);
                        
                        if ($booking) {
                            // Store booking details in session for the edit form
                            $_SESSION['BookingID'] = $booking['BookingID'];
                            $_SESSION['CheckInDate'] = $booking['CheckInDate'];
                            $_SESSION['CheckOutDate'] = $booking['CheckOutDate'];
                            $_SESSION['Date'] = $booking['Date'];
                            $_SESSION['Status'] = $booking['Status'];
                            $_SESSION['RoomID'] = $booking['RoomID'];
                            $_SESSION['TravelerID'] = $booking['TravelerID'];
                            
                            // Get traveler details
                            $traveler = $hotelModel->getTravelerById($booking['TravelerID']);
                            if ($traveler) {
                                $_SESSION['TravelerName'] = $traveler['FirstName'] . ' ' . $traveler['LastName'];
                            } else {
                                $_SESSION['TravelerName'] = 'Unknown';
                            }
                            
                            // Fetch all rooms for this hotel to populate the dropdown
                            $_SESSION['AvailableRooms'] = $hotelModel->getRoom($_SESSION['HotelID']);
                            
                            // Debug - print booking data to error log
                            error_log("Booking data: " . print_r($booking, true));
                        }
                    }
                    
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deleteBooking();
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'reviews') {
                $hotelModel = new HotelModel($this->conn);
                $reviews = $hotelModel->getReviews($_SESSION['HotelID']);
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'reply') {
                    $verifiedAction = 'reply';
                    // Fetch review details when replying
                    if (isset($_GET['id'])) {
                        $reviewID = $_GET['id'];
                        $hotelModel = new HotelModel($this->conn);
                        $review = $hotelModel->getReviewById($reviewID);
                        
                        if ($review) {
                            // Store review details in session for the reply form
                            $_SESSION['ReviewID'] = $review['FeedbackID'];
                            $_SESSION['Comment'] = $review['Comment'];
                            $_SESSION['Response'] = $review['Response'];
                            $_SESSION['TravellerID'] = $review['TravellerID'];
                        }
                    }
                } else {
                    $verifiedAction = null;
                }
            } else {
                $verifiedAction = null;
            }


                require_once __DIR__ . '/../Views/hotel_dashboard/main.php';
            } else {
                header('Location: ../login');
                exit();
            }
        }

    public function viewRoom()
    {
        $hotelModel = new HotelModel($this->conn);
        $rooms = $hotelModel->getRoom($_SESSION['HotelID']);

        return $rooms;
    }

    public function addRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if all required fields are provided
            if (empty($_POST['room_type']) || empty($_POST['price']) || empty($_POST['capacity']) || empty($_POST['description'])) {
                $_SESSION['error'] = "All fields are required!";
                header('Location: ../hotel/dashboard?page=room&action=add');
                exit();
            }

            // Check if image is uploaded
            if (!isset($_FILES['roomImage']) || empty($_FILES['roomImage']['name'])) {
                $_SESSION['error'] = "Room image is required!";
                header('Location: ../hotel/dashboard?page=room&action=add');
                exit();
            }

            $room_type = $_POST['room_type'];
            $price = $_POST['price'];
            $capacity = $_POST['capacity'];
            $description = $_POST['description'];
            $image = $_FILES['roomImage'];
            $hotelID = $_SESSION['HotelID'];

            $hotelModel = new HotelModel($this->conn);
            $roomID = $hotelModel->addRoom($room_type, $price, $capacity, $description, $hotelID);

            // Set the image path
            if ($roomID) {
                $hotelModel->setImgPath($roomID, $image);
            } else {
                $_SESSION['error'] = "Failed to add room. Please try again.";
                header('Location: ../hotel/dashboard?page=room&action=add');
                exit();
            }

            header('Location: ../hotel/dashboard?page=room');
        }
    }

    public function deleteRoom()
    {
        if (isset($_GET['id'])) {
            $roomID = $_GET['id'];

            $hotelModel = new HotelModel($this->conn);
            $hotelModel->deleteRoom($roomID);

            header('Location: ../hotel/dashboard?page=room');
        }
    }

    public function updateRoom()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelID = $_SESSION['HotelID'];
            $roomID = $_POST['roomID'];
            $room_type = $_POST['room_type'];
            $price = $_POST['price'];
            $capacity = $_POST['capacity'];
            $description = $_POST['description'];
            $image = $_FILES['roomImage'];

            $hotelModel = new HotelModel($this->conn);

            // Update room details in the database
            $hotelModel->updateRoom($roomID, $room_type, $price, $capacity, $description);

            // If a new image is uploaded, update the image path
            if ($image['name']) {
                $hotelModel->setImgPath($roomID, $image);
            }
            
            // Clear session variables
            unset($_SESSION['RoomID']);
            unset($_SESSION['RoomType']);
            unset($_SESSION['Price']);
            unset($_SESSION['Capacity']);
            unset($_SESSION['Description']);
            unset($_SESSION['ImgPath']);
            
            header('Location: ../hotel/dashboard?page=room');
            exit();
        }
    }

    public function viewBookings()
    {
        $hotelModel = new HotelModel($this->conn);
        $bookings = $hotelModel->getBookings($_SESSION['HotelID']);
        
        return $bookings; // Return the bookings data
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelID = $_SESSION['HotelID'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNo = $_POST['contact_no'];
            $description = $_POST['description'];
            $website = $_POST['website'];
            $sm_link = $_POST['sm_link'];
            
            // Check if the email exists and belongs to another user
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);
            
            // Only check for email uniqueness if the email has changed
            if ($user && $user['HotelID'] != $hotelID && $email != $_SESSION['Email']) {
                $_SESSION['error'] = "Email already exists!";
                header('Location: ../hotel/dashboard?page=profile&action=edit');
                exit();
            }

            $hotelModel = new HotelModel($this->conn);
            $success = $hotelModel->updateHotel($hotelID, $email, $name, $address, $contactNo, $description, $website, $sm_link);
            
            if ($success) {
                // Update session variables
                $_SESSION['Email'] = $email; 
                $_SESSION['Name'] = $name; 
                $_SESSION['Address'] = $address;
                $_SESSION['ContactNo'] = $contactNo;
                $_SESSION['Description'] = $description;
                $_SESSION['Website'] = $website;
                $_SESSION['SMLink'] = $sm_link;
                
                $_SESSION['success'] = "Profile updated successfully!";
            } else {
                $_SESSION['error'] = "Failed to update profile!";
            }

            header('Location: ../hotel/dashboard?page=profile');
            exit();
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $hotelID = $_SESSION['HotelID'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $hotelModel = new HotelModel($this->conn);
            $valid = $hotelModel->checkCurrentPassword($hotelID, $currentPassword);

            if ($valid) {
                if ($newPassword === $confirmPassword) {
                    $hotelModel->changePassword($hotelID, $newPassword);
                    header('Location: ../hotel/dashboard?page=profile');
                    exit();
                } else {
                    header('Location: ../hotel/dashboard?page=profile&action=change-password');
                    exit();
                }
            } else {
                header('Location: ../hotel/dashboard?page=profile&action=change-password');
                exit();
            }
        }
    }

    public function viewPosts()
    {
        $hotelModel = new HotelModel($this->conn);
        $posts = $hotelModel->getPost($_SESSION['HotelID']);

        return $posts;
    }

    public function addPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Check if all required fields are provided
            if (empty($_POST['title']) || empty($_POST['description'])) {
                $_SESSION['error'] = "All fields are required!";
                header('Location: ../hotel/dashboard?page=post&action=add');
                exit();
            }

            // Check if image is uploaded
            if (!isset($_FILES['postImage']) || empty($_FILES['postImage']['name'])) {
                $_SESSION['error'] = "Post image is required!";
                header('Location: ../hotel/dashboard?page=post&action=add');
                exit();
            }

            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['postImage'];
            $hotelID = $_SESSION['HotelID'];

            $hotelModel = new HotelModel($this->conn);
            $postID = $hotelModel->addPost($title, $description, $hotelID);

            // Set the image path
            if ($postID) {
                $hotelModel->setImagePath($postID, $image);
            } else {
                $_SESSION['error'] = "Failed to add post. Please try again.";
                header('Location: ../hotel/dashboard?page=post&action=add');
                exit();
            }

            header('Location: ../hotel/dashboard?page=post');
        }
    }

    public function deletePost()
    {
        if (isset($_GET['id'])) {
            $postID = $_GET['id'];

            $hotelModel = new HotelModel($this->conn);
            $hotelModel->deletePost($postID);

            header('Location: ../hotel/dashboard?page=post');
        }
    }

    public function updatePost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $postID = $_POST['postID'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['postImage'];

            $hotelModel = new HotelModel($this->conn);

            // Update post details in the database
            $hotelModel->updatePost($postID, $title, $description);

            // If a new image is uploaded, update the image path
            if ($image['name']) {
                $hotelModel->setImagePath($postID, $image);
            }

            // Clear session variables
            unset($_SESSION['PostID']);
            unset($_SESSION['Title']);
            unset($_SESSION['Description']);
            unset($_SESSION['ImgPath']);

            header('Location: ../hotel/dashboard?page=post');
            exit();
        }
    }

    public function editBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $bookingID = $_POST['bookingID'];
            $checkInDate = $_POST['checkInDate'];
            $checkOutDate = $_POST['checkOutDate'];
            $date = $_POST['date'];
            $status = $_POST['paymentStatus'];
            $roomID = $_POST['roomID'];

            $hotelModel = new HotelModel($this->conn);
            $hotelModel->updateBooking($bookingID, $checkInDate, $checkOutDate, $date, $status, $roomID);
            
            // Clear session variables
            unset($_SESSION['BookingID']);
            unset($_SESSION['CheckInDate']);
            unset($_SESSION['CheckOutDate']);
            unset($_SESSION['Date']);
            unset($_SESSION['Status']);
            unset($_SESSION['RoomID']);

            header('Location: ../hotel/dashboard?page=bookings');
            exit();
        }
    }

    public function deleteBooking()
    {
        if (isset($_GET['id'])) {
            $bookingID = $_GET['id'];

            $hotelModel = new HotelModel($this->conn);
            $hotelModel->deleteBooking($bookingID);

            header('Location: ../hotel/dashboard?page=bookings');
        }
    }

    public function replyReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST['reviewID']) || empty($_POST['response'])) {
                $_SESSION['error'] = "Review ID and response are required";
                header('Location: ../hotel/dashboard?page=reviews');
                exit();
            }

            $reviewID = $_POST['reviewID'];
            $response = $_POST['response'];

            $hotelModel = new HotelModel($this->conn);
            $success = $hotelModel->updateReviewResponse($reviewID, $response);

            if ($success) {
                $_SESSION['success'] = "Response submitted successfully";
            } else {
                $_SESSION['error'] = "Failed to submit response";
            }

            // Clear session variables
            unset($_SESSION['ReviewID']);
            unset($_SESSION['Comment']);
            unset($_SESSION['Response']);
            unset($_SESSION['TravellerID']);

            header('Location: ../hotel/dashboard?page=reviews');
            exit();
        }
    }
}