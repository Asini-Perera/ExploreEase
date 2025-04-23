<?php

namespace app\Models;

class HomeModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveReview($name, $email, $rating, $comment)
    {
        $sql = "INSERT INTO feedback (Name, Email, Rating, Comment) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis", $name, $email, $rating, $comment);
        $stmt->execute();
    }

    public function getReviews()
    {
        $sql = "SELECT * FROM feedback ORDER BY RAND()";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPlacesByKeyword($latitude, $longitude, $keywordIDs)
    {
        $keywordIDs = implode(',', array_map('intval', $keywordIDs));
        $sql = "SELECT *, (6371 * acos(cos(radians(?)) * cos(radians(Latitude)) * cos(radians(Longitude) - radians(?)) + sin(radians(?)) * sin(radians(Latitude)))) AS distance
                FROM hotel h INNER JOIN hotelkeyword hk ON h.HotelID = hk.HotelID
                WHERE hk.KeywordID IN ($keywordIDs)
                HAVING distance < 100
                ORDER BY distance ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ddd", $latitude, $longitude, $latitude);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
