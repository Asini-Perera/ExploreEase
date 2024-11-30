<?php

namespace app\Models;

class KeywordModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getCategories()
    {
        $sql = "SELECT * FROM category";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getKeywordsByCategory($categoryID)
    {
        $sql = "SELECT * FROM keyword WHERE CategoryID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $categoryID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function saveKeywords($table, $userID, $keywords)
    {
        if ($table === 'travelerkeyword') {
            $deleteSQL = "DELETE FROM $table WHERE TravelerID = ?";
            $addSQL = "INSERT INTO $table (TravelerID, KeywordID) VALUES (?, ?)";
        } else if ($table === 'restaurantkeyword') {
            $deleteSQL = "DELETE FROM $table WHERE RestaurantID = ?";
            $addSQL = "INSERT INTO $table (RestaurantID, KeywordID) VALUES (?, ?)";
        } else if ($table === 'hotelkeyword') {
            $deleteSQL = "DELETE FROM $table WHERE HotelID = ?";
            $addSQL = "INSERT INTO $table (HotelID, KeywordID) VALUES (?, ?)";
        } else if ($table === 'heritagemarketkeyword') {
            $deleteSQL = "DELETE FROM $table WHERE ShopID = ?";
            $addSQL = "INSERT INTO $table (ShopID, KeywordID) VALUES (?, ?)";
        } else if ($table === 'culturaleventorganizerkeyword') {
            $deleteSQL = "DELETE FROM $table WHERE OrganizerID = ?";
            $addSQL = "INSERT INTO $table (OrganizerID, KeywordID) VALUES (?, ?)";
        }

        // Delete keywords if exists
        $stmt = $this->conn->prepare($deleteSQL);
        $stmt->bind_param('i', $userID);
        $stmt->execute();

        // Insert new keywords
        $stmt = $this->conn->prepare($addSQL);

        foreach ($keywords as $keyword) {
            $stmt->bind_param('ii', $userID, $keyword);
            $stmt->execute();
        }
    }

    public function checkCategory($category) {
        $sql = "SELECT CategoryID FROM category WHERE CategoryName = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $category);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return $row['CategoryID'];
        } else {
            return null;
        }
    }

    public function createCategory($category) {
        $sql = "INSERT INTO category (CategoryName) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $category);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function checkKeyword($categoryID, $keyword) {
        $sql = "SELECT KeywordID FROM keyword WHERE CategoryID = ? AND KName = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('is', $categoryID, $keyword);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return $row['KeywordID'];
        } else {
            return null;
        }
    }

    public function addKeyword($category, $keyword) {
        $categoryID = $this->checkCategory($category);

        if (!$categoryID) {
            $categoryID = $this->createCategory($category);
        }

        $keywordID = $this->checkKeyword($categoryID, $keyword);

        if (!$keywordID) {
            $sql = "INSERT INTO keyword (CategoryID, KName) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('is', $categoryID, $keyword);
            $stmt->execute();

            return true;
        } else {
            return false;
        }
  
    }

    public function deleteKeyword($category, $keyword) {
        $categoryID = $this->checkCategory($category);

        if (!$categoryID) {
            return false;
        }

        $keywordID = $this->checkKeyword($categoryID, $keyword);

        if (!$keywordID) {
            return false;
        }

        $sql = "DELETE FROM keyword WHERE CategoryID = ? AND KName = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('is', $categoryID, $keyword);
        $stmt->execute();

        $sql = "SELECT COUNT(*) as count FROM keyword WHERE CategoryID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $categoryID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] == 0) {
            $sql = "DELETE FROM category WHERE CategoryID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $categoryID);
            $stmt->execute();
        }

        return true;
    }
}