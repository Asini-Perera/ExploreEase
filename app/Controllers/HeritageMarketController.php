<?php

namespace app\Controllers;

use app\Models\HeritageMarketModel;
use app\Models\SignupModel;

class HeritageMarketController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the HeritageMarketModel
        require_once __DIR__ . '/../models/HeritageMarketModel.php';
        require_once __DIR__ . '/../models/SignupModel.php';
    }

    public function dashboard()
    {
        if (isset($_SESSION['ShopID'])) {
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard'; // Default page is dashboard
            $action = isset($_GET['action']) ? $_GET['action'] : null;
            
            // Check if this is a package creation action (form submission)
            if ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'POST') {
                $this->createPackage();
                return; // Stop execution after processing
            }
            
            $allowed_pages = ['dashboard', 'profile', 'product', 'reviews', 'packages'];
            $mainContent = in_array($page, $allowed_pages) ? $page : '404';

            if ($mainContent == 'dashboard') {
                $heritageMarketModel = new HeritageMarketModel($this->conn);
                $totalProducts = $heritageMarketModel->getTotalProducts($_SESSION['ShopID']);
                $totalReviews = $heritageMarketModel->getTotalReviews($_SESSION['ShopID']);
                $averageRatings = $heritageMarketModel->getAverageRatings($_SESSION['ShopID']);
                $feedbacksWith5 = $heritageMarketModel->getFeedbacksWith5($_SESSION['ShopID']);
            } elseif ($mainContent == 'profile') {
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                $allowedActions = ['edit', 'changepassword'];
                $profileAction = in_array($action, $allowedActions) ? $action : null;
            } elseif ($mainContent == 'product') {
                $products = $this->viewProducts();
                $action = isset($_GET['action']) ? $_GET['action'] : null;
                $allowedActions = ['add', 'edit'];
                $verifiedAction = in_array($action, $allowedActions) ? $action : null;
                if ($verifiedAction == 'edit') {
                    $productID = isset($_GET['id']) ? $_GET['id'] : null;
                    $heritageMarketModel = new HeritageMarketModel($this->conn);
                    $product = $heritageMarketModel->getProductById($productID);
                }
            } elseif ($mainContent == 'reviews') {
                $heritageMarketModel = new HeritageMarketModel($this->conn);
                $reviews = $heritageMarketModel->getReviews($_SESSION['ShopID']);
            } elseif ($mainContent == 'packages') {
                $heritageMarketModel = new HeritageMarketModel($this->conn);
                
                // Always load the list of packages created by this shop
                $packages = $heritageMarketModel->getPackages($_SESSION['ShopID']);
                
                // Fetch all package users
                $packageUsers = $heritageMarketModel->getAllPackageUsers($_SESSION['ShopID']);
                
                // Organize users by package
                $packageUsersByPackage = [];
                foreach ($packageUsers as $user) {
                    if (!isset($packageUsersByPackage[$user['PackageID']])) {
                        $packageUsersByPackage[$user['PackageID']] = [];
                    }
                    $packageUsersByPackage[$user['PackageID']][] = $user;
                }
                
                // Always load service providers for the request buttons
                $hotels = $heritageMarketModel->getAllServiceProviders('Hotel');
                $restaurants = $heritageMarketModel->getAllServiceProviders('Restaurant');
                $culturalEvents = $heritageMarketModel->getAllServiceProviders('CulturalEvent');
                $heritageMarkets = $heritageMarketModel->getAllServiceProviders('HeritageMarket');
                
                if ($action == 'add') {
                    $verifiedAction = 'add';
                } elseif ($action == 'edit') {
                    $verifiedAction = 'edit';
                    // Fetch package details when editing
                    if (isset($_GET['id'])) {
                        $packageID = $_GET['id'];
                        $package = $heritageMarketModel->getPackage($packageID);
                        
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
                        $success = $heritageMarketModel->deletePackage($packageID, $_SESSION['ShopID']);
                        
                        if ($success) {
                            $_SESSION['success'] = "Package deleted successfully";
                        } else {
                            $_SESSION['error'] = "Failed to delete package";
                        }
                        
                        // Redirect to avoid resubmission
                        header('Location: ../heritagemarket/dashboard?page=packages');
                        exit();
                    }
                } else {
                    $verifiedAction = null;
                }
            }

            require_once __DIR__ . '/../Views/heritagemarket_dashboard/main.php';
        } else {
            header('Location: ../login');
            exit();
        }
    }


    public function addProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;
            $shopID = $_SESSION['ShopID'];

            $heritageMarketModel = new HeritageMarketModel($this->conn);
            $productID = $heritageMarketModel->addProduct($product_name, $price, $description, $shopID);

            // If image is uploaded, set the image path
            if ($productID && $image['name']) {
                $heritageMarketModel->setImgPath($productID, $image);
            }

            header('Location: ../heritagemarket/dashboard?page=product');
        }
    }

    public function editProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productID = $_POST['productID'];
            $product_name = $_POST['product_name'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $image = isset($_FILES['image']) ? $_FILES['image'] : null;

            $heritageMarketModel = new HeritageMarketModel($this->conn);
            $heritageMarketModel->editProduct($productID, $product_name, $price, $description);

            // If image is uploaded, set the image path
            if ($image['name']) {
                $heritageMarketModel->setImgPath($productID, $image);
            }

            header('Location: ../heritagemarket/dashboard?page=product');
        }
    }

    public function deleteProduct()
    {
        if (isset($_GET['id'])) {
            $productID = $_GET['id'];

            $heritageModel = new HeritagemarketModel($this->conn);
            $heritageModel->deleteProduct($productID);

            header('Location: ../heritagemarket/dashboard?page=product');
        }
    }

    public function viewProducts()
    {
        $heritageMarketModel = new HeritageMarketModel($this->conn);
        $products = $heritageMarketModel->getProducts($_SESSION['ShopID']);

        return $products;
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $heritageID = $_SESSION['ShopID'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $contactNo = $_POST['contact_no'];
            $description = $_POST['description'];
            $website = $_POST['website'];
            $sm_link = $_POST['sm_link'];
            $open_hours = $_POST['open_hours'];

            // Check if the email is already exists and it's not the same as the current one
            $signupModel = new SignupModel($this->conn);
            $user = $signupModel->getUserByEmail($email);

            if ($user && $user['ShopID'] != $heritageID) {
                header('Location: ../heritagemarket/dashboard?page=profile');
                exit();
            }

            $hotelModel = new HeritagemarketModel($this->conn);
            $hotelModel->updateHeritage($heritageID, $email, $name,  $address, $contactNo, $description,  $website, $sm_link, $open_hours);

            $_SESSION['Email'] = $email;
            $_SESSION['Name'] = $name;
            $_SESSION['Address'] = $address;
            $_SESSION['ContactNo'] = $contactNo;
            $_SESSION['Description'] = $description;
            $_SESSION['Website'] = $website;
            $_SESSION['SMLink'] = $sm_link;
            $_SESSION['OpenHours'] = $open_hours;

            header('Location: ../heritagemarket/dashboard?page=profile');
            exit();
        }
    }


    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $heritageID = $_SESSION['ShopID'];
            $currentPassword = $_POST['currentPassword'];
            $newPassword = $_POST['newPassword'];
            $confirmPassword = $_POST['confirmPassword'];

            $heritageModel = new HeritagemarketModel($this->conn);
            $valid = $heritageModel->checkCurrentPassword($heritageID, $currentPassword);

            if ($valid) {
                if ($newPassword === $confirmPassword) {
                    $heritageModel->changePassword($heritageID, $newPassword);
                    header('Location: ../heritagemarket/dashboard?page=profile');
                    exit();
                } else {
                    header('Location: ../heritagemarket/dashboard?page=profile&action=changepassword');
                    exit();
                }
            } else {
                header('Location: ../heritagemarket/dashboard?page=profile&action=changepassword');
                exit();
            }
        }
    }

    public function reviewResponse()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewID = $_POST['review_id'];
            $response = $_POST['response'];

            $heritageMarketModel = new HeritageMarketModel($this->conn);
            $heritageMarketModel->addResponse($reviewID, $response);

            header('Location: ../heritagemarket/dashboard?page=reviews');
        }
    }

    public function shops(): void
    {


        require_once __DIR__ . '/../Views/heritageMarket/heritageMarketView.php';
    }


    public function products(): void
    {


        require_once __DIR__ . '/../Views/heritageMarket/products.php';
    }

    public function createPackage()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate required fields
            if (empty($_POST['name']) || empty($_POST['description']) || empty($_POST['discount']) || 
                empty($_POST['startDate']) || empty($_POST['endDate']) || empty($_POST['partner_ids'])) {
                $_SESSION['error'] = "All required fields must be filled";
                header('Location: ../heritagemarket/dashboard?page=packages&action=add');
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
                $heritageMarketModel = new HeritageMarketModel($this->conn);
                $imgPath = $heritageMarketModel->uploadPackageImage($_FILES['packageImage']);
                
                if (!$imgPath) {
                    $_SESSION['error'] = "Failed to upload image. Please try again.";
                    header('Location: ../heritagemarket/dashboard?page=packages&action=add');
                    exit();
                }
            }
            
            // Initialize all partner IDs
            $restaurantID = null;
            $shopID = null;
            $eventID = null;
            $hotelID = null;
            
            // Set the appropriate partner IDs from selections
            if (!empty($selectedTypes)) {
                // Set restaurant partner if selected
                if (!empty($selectedTypes['restaurant'])) {
                    $restaurantID = $selectedTypes['restaurant'][0]; // Use the first selected restaurant
                }
                
                // Set heritage market partner if selected
                if (!empty($selectedTypes['heritagemarket'])) {
                    $partnerShopID = $selectedTypes['heritagemarket'][0]; // Use the first selected market
                }
                
                // Set cultural event partner if selected
                if (!empty($selectedTypes['culturaleventorganizer'])) {
                    $eventID = $selectedTypes['culturaleventorganizer'][0]; // Use the first selected event
                }
                
                // Set hotel partner if selected
                if (!empty($selectedTypes['hotel'])) {
                    $hotelID = $selectedTypes['hotel'][0]; // Use the first selected hotel
                }
            }
            
            // Current heritage market is always the owner
            $shopID = $_SESSION['ShopID'];
            $owner = 'heritagemarket';
            
            // Create package model
            $heritageMarketModel = new HeritageMarketModel($this->conn);
            
            // Create a single package with all selected partners
            $success = $heritageMarketModel->createPackage(
                $name, $description, $discount, $startDate, $endDate, 
                $imgPath, $owner, $hotelID, $restaurantID, $shopID, $eventID
            );
            
            if ($success) {
                $_SESSION['success'] = "Package created successfully!";
                header('Location: ../heritagemarket/dashboard?page=packages');
            } else {
                $_SESSION['error'] = "Failed to create package. Please try again.";
                header('Location: ../heritagemarket/dashboard?page=packages&action=add');
            }
            exit();
        }
    }
}
