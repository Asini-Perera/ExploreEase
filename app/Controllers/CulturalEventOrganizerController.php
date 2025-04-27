<?php

namespace app\Controllers;

use app\Models\CulturalEventOrganizerModel;
use app\Models\SignupModel;

class CulturalEventOrganizerController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the CulturalEventOrganizerModel and SignupModel
        require_once __DIR__ . '/../models/CulturalEventOrganizerModel.php';
        require_once __DIR__ . '/../models/SignupModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['OrganizerID'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
            $action = isset($_GET['action']) ? $_GET['action'] : null;

            $allowedPages = ['dashboard', 'profile', 'event', 'post', 'bookings', 'reviews'];
            $mainContent = in_array($page, $allowedPages) ? $page : '404'; // Default to 404 if page is not allowed

            if ($mainContent == 'dashboard') {
                $eventModel = new CulturalEventOrganizerModel($this->conn);
                $TotalBookings = $eventModel->getTotalBookings($_SESSION['OrganizerID']);
                $TotalEvents = $eventModel->getTotalEvents($_SESSION['OrganizerID']);
                $TotalPosts = $eventModel->getTotalPosts($_SESSION['OrganizerID']);
                $TotalRatings = $eventModel->getTotalRatings($_SESSION['OrganizerID']);
                $TotalRevenue = $eventModel->getTotalRevenue($_SESSION['OrganizerID']);
                $TotalFeedbacks = $eventModel->getTotalFeedbacks($_SESSION['OrganizerID']);
            } else if ($mainContent == 'profile') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'edit') {
                    $verifiedAction = 'edit';
                } elseif ($action == 'change-password') {
                    $verifiedAction = 'change-password';
                }
            } elseif ($mainContent == 'event') {
                // $events = $this->viewEvent();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deleteEvent();
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'post') {
                $posts = $this->viewPost();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';

                    $postID = isset($_GET['id']) ? $_GET['id'] : null;
                    $organizerModel = new CulturalEventOrganizerModel($this->conn);
                    $postItem = $organizerModel->getPostItem($postID);
                } elseif ($action == 'delete') {
                    $verifiedAction = null;
                    $this->deletePost();
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'bookings') {
                $bookings = $this->viewBookings();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'edit') {
                    $verifiedAction = 'edit';

                    // Fetch booking details when editing
                    if (isset($_GET['id'])) {
                        $bookingID = $_GET['id'];
                        $eventModel = new CulturalEventOrganizerModel($this->conn);
                        $booking = $eventModel->getBookingById($bookingID);

                        if ($booking) {
                            // Store booking details in session for the edit form
                            $_SESSION['BookingID'] = $booking['BookingID'];
                            $_SESSION['Date'] = $booking['Date'];
                            $_SESSION['Quantity'] = $booking['Quantity'] ?? $booking['TicketCount'] ?? 1;
                            $_SESSION['Status'] = $booking['Status'] ?? 'Pending';
                            $_SESSION['EventID'] = $booking['EventID'];
                            $_SESSION['TravelerID'] = $booking['TravelerID'];
                            $_SESSION['Amount'] = $booking['Amount'] ?? 0;

                            // Get traveler details
                            $traveler = $eventModel->getTravelerById($booking['TravelerID']);
                            if ($traveler) {
                                $_SESSION['TravelerName'] = $traveler['FirstName'] . ' ' . $traveler['LastName'];
                            } else {
                                $_SESSION['TravelerName'] = 'Unknown';
                            }

                            // Fetch all events for this organizer to populate the dropdown
                            $_SESSION['AvailableEvents'] = $eventModel->getAllEvents($_SESSION['OrganizerID']);
                        }
                    }
                } else {
                    $verifiedAction = null;
                }
            } elseif ($mainContent == 'reviews') {
                $eventModel = new CulturalEventOrganizerModel($this->conn);
                $reviews = $eventModel->getReviews($_SESSION['OrganizerID']);
                if (isset($_GET['action']) && $_GET['action'] == 'reply') {
                    $verifiedAction = 'reply';
                } else {
                    $verifiedAction = null;
                }
            } else {
                $verifiedAction = null;
            }


            require_once __DIR__ . '/../Views/culturaleventorganizer_dashboard/main.php';
        } else {
            header('Location: ../login');
            exit();
        }
    }




    public function addEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Log the beginning of the event addition process
                error_log("Starting event addition process");

                // Check if form data is available
                error_log("POST data: " . print_r($_POST, true));
                error_log("FILES data: " . print_r($_FILES, true));

                $title = $_POST['title'] ?? '';
                $address = $_POST['address'] ?? '';
                $date = $_POST['date'] ?? '';
                $start_time = $_POST['start_time'] ?? '';
                $end_time = $_POST['end_time'] ?? '';
                $description = $_POST['description'] ?? '';
                $capacity = $_POST['capacity'] ?? 0;
                $price = $_POST['price'] ?? 0;
                $status = $_POST['status'] ?? '';
                $image = isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK ? $_FILES['image'] : null;
                $organizerID = $_SESSION['OrganizerID'] ?? 0;

                // Basic validation
                if (empty($title) || empty($address) || empty($date) || empty($organizerID)) {
                    error_log("Event addition failed: Missing required fields");
                    header('Location: dashboard?page=event&error=missing_fields');
                    exit();
                }

                // Log the data being used
                error_log("Event data: Title=$title, Address=$address, Date=$date, OrganizerID=$organizerID");

                $eventModel = new CulturalEventOrganizerModel($this->conn);
                $eventID = $eventModel->addEvent($title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID);

                if (!$eventID) {
                    error_log("Failed to add event to database");
                    header('Location: dashboard?page=event&error=db_error');
                    exit();
                }

                error_log("Event added successfully with ID: $eventID");

                // If image is uploaded, set the image path
                if ($eventID && $image) {
                    $result = $eventModel->setEventImage($eventID, $image);
                    if ($result) {
                        error_log("Image added successfully for event ID: $eventID");
                    } else {
                        error_log("Failed to add image for event ID: $eventID");
                    }
                }

                // Redirect with success parameter
                header('Location: dashboard?page=event&success=added');
                exit();
            } catch (\Exception $e) {
                error_log("Exception in addEvent: " . $e->getMessage() . "\n" . $e->getTraceAsString());
                header('Location: dashboard?page=event&error=exception');
                exit();
            }
        }
    }

    public function updateEvent()
    {
        // Check if user is logged in
        if (!isset($_SESSION['OrganizerID'])) {
            header('Location: ../login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Log the form data for debugging
            error_log("Update Event POST data: " . print_r($_POST, true));

            // Get form data
            $eventID = $_POST['event_id'];
            $title = $_POST['title'];
            $address = $_POST['address'];
            $date = $_POST['date'];

            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $price = isset($_POST['price']) ? (float)$_POST['price'] : 0; // Changed from ticketPrice to price
            $start_time = isset($_POST['start_time']) ? $_POST['start_time'] : null;
            $end_time = isset($_POST['end_time']) ? $_POST['end_time'] : null;
            $capacity = isset($_POST['capacity']) ? (int)$_POST['capacity'] : 0;
            $status = isset($_POST['status']) ? $_POST['status'] : 'Active';
            $organizerID = $_SESSION['OrganizerID'];

            // Handle image upload if provided
            $image = isset($_FILES['image']) && $_FILES['image']['name'] ? $_FILES['image'] : null;


            // Validate event belongs to this organizer
            $eventModel = new CulturalEventOrganizerModel($this->conn);
            // $eventData = $eventModel->getEvent($eventID);

            if (empty($eventData) || $eventData[0]['OrganizerID'] != $organizerID) {
                $_SESSION['error'] = "You don't have permission to edit this event";
                header('Location: ../culturaleventorganizer/dashboard?page=event');
                exit();
            }

            // Update event in database with all required parameters
            $success = $eventModel->updateEvent($eventID, $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status);

            if ($success && $image && $image['name']) {
                $imageUploadSuccess = $eventModel->setEventImage($eventID, $image);
                if (!$imageUploadSuccess) {
                    $_SESSION['error'] = "Event updated, but failed to upload image.";
                }
            }


            // Set success message and redirect
            if ($success) {
                $_SESSION['success'] = "Event updated successfully";
            } else {
                $_SESSION['error'] = "Failed to update event";
            }

            header('Location: ../culturaleventorganizer/dashboard?page=event');
            exit();
        } else {
            // If not POST request, redirect to dashboard
            header('Location: ../culturaleventorganizer/dashboard?page=event');
            exit();
        }
    }



    public function viewEvent()
    {
        $organizerModel = new CulturalEventOrganizerModel($this->conn);
        // $events = $organizerModel->getEvent($_SESSION['OrganizerID']);

        // return $events;
    }


    public function deleteEvent()
    {
        if (isset($_GET['id'])) {
            $eventID = $_GET['id'];

            $organizerModel = new CulturalEventOrganizerModel($this->conn);
            $organizerModel->deleteEvent($eventID);

            header('Location: ../culturaleventorganizer/dashboard?page=event');
        }
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $organizerID = $_SESSION['OrganizerID'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contactNo = $_POST['contact_no'];
            $description = $_POST['description'];


            // Get individual social media links
            $facebookLink = $_POST['facebook_link'] ?? '';
            $instagramLink = $_POST['instagram_link'] ?? '';
            $tiktokLink = $_POST['tiktok_link'] ?? '';
            $youtubeLink = $_POST['youtube_link'] ?? '';


            $profileImage = isset($_FILES['profile_image']) ? $_FILES['profile_image'] : null;

            // Only check for email existence if the user is changing their email
            $currentEmail = $_SESSION['Email'];
            if ($email !== $currentEmail) {
                $signupModel = new SignupModel($this->conn);
                $user = $signupModel->getUserByEmail($email);

                // Email exists and belongs to someone else
                if ($user) {
                    header('Location: ../culturaleventorganizer/dashboard?page=profile&action=edit&error=email-exists');
                    exit();
                }
            }

            $organizerModel = new CulturalEventOrganizerModel($this->conn);

            $organizerModel->updateOrganizer(
                $organizerID,
                $name,
                $email,
                $contactNo,
                $description,
                $facebookLink,
                $instagramLink,
                $tiktokLink,
                $youtubeLink
            );

            if ($profileImage && !empty($profileImage['name'])) {

                $organizerModel->setImgPath($organizerID, $profileImage);
            }

            // Update session variables
            $_SESSION['Name'] = $name;
            $_SESSION['Email'] = $email;
            $_SESSION['ContactNo'] = $contactNo;
            $_SESSION['Description'] = $description;
            $_SESSION['FacebookLink'] = $facebookLink;
            $_SESSION['InstagramLink'] = $instagramLink;
            $_SESSION['TikTokLink'] = $tiktokLink;
            $_SESSION['YouTubeLink'] = $youtubeLink;
            $_SESSION['ProfileImage'] = $organizerModel->getImgPath($organizerID);

            header('Location: ../culturaleventorganizer/dashboard?page=profile');
            exit();
        }
    }

    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $organizerID = $_SESSION['OrganizerID'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $organizerModel = new CulturalEventOrganizerModel($this->conn);
            $valid = $organizerModel->checkCurrentPassword($organizerID, $currentPassword);

            if ($valid) {
                if ($newPassword === $confirmPassword) {
                    $organizerModel->changePassword($organizerID, $newPassword);
                    header('Location: ../culturaleventorganizer/dashboard?page=profile');
                    exit();
                } else {
                    header('Location: ../culturaleventorganizer/dashboard?page=profile&action=change-password');
                    exit();
                }
            } else {
                header('Location: ../culturaleventorganizer/dashboard?page=profile&action=change-password');
                exit();
            }
        }
    }

    public function addPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Debug information - log what we're receiving
            error_log("POST data: " . print_r($_POST, true));
            error_log("FILES data: " . print_r($_FILES, true));

            // Check if all required fields are provided
            if (empty($_POST['title']) || empty($_POST['description'])) {
                $_SESSION['error'] = "Title and description are required!";
                header('Location: ../culturaleventorganizer/dashboard?page=post&action=add');
                exit();
            }

            // Check if image is uploaded
            if (!isset($_FILES['postImage']) || empty($_FILES['postImage']['name'])) {
                $_SESSION['error'] = "Post image is required!";
                header('Location: ../culturaleventorganizer/dashboard?page=post&action=add');
                exit();
            }

            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = $_FILES['postImage'];
            $organizerID = $_SESSION['OrganizerID'];

            $organizerModel = new CulturalEventOrganizerModel($this->conn);
            $postID = $organizerModel->addPost($title, $description, $organizerID);

            // Set the image path
            if ($postID) {
                // Log what we're trying to do
                error_log("Attempting to set post image for post ID: $postID");
                $result = $organizerModel->setPostImagePath($postID, $image);

                if (!$result) {
                    error_log("Failed to set image path for post ID: $postID");
                    $_SESSION['error'] = "Post was added but image upload failed. Please try editing the post to add an image.";
                    header('Location: ../culturaleventorganizer/dashboard?page=post');
                    exit();
                }
            } else {
                $_SESSION['error'] = "Failed to add post. Please try again.";
                header('Location: ../culturaleventorganizer/dashboard?page=post&action=add');
                exit();
            }

            $_SESSION['success'] = "Post added successfully!";
            header('Location: ../culturaleventorganizer/dashboard?page=post');
            exit();
        }
    }

    public function viewPost()
    {
        $postModel = new CulturalEventOrganizerModel($this->conn);
        $posts = $postModel->getPost($_SESSION['OrganizerID']);

        return $posts;
    }

    public function updatePost()
    {
        // Check if user is logged in
        if (!isset($_SESSION['OrganizerID'])) {
            header('Location: ../login');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Log the form data for debugging
            error_log("Update Post POST data: " . print_r($_POST, true));

            // Get form data
            $postID = $_POST['post_id'];
            $title = $_POST['title'];
            $description = isset($_POST['description']) ? $_POST['description'] : '';
            $organizerID = $_SESSION['OrganizerID'];

            // Handle image upload if provided
            $image = isset($_FILES['postImage']) && $_FILES['postImage']['name'] ? $_FILES['postImage'] : null;

            // Validate post belongs to this organizer
            $postModel = new CulturalEventOrganizerModel($this->conn);
            $postData = $postModel->getPost($organizerID, $postID);

            if (empty($postData)) {
                $_SESSION['error'] = "You don't have permission to edit this post.";
                header('Location: dashboard?page=post');
                exit();
            }

            // Update post in database
            $success = $postModel->updatePost($postID, $title, $description);

            if ($success && $image) {
                $imageUploadSuccess = $postModel->setPostImagePath($postID, $image);
                if (!$imageUploadSuccess) {
                    $_SESSION['error'] = "Post updated, but failed to upload image.";
                }
            }

            if ($success) {
                $_SESSION['success'] = "Post updated successfully.";
            } else {
                $_SESSION['error'] = "Failed to update post.";
            }

            header('Location: dashboard?page=post');
            exit();
        } else {
            // Handle GET request to load the edit form
            $postID = $_GET['id'] ?? 0;
            $organizerID = $_SESSION['OrganizerID'];

            $postModel = new CulturalEventOrganizerModel($this->conn);
            $post = $postModel->getPost($organizerID, $postID);

            if (empty($post)) {
                $_SESSION['error'] = "Post not found or you don't have permission to edit this post.";
                header('Location: dashboard?page=post');
                exit();
            }

            // Pass the post data to the edit_post view
            require_once __DIR__ . '/../Views/culturaleventorganizer_dashboard/edit_post.php';
        }
    }

    public function deletePost()
    {
        if (isset($_GET['id'])) {
            $postID = $_GET['id'];

            $postModel = new CulturalEventOrganizerModel($this->conn);
            $postModel->deletePost($postID);

            header('Location: ../culturaleventorganizer/dashboard?page=post');
        }
    }

    public function bookings()
    {
        if (isset($_SESSION['OrganizerID'])) {
            $bookings = $this->viewBookings();

            // Debug the bookings data structure
            if (!empty($bookings)) {
                error_log("Booking sample: " . print_r($bookings[0], true));
            } else {
                error_log("No bookings found for organizer ID: " . $_SESSION['OrganizerID']);
            }

            require_once __DIR__ . '/../Views/culturaleventorganizer_dashboard/bookings.php';
        } else {
            header('Location: ../login');
            exit();
        }
    }

    public function viewBookings()
    {
        $eventModel = new CulturalEventOrganizerModel($this->conn);
        $bookings = $eventModel->getBookings($_SESSION['OrganizerID']);

        return $bookings;
    }

    public function updateBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Get form data with validation
            $bookingID = isset($_POST['bookingID']) ? (int)$_POST['bookingID'] : 0;
            $date = isset($_POST['date']) ? $_POST['date'] : '';
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 0;
            $status = isset($_POST['status']) ? $_POST['status'] : 'Pending';
            $eventID = isset($_POST['eventID']) ? (int)$_POST['eventID'] : 0;
            $travelerID = isset($_POST['travelerID']) ? (int)$_POST['travelerID'] : 0;

            // Better amount handling - treat empty strings as null
            $amount = null;
            if (isset($_POST['amount']) && $_POST['amount'] !== '') {
                $amount = (float)$_POST['amount'];
                // If amount is zero, treat as null to avoid database constraints
                if ($amount == 0) {
                    $amount = null;
                }
            }

            // Log the booking data for debugging
            error_log("Updating booking ID: $bookingID with data: " . json_encode([
                'date' => $date,
                'quantity' => $quantity,
                'status' => $status,
                'eventID' => $eventID,
                'travelerID' => $travelerID,
                'amount' => $amount
            ]));

            // Basic validation
            if (!$bookingID || !$date || !$eventID) {
                $_SESSION['error'] = "Missing required booking information";
                header('Location: ../culturaleventorganizer/dashboard?page=bookings');
                exit();
            }

            $eventModel = new CulturalEventOrganizerModel($this->conn);

            // Validate ownership - essential security check
            $isValid = $eventModel->validateBookingOwnership($bookingID, $_SESSION['OrganizerID']);
            if (!$isValid) {
                $_SESSION['error'] = "You don't have permission to edit this booking.";
                header('Location: ../culturaleventorganizer/dashboard?page=bookings');
                exit();
            }

            // Perform the update
            $success = $eventModel->updateBooking($bookingID, $date, $quantity, $status, $eventID, $amount);

            if ($success) {
                $_SESSION['success'] = "Booking updated successfully!";
            } else {
                $_SESSION['error'] = "Failed to update booking. Please try again.";
            }

            // Clear all session variables related to booking editing
            unset($_SESSION['BookingID']);
            unset($_SESSION['Date']);
            unset($_SESSION['Quantity']);
            unset($_SESSION['Status']);
            unset($_SESSION['EventID']);
            unset($_SESSION['TravelerID']);
            unset($_SESSION['TravelerName']);
            unset($_SESSION['Amount']);
            unset($_SESSION['AvailableEvents']);

            header('Location: ../culturaleventorganizer/dashboard?page=bookings');
            exit();
        } else {
            header('Location: ../culturaleventorganizer/dashboard?page=bookings');
            exit();
        }
    }

    public function reviewResponse()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewID = $_POST['review_id'];
            $response = $_POST['response'];

            $eventModel = new CulturalEventOrganizerModel($this->conn);
            $success = $eventModel->addReviewResponse($reviewID, $response);

            if ($success) {
                $_SESSION['success'] = "Response submitted successfully!";
            } else {
                $_SESSION['error'] = "Failed to submit response. Please try again.";
            }

            header('Location: ../culturaleventorganizer/dashboard?page=reviews');
            exit();
        }
    }
}
