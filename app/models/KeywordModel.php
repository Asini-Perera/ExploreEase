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

    public function checkCategory($category)
    {
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

    public function createCategory($category)
    {
        $sql = "INSERT INTO category (CategoryName) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $category);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function checkKeyword($categoryID, $keyword)
    {
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

    public function addKeyword($category, $keyword)
    {
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

    public function deleteKeyword($category, $keyword)
    {
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

    public function getUnverifiedKeywords($service)
    {
        if ($service === 'restaurant') {
            $sql = "SELECT DISTINCT r.RestaurantID, r.Name FROM restaurantkeyword k INNER JOIN restaurant r ON k.RestaurantID = r.RestaurantID WHERE k.IsVerified = 0";
        } else if ($service === 'hotel') {
            $sql = "SELECT DISTINCT h.HotelID, h.Name FROM hotelkeyword k INNER JOIN hotel h ON k.HotelID = h.HotelID WHERE k.IsVerified = 0";
        } else if ($service === 'heritagemarket') {
            $sql = "SELECT DISTINCT h.ShopID, h.Name FROM heritagemarketkeyword k INNER JOIN heritagemarket h ON k.ShopID = h.ShopID WHERE k.IsVerified = 0";
        } else if ($service === 'culturaleventorganizer') {
            $sql = "SELECT DISTINCT c.OrganizerID, c.Name FROM culturaleventorganizerkeyword k INNER JOIN culturaleventorganizer c ON k.OrganizerID = c.OrganizerID WHERE k.IsVerified = 0";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $serviceProviders = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($serviceProviders as &$serviceProvider) {
            if ($service === 'restaurant') {
                $sql = "SELECT DISTINCT k.CategoryID, c.CategoryName FROM restaurantkeyword r INNER JOIN keyword k ON r.KeywordID = k.KeywordID INNER JOIN category c ON k.CategoryID = c.CategoryID WHERE (r.RestaurantID = $serviceProvider[RestaurantID] AND r.IsVerified = 0)";
            } else if ($service === 'hotel') {
                $sql = "SELECT DISTINCT k.CategoryID, c.CategoryName FROM hotelkeyword h INNER JOIN keyword k ON h.KeywordID = k.KeywordID INNER JOIN category c ON k.CategoryID = c.CategoryID WHERE (h.HotelID = $serviceProvider[HotelID] AND h.IsVerified = 0)";
            } else if ($service === 'heritagemarket') {
                $sql = "SELECT DISTINCT k.CategoryID, c.CategoryName FROM heritagemarketkeyword h INNER JOIN keyword k ON h.KeywordID = k.KeywordID INNER JOIN category c ON k.CategoryID = c.CategoryID WHERE (h.ShopID = $serviceProvider[ShopID] AND h.IsVerified = 0)";
            } else if ($service === 'culturaleventorganizer') {
                $sql  = "SELECT DISTINCT k.CategoryID, c.CategoryName FROM culturaleventorganizerkeyword o INNER JOIN keyword k ON o.KeywordID = k.KeywordID INNER JOIN category c ON k.CategoryID = c.CategoryID WHERE (o.OrganizerID = $serviceProvider[OrganizerID] AND o.IsVerified = 0)";
            }
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            $serviceProvider['categories'] = $result->fetch_all(MYSQLI_ASSOC);

            foreach ($serviceProvider['categories'] as &$category) {
                if ($service === 'restaurant') {
                    $sql = "SELECT k.KeywordID, k.KName FROM restaurantkeyword r INNER JOIN keyword k ON r.KeywordID = k.KeywordID WHERE (r.RestaurantID = $serviceProvider[RestaurantID] AND r.IsVerified = 0) AND k.CategoryID = $category[CategoryID]";
                } else if ($service === 'hotel') {
                    $sql = "SELECT k.KeywordID, k.KName FROM hotelkeyword h INNER JOIN keyword k ON h.KeywordID = k.KeywordID WHERE (h.HotelID = $serviceProvider[HotelID] AND h.IsVerified = 0) AND k.CategoryID = $category[CategoryID]";
                } else if ($service === 'heritagemarket') {
                    $sql = "SELECT k.KeywordID, k.KName FROM heritagemarketkeyword h INNER JOIN keyword k ON h.KeywordID = k.KeywordID WHERE (h.ShopID = $serviceProvider[ShopID] AND h.IsVerified = 0) AND k.CategoryID = $category[CategoryID]";
                } else if ($service === 'culturaleventorganizer') {
                    $sql = "SELECT k.KeywordID, k.KName FROM culturaleventorganizerkeyword o INNER JOIN keyword k ON o.KeywordID = k.KeywordID WHERE (o.OrganizerID = $serviceProvider[OrganizerID] AND o.IsVerified = 0) AND k.CategoryID = $category[CategoryID]";
                }
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                $category['keywords'] = $result->fetch_all(MYSQLI_ASSOC);
            }
        }

        return $serviceProviders;
    }

    public function verifyKeyword($keywordID, $userType, $serviceProviderID)
    {
        if ($userType === 'restaurant') {
            $sql = "UPDATE restaurantkeyword SET IsVerified = 1 WHERE KeywordID = ? AND RestaurantID = ?";
        } else if ($userType === 'hotel') {
            $sql = "UPDATE hotelkeyword SET IsVerified = 1 WHERE KeywordID = ? AND HotelID = ?";
        } else if ($userType === 'heritagemarket') {
            $sql = "UPDATE heritagemarketkeyword SET IsVerified = 1 WHERE KeywordID = ? AND ShopID = ?";
        } else if ($userType === 'culturaleventorganizer') {
            $sql = "UPDATE culturaleventorganizerkeyword SET IsVerified = 1 WHERE KeywordID = ? AND OrganizerID = ?";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $keywordID, $serviceProviderID);
        $stmt->execute();
    }

    public function rejectKeyword($keywordID, $userType, $serviceProviderID)
    {
        if ($userType === 'restaurant') {
            $sql = "DELETE FROM restaurantkeyword WHERE KeywordID = ? AND RestaurantID = ?";
        } else if ($userType === 'hotel') {
            $sql = "DELETE FROM hotelkeyword WHERE KeywordID = ? AND HotelID = ?";
        } else if ($userType === 'heritagemarket') {
            $sql = "DELETE FROM heritagemarketkeyword WHERE KeywordID = ? AND ShopID = ?";
        } else if ($userType === 'culturaleventorganizer') {
            $sql = "DELETE FROM culturaleventorganizerkeyword WHERE KeywordID = ? AND OrganizerID = ?";
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $keywordID, $serviceProviderID);
        $stmt->execute();
    }
}
