<?php

namespace app\Controllers;

use app\Models\HomeModel;
use app\Models\HotelModel;
use app\Models\RestaurantModel;
use app\Models\HeritageMarketModel;
use app\Models\CulturalEventOrganizerModel;

use app\Controllers\KeywordController;

class HomeController
{
    private $conn;
    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the HomeModel and service provider Models
        require_once __DIR__ . '/../models/HomeModel.php';
        require_once __DIR__ . '/../models/HotelModel.php';
        require_once __DIR__ . '/../models/RestaurantModel.php';
        require_once __DIR__ . '/../models/HeritageMarketModel.php';
        require_once __DIR__ . '/../models/CulturalEventOrganizerModel.php';

        // Include the KeywordController
        require_once __DIR__ . '/../controllers/KeywordController.php';
    }

    public function index()
    {
        $homeModel = new HomeModel($this->conn);
        $reviews = $homeModel->getReviews();
        require_once __DIR__ . '/../Views/home.php';
    }

    public function loged_index()
    {
        $homeModel = new HomeModel($this->conn);
        $reviews = $homeModel->getReviews();
        require_once __DIR__ . '/../Views/loged_home.php';
    }

    
    public function keywordsearch()
    {
        require_once __DIR__ . '/../Views/keyword_search.php';
    }

    public function locationsearch()
    {
        require_once __DIR__ . '/../Views/search_by_location.php';
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../ExploreEase');
        exit();
    }

    public function travelerside_hotel()
    {
        require_once __DIR__ . '/../Views/service_traveller_side_view/hotel.php';
    }

    public function travelerside_restaurant()
    {
        require_once __DIR__ . '/../Views/service_traveller_side_view/restaurant.php';
    }


    public function travelerside_cultural_event()
    {
        require_once __DIR__ . '/../Views/service_traveller_side_view/cultural_event.php';
    }

    public function travelerside_menu()
    {
        require_once __DIR__ . '/../Views/restaurant/menu_pdf.php';
    }

    public function post()
    {
        require_once __DIR__ . '/../Views/restaurant_dashboard/edit_post.php';
    }
    public function siteReview()
    {
        require_once __DIR__ . '/../Views/siteReview.php';
    }

    public function TravellerDashboard()
    {
        require_once __DIR__ . '/../Views/service_traveller_side_view/TravellerDashboard.php';
    }

    public function loggedNavbar()
    {
        require_once __DIR__ . '/../Views/loggedNavbar.php';
    }


    public function travllerBooking()
    {
        require_once __DIR__ . '/../Views/travllerBooking.php';
    }

    public function Contactus()
    {
        require_once __DIR__ . '/../Views/Contactus.php';
    }


     public function TravellerPackageList()
    {
        require_once __DIR__ . '/../Views/TravellerPackageList.php';
    }


    

     public function saveReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $rating = $_POST['rating'];
            $comment = $_POST['comments'];

            $homeModel = new HomeModel($this->conn);
            $homeModel->saveReview($name, $email, $rating, $comment);

            header('Location: ../loged_home');
            exit();
        }
    }
    public function filterKeyword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $latitude = $_POST['latitude'] ?? null;
            $longitude = $_POST['longitude'] ?? null;
            $keywordIDs = json_decode($_POST['keyword_ids'] ?? '[]', true);

            $homeModel = new HomeModel($this->conn);
            $places = $homeModel->getPlacesByKeyword($latitude, $longitude, $keywordIDs);

            session_start();
            $_SESSION['places'] = $places;
            $_SESSION['latitude'] = $latitude;
            $_SESSION['longitude'] = $longitude;

            header('Location: ../search/keyword');
            exit();
        }
    }

    public function linkService()
    {
        $type = $_GET['type'] ?? null;
        $id = $_GET['id'] ?? null;

        if ($type && $id) {
            $homeModel = new HomeModel($this->conn);

            if ($type === 'hotel') {
                $hotel = $homeModel->getHotelById($id);
                if ($hotel) {
                    $hotelModel = new HotelModel($this->conn);
                    $Reviews = $hotelModel->getReviews($id);
                    $Rooms = $hotelModel->getRoom($id);
                    require_once __DIR__ . '/../Views/service_traveller_side_view/hotel.php';
                } else {
                    echo "Hotel not found.";
                }
            } elseif ($type === 'restaurant') {
                $restaurant = $homeModel->getRestaurantById($id);
                if ($restaurant) {
                    $restaurantModel = new RestaurantModel($this->conn);
                    $Reviews = $restaurantModel->getReview($id);
                    $PopularDishes = $restaurantModel->getPopularDishes($id);
                    require_once __DIR__ . '/../Views/service_traveller_side_view/restaurant.php';
                } else {
                    echo "Restaurant not found.";
                }
            } elseif ($type === 'heritagemarket') {
                $heritageMarket = $homeModel->getHeritageMarketById($id);
                if ($heritageMarket) {
                    $heritageMarketModel = new HeritageMarketModel($this->conn);
                    $Reviews = $heritageMarketModel->getReviews($id);
                    $Products = $heritageMarketModel->getProducts($id);
                    require_once __DIR__ . '/../Views/service_traveller_side_view/heritagemarket.php';
                } else {
                    echo "Heritage Market not found.";
                }
                // } elseif ($type === 'cultural_event') {
                //     $culturalEvent = $homeModel->getCulturalEventById($id);
                //     if ($culturalEvent) {
                //         require_once __DIR__ . '/../Views/service_traveller_side_view/cultural_event.php';
                //     } else {
                //         echo "Cultural Event not found.";
                //     }
            } else {
                echo "Invalid service type.";
            }
        } else {
            header('Location: ../loged_home');
            exit();
        }
    }

    public function addReview(): void
    {
        require_once __DIR__ . '/../Views/heritageMarket/review.php';
    }

    public function saveServiceReview(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $rating = $_POST['rating'];
            $review = $_POST['review'];

            $type = $_GET['type'] ?? null;
            $id = $_GET['id'] ?? null;

            $travelerID = $_SESSION['TravelerID'] ?? null;

            $date = date('Y-m-d');

            if ($type && $id && $travelerID) {
                if ($type === 'hotel') {
                    $hotelModel = new HotelModel($this->conn);
                    $hotelModel->addReview($id, $travelerID, $rating, $review, $date);
                } elseif ($type === 'restaurant') {
                    $restaurantModel = new RestaurantModel($this->conn);
                    $restaurantModel->addReview($id, $travelerID, $rating, $review, $date);
                } elseif ($type === 'heritagemarket') {
                    $heritageMarketModel = new HeritageMarketModel($this->conn);
                    $heritageMarketModel->addReview($id, $travelerID, $rating, $review, $date);
                } elseif ($type === 'cultural_event') {
                    $culturalEventModel = new CulturalEventOrganizerModel($this->conn);
                    // $culturalEventModel->addReview($id, $travelerID, $rating, $review, $date);
                }

                header('Location: ../link/service?type=' . $type . '&id=' . $id);
            } else {
                echo "Invalid request.";
            }
        }

    }

}
