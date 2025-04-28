<?php

namespace app\Models;

class CulturalEventOrganizerModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllEvents($organizerID)
    {
        $sql = "SELECT * FROM culturalevent WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addEvent($title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID)
    {
        try {
            // Log the SQL operation starting
            error_log("Adding new event for organizer ID: $organizerID");

            $sql = "INSERT INTO culturalevent (`Name`, `Address`, `Date`, `StartTime`, `EndTime`, `Description`, `Capacity`, `TicketPrice`, `Status`, `OrganizerID`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                error_log("SQL prepare error: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param('ssssssidsi', $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID);

            $result = $stmt->execute();

            if (!$result) {
                error_log("SQL execute error: " . $stmt->error);
                return false;
            }

            $insertId = $stmt->insert_id;
            error_log("Event added successfully with ID: $insertId");

            return $insertId;
        } catch (\Exception $e) {
            error_log("Exception in addEvent model: " . $e->getMessage());
            return false;
        }
    }

    public function updateEvent($eventID, $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status)
    {
        try {
            $sql = "UPDATE culturalevent SET 
                    `Name` = ?, 
                    `Address` = ?, 
                    `Date` = ?, 
                    `StartTime` = ?, 
                    `EndTime` = ?, 
                    `Description` = ?, 
                    `Capacity` = ?, 
                    `TicketPrice` = ?, 
                    `Status` = ? 
                    WHERE EventID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssssssidsi', $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $eventID);
            $stmt->execute();

            return $stmt->affected_rows > 0;
        } catch (\Exception $e) {
            error_log("Exception in updateEvent: " . $e->getMessage());
            return false;
        }
    }

    public function updateOrganizer($OrganizerID, $name, $email, $contactNo, $description, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink)
    {
        $sql = "UPDATE culturaleventorganizer SET 
                `Name` = ?, 
                `Email` = ?, 
                `ContactNo` = ?, 
                `Description` = ?, 
                `FacebookLink` = ?,
                `InstagramLink` = ?,
                `TikTokLink` = ?,
                `YouTubeLink` = ?
                WHERE OrganizerID = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            'ssisssssi',
            $name,
            $email,
            $contactNo,
            $description,
            $facebookLink,
            $instagramLink,
            $tiktokLink,
            $youtubeLink,
            $OrganizerID
        );
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function setImgPath($OrganizerID, $fileName)
    {
        try {
            // Get temp image path
            $tempImgPath = $fileName['tmp_name'];

            // Get the file name (original file name from the upload)
            $originalFileName = $fileName['name'];

            // Get the file extension
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

            // Create a new file name
            $newFileName = 'organizer_' . $OrganizerID . '.' . $extension;

            // Define the target directory
            $targetDir = __DIR__ . '/../../public/images/database/culturaleventorganizer/';

            // Check the directory exists and create it
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Create the image path
            $imgDir = $targetDir . $newFileName;

            // Move the image to the target directory
            $moving = move_uploaded_file($tempImgPath, $imgDir);

            // Define the image path for the database
            $imgPath = '/ExploreEase/public/images/database/culturaleventorganizer/' . $newFileName;

            // Enter the image path to the database
            if ($moving) {
                $sql = "UPDATE culturaleventorganizer SET ImgPath = ? WHERE OrganizerID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('si', $imgPath, $OrganizerID);
                return $stmt->execute();
            }

            return false;
        } catch (\Exception $e) {
            error_log("Exception in setImgPath: " . $e->getMessage());
            return false;
        }
    }

    public function getImgPath($OrganizerID)
    {
        $sql = "SELECT ImgPath FROM culturaleventorganizer WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $OrganizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['ImgPath'];
    }


    public function checkCurrentPassword($OrganizerID, $currentPassword)
    {
        $sql = "SELECT * FROM culturaleventorganizer WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $OrganizerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashedPassword = $result->fetch_assoc()['Password'];

        return password_verify($currentPassword, $hashedPassword);
    }

    public function changePassword($OrganizerID, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE culturaleventorganizer SET Password = ? WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $newPassword, $OrganizerID);
        $stmt->execute();
    }


    // public function addEvent($title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID)
    // {
    //     $sql = "INSERT INTO culturaleventorganizerpost (`Title`, `Description`, `OrganizerID`) VALUES (?, ?, ?)";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param('ssi', $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID);
    //     $stmt->execute();

    //     return $stmt->insert_id;
    // }


    public function getEventItem($postID)
    {
        $sql = "SELECT * FROM culturaleventorganizerpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    public function deleteEvent($eventID)
    {
        $sql = "DELETE FROM culturalevent WHERE EventID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $eventID);
        $stmt->execute();
    }

    public function addPost($title, $description, $organizerID)
    {
        try {
            $sql = "INSERT INTO culturaleventorganizerpost (`Title`, `Description`, `OrganizerID`, `Date`) VALUES (?, ?, ?, CURRENT_DATE())";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                error_log("SQL prepare error in addPost: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param('ssi', $title, $description, $organizerID);
            $result = $stmt->execute();

            if (!$result) {
                error_log("SQL execute error in addPost: " . $stmt->error);
                return false;
            }

            return $stmt->insert_id;
        } catch (\Exception $e) {
            error_log("Exception in addPost: " . $e->getMessage());
            return false;
        }
    }

    public function getPost($organizerID, $postID = null)
    {
        if ($postID) {
            // Fetch a specific post by ID
            $sql = "SELECT * FROM culturaleventorganizerpost WHERE PostID = ? AND OrganizerID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ii', $postID, $organizerID);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_assoc(); // Return a single post as associative array
        } else {
            // Fetch all posts for the organizer
            $sql = "SELECT * FROM culturaleventorganizerpost WHERE OrganizerID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $organizerID);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function updatePost($postID, $title, $description)
    {
        try {
            $sql = "UPDATE culturaleventorganizerpost SET Title = ?, Description = ? WHERE PostID = ?";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                error_log("SQL prepare error in updatePost: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param('ssi', $title, $description, $postID);
            $result = $stmt->execute();

            if (!$result) {
                error_log("SQL execute error in updatePost: " . $stmt->error);
                return false;
            }

            return true;
        } catch (\Exception $e) {
            error_log("Exception in updatePost: " . $e->getMessage());
            return false;
        }
    }

    public function setPostImagePath($postID, $fileName)
    {
        try {
            // Log the start of image upload process
            error_log("Starting to set image for post ID: $postID");

            // Get temp image path
            $tempImgPath = $fileName['tmp_name'];

            // Get the file name (original file name from the upload)
            $originalFileName = $fileName['name'];

            // Get the file extension
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

            // Create a new file name
            $newFileName = 'post_' . $postID . '.' . $extension;

            // Define the target directory
            $targetDir = __DIR__ . '/../../public/images/database/culturaleventorganizerpost/';

            // Check if the directory exists and create it if not
            if (!is_dir($targetDir)) {
                if (!mkdir($targetDir, 0777, true)) {
                    error_log("Failed to create directory: $targetDir");
                    return false;
                }
                error_log("Created directory: $targetDir");
            }

            // Create the image path
            $imgDir = $targetDir . $newFileName;

            // Move the image to the target directory
            $moving = move_uploaded_file($tempImgPath, $imgDir);

            // Define the image path for the database
            $imgPath = '/ExploreEase/public/images/database/culturaleventorganizerpost/' . $newFileName;

            // Update the database with the image path
            if ($moving) {
                error_log("Image moved successfully to: $imgDir");
                $sql = "UPDATE culturaleventorganizerpost SET ImgPath = ? WHERE PostID = ?";
                $stmt = $this->conn->prepare($sql);

                if (!$stmt) {
                    error_log("Failed to prepare SQL statement: " . $this->conn->error);
                    return false;
                }

                $stmt->bind_param('si', $imgPath, $postID);
                $result = $stmt->execute();

                if (!$result) {
                    error_log("Failed to update image path in database: " . $stmt->error);
                    return false;
                }

                return true;
            } else {
                $uploadError = error_get_last();
                error_log("Failed to move uploaded file. Error: " . ($uploadError ? $uploadError['message'] : 'Unknown error'));
                return false;
            }
        } catch (\Exception $e) {
            error_log("Exception in setPostImagePath: " . $e->getMessage());
            return false;
        }
    }

    public function getPostItem($postID)
    {
        $sql = "SELECT * FROM culturaleventorganizerpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    public function deletePost($postID)
    {
        $sql = "DELETE FROM culturaleventorganizerpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
    }


    public function getTotalBookings($organizerID)
    {
        $sql = "SELECT COUNT(*) as TotalBookings 
                FROM culturaleventbooking ceb
                JOIN culturalevent ce ON ceb.EventID = ce.EventID
                WHERE ce.OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalBookings'];
    }

    public function getTotalEvents($organizerID)
    {
        $sql = "SELECT COUNT(*) as TotalEvents FROM culturalevent WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalEvents'];
    }

    public function getTotalPosts($organizerID)
    {
        $sql = "SELECT COUNT(*) as TotalPosts FROM culturaleventorganizerpost WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalPosts'];
    }

    public function getTotalRatings($organizerID)
    {
        $sql = "SELECT COUNT(*) as TotalRatings FROM rating WHERE EventID IN (SELECT EventID FROM culturalevent WHERE OrganizerID = ?)";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalRatings'];
    }

    public function getTotalRevenue($organizerID)
    {
        $sql = "SELECT SUM(Amount) as TotalRevenue 
                FROM culturaleventbooking ceb
                JOIN culturalevent ce ON ceb.EventID = ce.EventID
                WHERE ce.OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalRevenue'];
    }

    public function getTotalCustomers($organizerID)
    {
        $sql = "SELECT COUNT(DISTINCT CustomerID) as TotalCustomers FROM booking WHERE EventID IN (SELECT EventID FROM culturalevent WHERE OrganizerID = ?)";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalCustomers'];
    }

    public function getTotalFeedbacks($organizerID)
    {
        $sql = "SELECT COUNT(*) as TotalFeedbacks FROM feedback WHERE EventID IN (SELECT EventID FROM culturalevent WHERE OrganizerID = ?)";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalFeedbacks'];
    }

    public function getAllServiceProviders($type)
    {
        $query = "";
        switch ($type) {
            case 'Hotel':
                $query = "SELECT h.HotelID as ID, h.Name, h.Address, h.ContactNo as Phone, h.Email, h.Website, h.Description 
                         FROM hotel h";
                break;
            case 'Restaurant':
                $query = "SELECT r.RestaurantID as ID, r.Name, r.Address, r.ContactNo as Phone, r.Email, '' as Website, r.Description 
                         FROM restaurant r";
                break;
            case 'CulturalEvent':
                $query = "SELECT c.OrganizerID as ID, c.Name, c.Address, c.ContactNo as Phone, c.Email, '' as Website, '' as Description 
                         FROM culturaleventorganizer c 
                         WHERE c.OrganizerID != ?";
                break;
            case 'HeritageMarket':
                $query = "SELECT h.ShopID as ID, h.Name, h.Address, h.ContactNo as Phone, h.Email, '' as Website, h.Description 
                         FROM heritagemarket h";
                break;
        }

        if (!empty($query)) {
            $stmt = $this->conn->prepare($query);
            
            if (!$stmt) {
                error_log("SQL Error in getAllServiceProviders: " . $this->conn->error . " for query: " . $query);
                return [];
            }
            
            // Only bind session organizer ID for cultural event query to exclude current organizer
            if ($type == 'CulturalEvent') {
                $stmt->bind_param("i", $_SESSION['OrganizerID']);
            }
            
            $result = $stmt->execute();
            if (!$result) {
                error_log("SQL Execute Error: " . $stmt->error);
                return [];
            }
            
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }
        
        return [];
    }

    /**
     * Create a new package
     */
    public function createPackage($name, $description, $discount, $startDate, $endDate, $imgPath, $owner, $hotelId, $restaurantId, $shopId, $eventId)
    {
        $sql = "INSERT INTO Package (Name, Description, Discount, StartDate, EndDate, ImgPath, Owner, HotelID, RestaurantID, ShopID, EventID) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in createPackage: " . $this->conn->error);
            return false;
        }
        
        $stmt->bind_param("ssdssssiiii", $name, $description, $discount, $startDate, $endDate, $imgPath, $owner, $hotelId, $restaurantId, $shopId, $eventId);
        
        // Add error logging to diagnose issues
        if (!$stmt->execute()) {
            error_log("SQL Execute Error in createPackage: " . $stmt->error);
            return false;
        }
        
        return true;
    }

    /**
     * Upload package image and return the path
     */
    public function uploadPackageImage($file) 
    {
        // Get temp image path
        $tempImgPath = $file['tmp_name'];
        
        if (empty($tempImgPath)) {
            return null;
        }

        // Get the file name (original file name from the upload)
        $originalFileName = $file['name'];

        // Get the file extension
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = 'package_' . uniqid() . '.' . $extension;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/package/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/package/' . $newFileName;

        return $moving ? $imgPath : null;
    }

    /**
     * Get all packages created by a specific cultural event organizer
     */
    public function getPackages($organizerId)
    {
        $sql = "SELECT p.*, 
                COALESCE(h.Name, r.Name, hm.Name, c.Name) as PartnerName 
                FROM Package p 
                LEFT JOIN Hotel h ON p.HotelID = h.HotelID 
                LEFT JOIN Restaurant r ON p.RestaurantID = r.RestaurantID 
                LEFT JOIN HeritageMarket hm ON p.ShopID = hm.ShopID 
                LEFT JOIN CulturalEventOrganizer c ON p.EventID = c.OrganizerID 
                WHERE 
                    (p.Owner = 'culturaleventorganizer' AND p.EventID = ?)
                ORDER BY p.StartDate DESC";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getPackages: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $organizerId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get a single package by ID
     */
    public function getPackage($packageId)
    {
        $sql = "SELECT p.*, 
                COALESCE(h.Name, r.Name, hm.Name, c.Name) as PartnerName 
                FROM Package p 
                LEFT JOIN Hotel h ON p.HotelID = h.HotelID 
                LEFT JOIN Restaurant r ON p.RestaurantID = r.RestaurantID 
                LEFT JOIN HeritageMarket hm ON p.ShopID = hm.ShopID 
                LEFT JOIN CulturalEventOrganizer c ON p.EventID = c.OrganizerID 
                WHERE p.PackageID = ?";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getPackage: " . $this->conn->error);
            return null;
        }
        
        $stmt->bind_param("i", $packageId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }

    /**
     * Delete a package by ID
     */
    public function deletePackage($packageId, $organizerId)
    {
        // Before deleting the package, delete related records from PackageCustomer
        $sql = "DELETE FROM PackageCustomer WHERE PackageID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $packageId);
            $stmt->execute();
        }
        
        // Now delete the package directly
        $sql = "DELETE FROM Package WHERE PackageID = ?";
        $stmt = $this->conn->prepare($sql);
        
        if (!$stmt) {
            error_log("SQL Error in deletePackage: " . $this->conn->error);
            return false;
        }
        
        $stmt->bind_param("i", $packageId);
        return $stmt->execute();
    }

    /**
     * Get all travelers who have used a specific package
     */
    public function getPackageUsers($packageId)
    {
        $sql = "SELECT pc.*, t.TravelerID, t.FirstName, t.LastName, t.Email, t.ContactNo, t.ImgPath 
                FROM PackageCustomer pc 
                JOIN Traveler t ON pc.TravelerID = t.TravelerID 
                WHERE pc.PackageID = ?
                ORDER BY t.FirstName";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getPackageUsers: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $packageId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Get all users across all packages for this organizer
     */
    public function getAllPackageUsers($organizerId)
    {
        $sql = "SELECT pc.*, t.TravelerID, t.FirstName, t.LastName, t.Email, t.ContactNo, t.ImgPath, p.Name as PackageName
                FROM PackageCustomer pc 
                JOIN Traveler t ON pc.TravelerID = t.TravelerID 
                JOIN Package p ON pc.PackageID = p.PackageID
                WHERE p.EventID = ? OR (p.Owner != 'culturaleventorganizer' AND (
                    p.HotelID IS NOT NULL OR 
                    p.RestaurantID IS NOT NULL OR 
                    p.ShopID IS NOT NULL
                ))
                ORDER BY p.Name, t.FirstName";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getAllPackageUsers: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $organizerId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getReviews($organizerID)
    {
        $sql = "SELECT f.*, t.FirstName, t.LastName 
                FROM culturaleventorganizerfeedback f
                JOIN traveler t ON f.TravelerID = t.TravelerID
                WHERE f.OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addReviewResponse($reviewID, $response)
    {
        $sql = "UPDATE culturaleventorganizerfeedback SET Response = ? WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $response, $reviewID);
        return $stmt->execute();
    }
}
