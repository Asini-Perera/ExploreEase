<?php

namespace app\Models;

class HotelModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getRoom($hotelID, $roomID = null)
    {
        $sql = "SELECT * FROM room WHERE HotelID = ?";
        if ($roomID) {
            $sql .= " AND RoomID = ?";
        }
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new \Exception("SQL error: " . $this->conn->error);
        }
        if ($roomID) {
            $stmt->bind_param('ii', $hotelID, $roomID);
        } else {
            $stmt->bind_param('i', $hotelID);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $roomID ? $result->fetch_assoc() : $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addRoom($room_type, $price, $capacity, $description, $hotelID)
    {
        $sql = "INSERT INTO room (Type,Price, MaxOccupancy, Description, HotelID) VALUES (?, ?, ?, ?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdisi', $room_type, $price, $capacity, $description, $hotelID);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function setImgPath($RoomID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $RoomID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/room/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/room/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE room SET ImgPath = ? WHERE RoomID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $RoomID);
            $stmt->execute();
        }
    }

    public function deleteRoom($roomID)
    {
        $sql = "DELETE FROM room WHERE RoomID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $roomID);
        $stmt->execute();
    }

    //update profile
    public function updateHotel($hotelID, $email, $name, $address, $contactNo, $description, $website, $tagline, $facebook_link, $instagram_link, $tiktok_link, $youtube_link)
    {
        $sql = "UPDATE hotel SET Email = ?, Name = ?, Address = ?, ContactNo = ?, Description = ?, Website = ?, Tagline = ?, FacebookLink = ?, InstagramLink = ?, TikTokLink = ?, YoutubeLink = ? WHERE HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssssssssi', $email, $name, $address, $contactNo, $description, $website, $tagline, $facebook_link, $instagram_link, $tiktok_link, $youtube_link, $hotelID);
        $result = $stmt->execute();
        return $result; // Return true on success, false on failure
    }

    public function checkCurrentPassword($hotelID, $currentPassword)
    {
        $sql = "SELECT * FROM hotel WHERE HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashedPassword = $result->fetch_assoc()['Password'];

        return password_verify($currentPassword, $hashedPassword);
    }

    public function changePassword($hotelID, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE hotel SET Password = ? WHERE HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $newPassword, $hotelID);
        $stmt->execute();
    }

    public function getReviewsByFeedbackID($hotelID)
    {
        $sql = "SELECT * FROM hotelfeedback WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTravelerById($travelerId)
    {
        $sql = "SELECT * FROM traveler WHERE TravelerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $travelerId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getBookings($hotelID)
    {
        $sql = "SELECT rb.*, t.FirstName, t.LastName 
                FROM roombooking rb
                JOIN room r ON rb.RoomID = r.RoomID
                LEFT JOIN traveler t ON rb.TravelerID = t.TravelerID
                WHERE r.HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function setImagePath($PostID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $PostID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/hotel_post/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/hotel_post/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE hotelpost SET ImgPath = ? WHERE PostID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $PostID);
            $stmt->execute();
        }
    }

    public function getPost($hotelID, $postID = null)
    {
        $sql = "SELECT * FROM hotelpost WHERE HotelID = ?";
        if ($postID) {
            $sql .= " AND PostID = ?";
        }
        $stmt = $this->conn->prepare($sql);
        if ($postID) {
            $stmt->bind_param('ii', $hotelID, $postID);
        } else {
            $stmt->bind_param('i', $hotelID);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $postID ? $result->fetch_assoc() : $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalBookings($hotelId)
    {
        $sql = "SELECT COUNT(*) AS totalBookings 
                FROM RoomBooking rb
                JOIN Room r ON rb.RoomID = r.RoomID
                WHERE r.HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalBookings'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalRooms($hotelId)
    {
        $sql = "SELECT COUNT(*) AS totalRooms 
                FROM Room 
                WHERE HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalRooms'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

     //images 

     public function addImage($title ,$hotelID)
     {
         $sql = "INSERT INTO hotelimages (Title,  HotelID) VALUES ( ?, ?)";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('si',$title , $hotelID);
         $stmt->execute();
         
         // Get the ImageID
         $sql = "SELECT ImageID FROM hotelimages WHERE Title = ? AND HotelID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('si', $title, $hotelID);
         $stmt->execute();
         $result = $stmt->get_result();
         $ImageID = $result->fetch_assoc()['ImageID'];
         
         return $ImageID;
     }
  
 
     
     public function getImage($hotelID)
     {
         $sql = "SELECT * FROM hotelimages WHERE HotelID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('i', $hotelID);
         $stmt->execute();
         $result = $stmt->get_result();
 
         return $result->fetch_all(MYSQLI_ASSOC);
     }
 
     
     public function getImageItem($imageID)
     {
         $sql = "SELECT * FROM hotelimages WHERE ImageID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('i', $imageID);
         $stmt->execute();
         $result = $stmt->get_result();
 
         return $result->fetch_assoc();
 
     }
 
     public function deleteImage($imageID)
     {
         $sql = "DELETE FROM hotelimages WHERE ImageID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('i', $imageID);
         $stmt->execute();
     }
 
 
     public function setHotelImgPath($imageID, $fileName)
     {
         // Get temp image path
         $tempImgPath = $fileName['tmp_name'];
 
         // Get the file name (original file name from the upload)
         $originalFileName = $fileName['name'];
 
         // Get the file extention
         $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);
 
         // Create a new file name
         $newFileName = $imageID . '.' . $extention;
 
         // Define the target directory
         $targetDir = __DIR__ . '/../../public/images/database/hotel_images/';
 
         // Check the directory exists and create it
         if (!is_dir($targetDir)) {
             mkdir($targetDir, 0777, false);
         }
 
         // Create the image path
         $imgDir = $targetDir . $newFileName;
 
         // Move the image to the target directory
         $moving = move_uploaded_file($tempImgPath, $imgDir);
 
         // Define the image path
         $imgPath = '/ExploreEase/public/images/database/hotel_images/' . $newFileName;
 
         // Enter the image path to the database
         if ($moving) {
             $sql = "UPDATE hotelimages SET ImgPath = ? WHERE ImageID = ?";
             $stmt = $this->conn->prepare($sql);
             $stmt->bind_param('si', $imgPath, $imageID);
             $stmt->execute();
         }
     }
 
     public function getHotelImgPath($imageID)
     {
         $sql = "SELECT ImgPath FROM hotelimages WHERE ImageID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('i', $imageID);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_assoc()['ImgPath'];
     }
   
 
 
 
 

    // public function getTotalRevenue($hotelId) {
    //     $sql = "SELECT SUM(rb.TotalPrice) AS totalRevenue 
    //             FROM RoomBooking rb
    //             JOIN Room r ON rb.RoomID = r.RoomID
    //             WHERE r.HotelID = ?";

    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $hotelId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalRevenue'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }

    // public function getTotalRevenueInLastWeek($hotelId) {
    //     $sql = "SELECT SUM(rb.TotalPrice) AS totalRevenueLastWeek 
    //             FROM RoomBooking rb
    //             JOIN Room r ON rb.RoomID = r.RoomID
    //             WHERE r.HotelID = ? AND rb.BookingDate >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";

    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $hotelId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalRevenueLastWeek'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }

    
    public function getTotalCustomers($hotelID)
    {
        $sql = "SELECT COUNT(DISTINCT rb.TravelerID) AS totalCustomers 
                FROM roombooking rb
                JOIN room r ON rb.RoomID = r.RoomID
                WHERE r.HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalCustomers'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalPosts($hotelId)
    {
        $sql = "SELECT COUNT(*) AS totalPosts 
                FROM HotelPost 
                WHERE HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalPosts'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalRatings($hotelId)
    {
        $sql = "SELECT COALESCE(AVG(hf.Rating), 0) AS totalRating 
            FROM HotelFeedback hf
            WHERE HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                $totalRating = $result->fetch_assoc()['totalRating'];
                return $totalRating ? (int)$totalRating : 0;
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalFeedbacks($hotelId)
    {
        $sql = "SELECT COUNT(*) AS totalFeedbacks 
                FROM HotelFeedback
                WHERE HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalFeedbacks'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function updateRoom($roomID, $room_type, $price, $capacity, $description)
    {
        $sql = "UPDATE room SET Type = ?, Price = ?, MaxOccupancy = ?, Description = ? WHERE RoomID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdisi', $room_type, $price, $capacity, $description, $roomID);
        $stmt->execute();
    }

    public function getRoomImage($roomID)
    {
        $sql = "SELECT ImgPath FROM room WHERE RoomID = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('i', $roomID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['ImgPath'];
        }

        return null;
    }

    public function addPost($title, $description, $hotelID)
    {
        $sql = "INSERT INTO hotelpost (Title, Description, HotelID) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $title, $description, $hotelID);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function getPostImage($postID)
    {
        $sql = "SELECT ImgPath FROM hotelpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['ImgPath'];
        }

        return null;
    }

    public function deletePost($postID)
    {
        $sql = "DELETE FROM hotelpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
    }

    public function updatePost($postID, $title, $description)
    {
        $sql = "UPDATE hotelpost SET Title = ?, Description = ? WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $title, $description, $postID);
        $stmt->execute();
    }

    public function getPostById($postID)
    {
        $sql = "SELECT * FROM hotelpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getBookingsById($bookingID)
    {
        $sql = "SELECT * FROM roombooking WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $bookingID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function updateBooking($bookingID, $checkInDate, $checkOutDate, $date, $status, $roomID)
    {
        $sql = "UPDATE roombooking SET CheckInDate = ?, CheckOutDate = ?, Date = ?, Status = ?, RoomID = ? WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssii', $checkInDate, $checkOutDate, $date, $status, $roomID, $bookingID);
        $stmt->execute();
    }

    public function deleteBooking($bookingID)
    {
        $sql = "DELETE FROM roombooking WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $bookingID);
        $stmt->execute();
    }

    public function getBookingById($bookingID)
    {
        $sql = "SELECT * FROM roombooking WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $bookingID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getReviews($hotelID)
    {
        $sql = "SELECT hf.*, t.FirstName, t.LastName, t.ImgPath 
                FROM hotelfeedback hf
                INNER JOIN traveler t ON hf.TravelerID = t.TravelerID
                WHERE hf.HotelID = ?
                ORDER BY hf.Response IS NULL DESC, hf.Date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateReviewResponse($reviewID, $response)
    {
        $sql = "UPDATE hotelfeedback SET Response = ? WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('si', $response, $reviewID);
            return $stmt->execute();
        }
        return false;
    }

    public function getReviewById($feedbackID)
    {
        $sql = "SELECT * FROM hotelfeedback WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $feedbackID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function addReview($hotelID, $travelerID, $rating, $review, $date)
    {
        $sql = "INSERT INTO hotelfeedback (HotelID, TravelerID, Rating, Comment, Date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiiss', $hotelID, $travelerID, $rating, $review, $date);
        return $stmt->execute();
    }


    public function getAllServiceProviders($type)
    {
        $query = "";
        switch ($type) {
            case 'Hotel':
                $query = "SELECT h.HotelID, h.Name as HotelName, h.Address, h.ContactNo as Phone, h.Email, h.Website, h.Description 
                         FROM hotel h 
                         WHERE h.HotelID != ?";
                break;
            case 'Restaurant':
                $query = "SELECT r.RestaurantID as ID, r.Name, r.Address, r.ContactNo as Phone, r.Email, '' as Website, r.Description 
                         FROM restaurant r";
                break;
            case 'CulturalEvent':
                $query = "SELECT c.OrganizerID as ID, c.Name, c.Address, c.ContactNo as Phone, c.Email, '' as Website, '' as Description 
                         FROM culturaleventorganizer c";
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
            
            // Only bind session hotel ID for hotel query to exclude current hotel
            if ($type == 'Hotel') {
                $stmt->bind_param("i", $_SESSION['HotelID']);
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
     * Get all packages created by a specific hotel
     */
    public function getPackages($hotelId)
    {
        $sql = "SELECT p.*, 
                COALESCE(h.Name, r.Name, hm.Name, c.Name) as PartnerName 
                FROM Package p 
                LEFT JOIN Hotel h ON p.HotelID = h.HotelID 
                LEFT JOIN Restaurant r ON p.RestaurantID = r.RestaurantID 
                LEFT JOIN HeritageMarket hm ON p.ShopID = hm.ShopID 
                LEFT JOIN CulturalEventOrganizer c ON p.EventID = c.OrganizerID 
                WHERE 
                    (p.Owner = 'hotel' AND p.HotelID = ?)
                ORDER BY p.StartDate DESC";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getPackages: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $hotelId);
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
    public function deletePackage($packageId, $hotelId)
    {
        // Before deleting the package, delete related records from PackageCustomer
        $sql = "DELETE FROM PackageCustomer WHERE PackageID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $packageId);
            $stmt->execute();
        }
        
        // Now delete the package directly without authorization checks
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
     * Get all users across all packages for this hotel
     */
    public function getAllPackageUsers($hotelId)
    {
        $sql = "SELECT pc.*, t.TravelerID, t.FirstName, t.LastName, t.Email, t.ContactNo, t.ImgPath, p.Name as PackageName
                FROM PackageCustomer pc 
                JOIN Traveler t ON pc.TravelerID = t.TravelerID 
                JOIN Package p ON pc.PackageID = p.PackageID
                WHERE p.HotelID = ? OR (p.Owner != 'hotel' AND (
                    p.RestaurantID IS NOT NULL OR 
                    p.ShopID IS NOT NULL OR 
                    p.EventID IS NOT NULL
                ))
                ORDER BY p.Name, t.FirstName";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getAllPackageUsers: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $hotelId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);

    public function getAvailableRooms($hotelID, $checkInDate, $checkOutDate, $guests)
    {
        $sql = "SELECT r.*, rb.*, r.RoomID AS RoomID, 
                       DATEDIFF(?, ?) * r.Price AS TotalPrice, 
                       ? AS CheckInDate, 
                       ? AS CheckOutDate
                FROM room r
                LEFT JOIN roombooking rb ON r.RoomID = rb.RoomID 
                    AND ((rb.CheckInDate <= ? AND rb.CheckOutDate >= ?) OR (rb.CheckInDate <= ? AND rb.CheckOutDate >= ?))
                WHERE r.HotelID = ? AND r.MaxOccupancy >= ? AND rb.BookingID IS NULL";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssssii', $checkOutDate, $checkInDate, $checkInDate, $checkOutDate, $checkInDate, $checkInDate, $checkOutDate, $checkOutDate, $hotelID, $guests);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function bookRoom($roomID, $travelerID, $checkInDate, $checkOutDate, $date)
    {
        $sql = "INSERT INTO roombooking (RoomID, TravelerID, CheckInDate, CheckOutDate, Date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iisss', $roomID, $travelerID, $checkInDate, $checkOutDate, $date);
        return $stmt->execute();

    }
}
