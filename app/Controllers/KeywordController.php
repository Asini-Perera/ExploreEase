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
            } else if (isset($_SESSION['RestaurantID'])) {
                $userID = $_SESSION['RestaurantID'];
                $table = 'restaurantkeyword';
            } else if (isset($_SESSION['HotelID'])) {
                $userID = $_SESSION['HotelID'];
                $table = 'hotelkeyword';
            } else if (isset($_SESSION['ShopID'])) {
                $userID = $_SESSION['HeritageMarketID'];
                $table = 'heritagemarketkeyword';
            } else if (isset($_SESSION['OrganizerID'])) {
                $userID = $_SESSION['CulturalEventOrganizerID'];
                $table = 'culturaleventorganizerkeyword';
            }
        
            $keywordModel = new KeywordModel($this->conn);
            $keywordModel->saveKeywords($table,$userID, $keywords);
        } 

        header('Location: ../');
    }
}
