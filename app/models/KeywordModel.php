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
}