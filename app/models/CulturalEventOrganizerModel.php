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

    public function getEvent($eventID)
    {
        $sql = "SELECT * FROM culturalevent WHERE EventID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $eventID);
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
        $stmt->bind_param('ssisssssi', $name, $email, $contactNo, $description, 
                          $facebookLink, $instagramLink, $tiktokLink, $youtubeLink, $OrganizerID);
        $stmt->execute();
        
        return $stmt->affected_rows > 0;
    }
    
    public function setImgPath($OrganizerID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];
        
        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $OrganizerID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/culturaleventorganizer/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/culturaleventorganizer/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE traveler SET ImgPath = ? WHERE TravelerID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $OrganizerID);
            $stmt->execute();
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

    public function deleteEvent($eventID)
    {
        $sql = "DELETE FROM culturalevent WHERE EventID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $eventID);
        $stmt->execute();
    }

    public function addPost($title, $description, $organizerID)
    {
        $sql = "INSERT INTO culturaleventorganizerpost (`Title`, `Description`, `OrganizerID`) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $title, $description, $organizerID);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function getPost($organizerID)
    {
        $sql = "SELECT * FROM culturaleventorganizerpost WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
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
        $sql = "SELECT COUNT(*) as TotalBookings FROM booking WHERE EventID IN (SELECT EventID FROM culturalevent WHERE OrganizerID = ?)";
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
        $sql = "SELECT SUM(TotalPrice) as TotalRevenue FROM booking WHERE EventID IN (SELECT EventID FROM culturalevent WHERE OrganizerID = ?)";
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

    public function setEventImage($eventID, $fileName)
    {
        try {
            // Log the start of image upload process
            error_log("Starting to set image for event ID: $eventID");
            
            // Get temp image path
            $tempImgPath = $fileName['tmp_name'];
            
            // Get the file name (original file name from the upload)
            $originalFileName = $fileName['name'];
    
            // Get the file extension
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);
    
            // Create a new file name
            $newFileName = 'event_' . $eventID . '.' . $extension;
    
            // Define the target directory
            $targetDir = __DIR__ . '/../../public/images/database/culturalevent/';
    
            // Check the directory exists and create it
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
                error_log("Created directory: $targetDir");
            }
    
            // Create the image path
            $imgDir = $targetDir . $newFileName;
    
            // Move the image to the target directory
            $moving = move_uploaded_file($tempImgPath, $imgDir);
    
            // Define the image path
            $imgPath = '/ExploreEase/public/images/database/culturalevent/' . $newFileName;
    
            // Enter the image path to the database
            if ($moving) {
                error_log("Image moved successfully to: $imgDir");
                
                // Verify table structure
                $checkSql = "SHOW COLUMNS FROM culturalevent LIKE 'ImgPath'";
                $checkResult = $this->conn->query($checkSql);
                
                if ($checkResult->num_rows == 0) {
                    error_log("ImgPath column does not exist in culturalevent table");
                    // Add the column if it doesn't exist
                    $alterSql = "ALTER TABLE culturalevent ADD COLUMN ImgPath VARCHAR(255)";
                    $this->conn->query($alterSql);
                    error_log("Added ImgPath column to culturalevent table");
                }
                
                $sql = "UPDATE culturalevent SET ImgPath = ? WHERE EventID = ?";
                error_log("SQL query: $sql with params: $imgPath, $eventID");
                
                $stmt = $this->conn->prepare($sql);
                
                if (!$stmt) {
                    error_log("Prepare failed: " . $this->conn->error);
                    return false;
                }
                
                $stmt->bind_param('si', $imgPath, $eventID);
                $result = $stmt->execute();
                
                if (!$result) {
                    error_log("Execute failed: " . $stmt->error);
                    return false;
                }
                
                return true;
            } else {
                error_log("Failed to move uploaded file");
                return false;
            }
        } catch (\Exception $e) {
            error_log("Exception in setEventImage: " . $e->getMessage());
            return false;
        }
    }
}