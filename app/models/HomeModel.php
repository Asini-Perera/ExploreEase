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

        // filter using formula of haversine
        $sql = "
        (SELECT h.HotelID AS ID, h.Name, h.Tagline, h.Description, h.Latitude, h.Longitude,
               'hotel' AS type,
               ROUND((6371 * acos(cos(radians(?)) * cos(radians(h.Latitude)) * cos(radians(h.Longitude) - radians(?)) + sin(radians(?)) * sin(radians(h.Latitude)))), 2) AS Distance
        FROM hotel h
        INNER JOIN hotelkeyword hk ON h.HotelID = hk.HotelID
        WHERE (hk.KeywordID IN ($placeholders) AND hk.IsVerified = 1 AND h.IsVerified = 1)
        HAVING Distance < 100)

        UNION

        (SELECT r.RestaurantID AS ID, r.Name, r.Tagline, r.Description, r.Latitude, r.Longitude,
               'restaurant' AS type,
               ROUND((6371 * acos(cos(radians(?)) * cos(radians(r.Latitude)) * cos(radians(r.Longitude) - radians(?)) + sin(radians(?)) * sin(radians(r.Latitude)))), 2) AS Distance
        FROM restaurant r
        INNER JOIN restaurantkeyword rk ON r.RestaurantID = rk.RestaurantID
        WHERE (rk.KeywordID IN ($placeholders) AND rk.IsVerified = 1 AND r.IsVerified = 1)
        HAVING Distance < 100)

        UNION

        (SELECT s.ShopID AS ID, s.Name, s.Tagline, s.Description, s.Latitude, s.Longitude,
               'heritagemarket' AS type,
               ROUND((6371 * acos(cos(radians(?)) * cos(radians(s.Latitude)) * cos(radians(s.Longitude) - radians(?)) + sin(radians(?)) * sin(radians(s.Latitude)))), 2) AS Distance
        FROM heritagemarket s
        INNER JOIN heritagemarketkeyword sk ON s.ShopID = sk.ShopID
        WHERE (sk.KeywordID IN ($placeholders) AND sk.IsVerified = 1 AND s.IsVerified = 1)
        HAVING Distance < 100)

        ORDER BY Distance ASC
        ";

        $stmt = $this->conn->prepare($sql);

        // Merge parameters: lat/lon x3 + keywords x3
        $params = array_merge(
            [$latitude, $longitude, $latitude],
            $keywordIDs,
            [$latitude, $longitude, $latitude],
            $keywordIDs,
            [$latitude, $longitude, $latitude],
            $keywordIDs
        );

        // Create type string: 3 'd' + keyword count * 3 'i'
        $types = str_repeat('d', 3) . str_repeat('i', count($keywordIDs)) . str_repeat('d', 3) . str_repeat('i', count($keywordIDs)) . str_repeat('d', 3) . str_repeat('i', count($keywordIDs));

        $stmt->bind_param($types, ...$params);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getHotelById($id)
    {
        $sql = "SELECT * FROM hotel WHERE HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getRestaurantById($id)
    {
        $sql = "SELECT * FROM restaurant WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getHeritageMarketById($id)
    {
        $sql = "SELECT * FROM heritagemarket WHERE ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getAllPackages($travelerID)
    {
        $sql = "
        SELECT 
            p.*,
            h.Name AS HotelName,
            r.Name AS RestaurantName,
            hm.Name AS HeritageMarketName,
            ce.Name AS EventName,
            CASE 
                WHEN p.StartDate > CURDATE() THEN 'Upcoming'
                ELSE 'Active'
            END AS Status
        FROM 
            Package p
        LEFT JOIN 
            hotel h ON p.HotelID = h.HotelID
        LEFT JOIN 
            restaurant r ON p.RestaurantID = r.RestaurantID
        LEFT JOIN 
            heritagemarket hm ON p.ShopID = hm.ShopID
        LEFT JOIN 
            culturalevent ce ON p.EventID = ce.EventID
        WHERE 
            p.IsVerified = 1 
            AND p.EndDate >= CURDATE()
            AND NOT EXISTS (
                SELECT 1 
                FROM packagecustomer pc 
                WHERE pc.PackageID = p.PackageID 
                AND pc.TravelerID = ?
            )
        ORDER BY
            p.StartDate ASC
    ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $travelerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $packages = $result->fetch_all(MYSQLI_ASSOC);
        return $packages;
    }
}
