<?php

namespace app\Controllers;

use app\Models\KeywordModel;

class KeywordController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the KeywordModel
        require_once __DIR__ . '/../models/KeywordModel.php';
    }

    public function keywordsearch()
    {
        require_once __DIR__ . '/../Views/keyword_search.php';
    }

    public function getCategoriesWithKeywords()
    {
        $keywordModel = new KeywordModel($this->conn);
        $categories = $keywordModel->getCategories();

        foreach ($categories as &$category) {
            $category['keywords'] = $keywordModel->getKeywordsByCategory($category['CategoryID']);
        }

        return $categories;
    }

    public function loadKeywordPage()
    {
        $categories = $this->getCategoriesWithKeywords();
        require_once __DIR__ . '/../Views/keyword.php';
    }

    public function saveKeywords()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['keywords'])) {
            
            $keywords = $_POST['keywords'];
            if (isset($_SESSION['TravelerID'])) {
                $userID = $_SESSION['TravelerID'];
                $table = 'travelerkeyword';
            } elseif (isset($_SESSION['RestaurantID'])) {
                $userID = $_SESSION['RestaurantID'];
                $table = 'restaurantkeyword';
            } elseif (isset($_SESSION['HotelID'])) {
                $userID = $_SESSION['HotelID'];
                $table = 'hotelkeyword';
            } elseif (isset($_SESSION['ShopID'])) {
                $userID = $_SESSION['ShopID'];
                $table = 'heritagemarketkeyword';
            } elseif (isset($_SESSION['OrganizerID'])) {
                $userID = $_SESSION['OrganizerID'];
                $table = 'culturaleventorganizerkeyword';
            }
        
            $keywordModel = new KeywordModel($this->conn);
            $keywordModel->saveKeywords($table,$userID, $keywords);
        } 

        if (isset($_SESSION['TravelerID'])) {
            header('Location: ../');
        } else if (isset($_SESSION['RestaurantID'])) {
            header('Location: ../restaurant/dashboard');
        } else if (isset($_SESSION['HotelID'])) {
            header('Location: ../hotel/dashboard');
        } else if (isset($_SESSION['ShopID'])) {
            header('Location: ../heritagemarket/dashboard');
        } else if (isset($_SESSION['OrganizerID'])) {
            header('Location: ../culturaleventorganizer/dashboard');
        }

    }
     public function keywordselect()
    {
        require_once __DIR__ . '/../views/keyword_select.php';
    }
}
