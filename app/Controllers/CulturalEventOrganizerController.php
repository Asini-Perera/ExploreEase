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
            } elseif ($mainContent == 'bookings') {
                // Handle bookings page logic here
            } elseif ($mainContent == 'reviews') {
                // Handle reviews page logic here
            } elseif ($mainContent == '404') {
                // Handle 404 page logic here
            } elseif ($mainContent == 'settings') {
                // Handle settings page logic here
            }
            else if ($mainContent == 'profile') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                if ($action == 'edit') {
                    $verifiedAction = 'edit';
                } elseif ($action == 'change-password') {
                    $verifiedAction = 'change-password';
                }
            } elseif ($mainContent == 'event') {
                $events = $this->viewEvent();
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
            }


            require_once __DIR__ . '/../Views/culturaleventorganizer_dashboard/main.php';
        } else {
            header('Location: ../login');
            exit();
        }
    }


    public function viewEvent()
    {
        $eventModel = new CulturalEventOrganizerModel($this->conn);
        $events = $eventModel->getAllEvents($_SESSION['OrganizerID']);

        return $events;
    }


    public function addEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $address = $_POST['address'];
            $date = $_POST['date'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $description = $_POST['description'];
            $capacity = $_POST['capacity'];
            $price = $_POST['price'];
            $status = $_POST['status'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $eventID = $_SESSION['organizerID'];

            $eventModel = new CulturalEventOrganizerModel($this->conn);
            $eventID = $eventModel->addEvent($title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $eventID);

            // If image is uploaded, set the image path
            if ($eventID && $image['name']) {
                $eventModel->setImgPath($eventID, $image);
            }

            header('Location: ../culturaleventorganizer/dashboard?page=event');
        }
    }

    public function viewEvent()
    {
        $organizerModel = new CulturalEventOrganizerModel($this->conn);
        $events = $organizerModel->getEvent($_SESSION['OrganizerID']);

        return $events;
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
            $organizerID = $_SESSION['OrganizerID'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;

            $postModel = new CulturalEventOrganizerModel($this->conn);
            $postID = $postModel->addPost($title, $description, $organizerID);

            if ($postID && $image['name']) {
                $postModel->setImgPath($organizerID, $image);
            }

            header('Location: ../culturaleventorganizer/dashboard?page=post');
        }
    }

    public function viewPost()
    {
        $postModel = new CulturalEventOrganizerModel($this->conn);
        $posts = $postModel->getPost($_SESSION['OrganizerID']);

        return $posts;
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
}
