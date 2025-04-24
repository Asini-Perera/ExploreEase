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

    // public function getPlacesByKeyword($latitude, $longitude, $keywordIDs)
    // {
    //     $keywordIDs = implode(',', array_map('intval', $keywordIDs));
    //     $sql = "SELECT h.*, MIN((6371 * acos(cos(radians(?)) * cos(radians(Latitude)) * cos(radians(Longitude) - radians(?)) + sin(radians(?)) * sin(radians(Latitude))))) AS distance
    //         FROM hotel h INNER JOIN hotelkeyword hk ON h.HotelID = hk.HotelID
    //         WHERE hk.KeywordID IN ($keywordIDs)
    //         GROUP BY h.HotelID
    //         HAVING distance < 100
    //         ORDER BY distance ASC";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param("ddd", $latitude, $longitude, $latitude);
    //     $stmt->execute();
    //     return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    // }

    public function getPlacesByKeyword($latitude, $longitude, $keywordIDs)
    {
        if (empty($keywordIDs)) {
            return [];
        }

        // Sanitize and prepare keyword placeholders
        $placeholders = implode(',', array_fill(0, count($keywordIDs), '?'));

        // SQL to combine both hotel and restaurant
        $sql = "
        SELECT h.HotelID AS ID, h.Name, h.Tagline, h.Description, h.Latitude, h.Longitude,
               'hotel' AS type,
               (6371 * acos(cos(radians(?)) * cos(radians(h.Latitude)) * cos(radians(h.Longitude) - radians(?)) + sin(radians(?)) * sin(radians(h.Latitude)))) AS distance
        FROM hotel h
        INNER JOIN hotelkeyword hk ON h.HotelID = hk.HotelID
        WHERE hk.KeywordID IN ($placeholders)

        UNION

        SELECT r.RestaurantID AS ID, r.Name, r.Tagline, r.Description, r.Latitude, r.Longitude,
               'restaurant' AS type,
               (6371 * acos(cos(radians(?)) * cos(radians(r.Latitude)) * cos(radians(r.Longitude) - radians(?)) + sin(radians(?)) * sin(radians(r.Latitude)))) AS distance
        FROM restaurant r
        INNER JOIN restaurantkeyword rk ON r.RestaurantID = rk.RestaurantID
        WHERE rk.KeywordID IN ($placeholders)

        ORDER BY distance ASC";

        $stmt = $this->conn->prepare($sql);

        // Merge parameters: lat/lon x2 + keywords x2
        $params = array_merge([$latitude, $longitude, $latitude], $keywordIDs, [$latitude, $longitude, $latitude], $keywordIDs);

        // Create type string: 3 'd' + keyword count * 2 's'
        $types = str_repeat('d', 3) . str_repeat('s', count($keywordIDs)) . str_repeat('d', 3) . str_repeat('s', count($keywordIDs));

        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
