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
        } else {
            header('Location: ../admin/waiting');
        }
    }

    public function addKeyword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category']) && isset($_POST['keyword'])) {
            $category = $_POST['category'];
            $keyword = $_POST['keyword'];

            $keywordModel = new KeywordModel($this->conn);
            
            $addition = $keywordModel->addKeyword($category, $keyword);

            if ($addition) {
                $_SESSION['success'] = 'Keyword added successfully';
            } else {
                $_SESSION['error'] = 'Failed to add keyword';
            }

            header('Location: ../admin/dashboard?page=keyword&action=add');

        }
    }

    public function deleteKeyword()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category']) && isset($_POST['keyword'])) {
            $category = $_POST['category'];
            $keyword = $_POST['keyword'];

            $keywordModel = new KeywordModel($this->conn);
            
            $deletion = $keywordModel->deleteKeyword($category, $keyword);

            if ($deletion) {
                $_SESSION['success'] = 'Keyword deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete keyword';
            }

            header('Location: ../admin/dashboard?page=keyword&action=delete');

        }
    }
     public function keywordselect()
    {
        require_once __DIR__ . '/../views/keyword_select.php';
    }
}
