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
            $allowed_pages = ['dashboard', 'profile', 'product', 'reviews'];
            $mainContent = in_array($page, $allowed_pages) ? $page : '404';

            if ($mainContent == 'profile') {
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

    public function review(): void
    {


        require_once __DIR__ . '/../Views/heritageMarket/review.php';
    }
}
