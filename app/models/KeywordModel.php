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

    public function saveKeywords($travelerID, $keywords)
    {
        // Delete keywords if exists
        $sql = "DELETE FROM travelerkeyword WHERE TravelerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $travelerID);
        $stmt->execute();

        // Insert new keywords
        $sql = "INSERT INTO travelerkeyword (TravelerID, KeywordID) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);

        foreach ($keywords as $keyword) {
            $stmt->bind_param('ii', $travelerID, $keyword);
            $stmt->execute();
        }
    }
}