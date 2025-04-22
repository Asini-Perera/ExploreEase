<?php

namespace app\Models;

class RestaurantModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function updateRestaurant($restaurantID, $name, $address, $contactNo, $email, $website, $openHours, $cuisineType, $description, $socialMediaLinks, $menupdf)
    {
        $sql = "UPDATE restaurant SET Name = ?, Address = ?, ContactNo = ?, Email = ?, Website = ?, OpenHours = ?, CuisineType = ?, Description = ?, SMLink = ?, MenuPDF = ? WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param('ssssssssssi', $name, $address, $contactNo, $email, $website, $openHours, $cuisineType, $description, $socialMediaLinks, $menupdf, $restaurantID);
        $result = $stmt->execute();

        return $result;
    }

    public function checkCurrentPassword($restaurantID, $currentPassword)
    {
        $sql = "SELECT * FROM restaurant WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashedPassword = $result->fetch_assoc()['Password'];

        return password_verify($currentPassword, $hashedPassword);
    }

    public function changePassword($restaurantID, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE restaurant SET Password = ? WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $newPassword, $restaurantID);
        $stmt->execute();
    }

    //menu

    public function addMenu($name, $price, $category, $popularDish, $restaurantID)
    {
        $sql = "INSERT INTO menu (FoodName, Price, FoodCategory, IsPopular, RestaurantID) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdsii', $name, $price, $category, $popularDish, $restaurantID);
        $stmt->execute();
        
        // Get the MenuID
        $sql = "SELECT MenuID FROM menu WHERE FoodName = ? AND RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $name, $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $MenuID = $result->fetch_assoc()['MenuID'];
        
        return $MenuID;
    }

    public function getMenu($restaurantID)
    {
        $sql = "SELECT * FROM menu WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function setImgPath($MenuID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $MenuID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/menu/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/menu/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE menu SET ImgPath = ? WHERE MenuID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $MenuID);
            $stmt->execute();
        }
    }

    public function getImgPath($MenuID)
    {
        $sql = "SELECT ImgPath FROM menu WHERE MenuID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $MenuID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['ImgPath'];
    }

    public function getMenuItem($menuID)
    {
        $sql = "SELECT * FROM menu WHERE MenuID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $menuID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();

    }

    public function updateMenu($name, $price, $category,  $popularDish, $menuID){
        $sql = "UPDATE menu SET FoodName = ?, Price = ?, FoodCategory = ?,   IsPopular = ? WHERE MenuID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sdsii", $name, $price, $category, $popularDish, $menuID);
        $stmt->execute();
    }
    public function deleteMenu($menuID)
    {
        $sql = "DELETE FROM menu WHERE MenuID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $menuID);
        $stmt->execute();
    }

    

    //posts
    public function addPost($title, $description, $restaurantID)
    {
        $sql = "INSERT INTO restaurantpost (Title, Description, RestaurantID) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi',$title, $description, $restaurantID);
        $stmt->execute();
        
        // Get the PostID
        $sql = "SELECT PostID FROM restaurantpost WHERE Title = ? AND RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $title, $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $PostID = $result->fetch_assoc()['PostID'];
        
        return $PostID;
    }

    
    public function getPost($restaurantID)
    {
        $sql = "SELECT * FROM restaurantpost WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function deletePost($postID)
    {
        $sql = "DELETE FROM restaurantpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
    }

    // public function updatePost($postID, $title, $description)
    // {
    //     $query = "UPDATE posts SET title = ?, description = ? WHERE id = ?";
    //     $stmt = $this->conn->prepare($query);
    //     $stmt->bind_param("ssi", $title, $description, $postID);
    //     $stmt->execute();
    //     $stmt->close();
    // }

    //bookings
    

    //reviews
    public function addReview($name, $email, $rating, $comment, $restaurantID, $travelerID)
    {
        $sql = "INSERT INTO restaurantfeedback (Name, Email, Rating, Comment, RestaurantID, TravelerID) VALUES (?, ?, ?, ?, ?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssdsii',$name, $email, $rating, $comment, $restaurantID,$travelerID);
        $stmt->execute();
        
        // Get the FeedbackID
        $sql = "SELECT FeedbackID FROM restaurantfeedback WHERE TravelerID = ? AND RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $travelerID ,$restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $feedbackID = $result->fetch_assoc()['FeedbackID'];
        
        return $feedbackID;
    }

    // public function getReview($restaurantID,$travelerID){
    //     $sql = "SELECT * FROM restaurantfeedback WHERE RestaurantID = ? AND TravelerID = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param('ii', $restaurantID,$travelerID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }
    public function getReview($restaurantID)
    {
        $sql = " SELECT rf.* , t.FirstName, t.LastName FROM restaurantfeedback rf
                INNER JOIN traveler t ON rf.TravelerID = t.TravelerID
                WHERE rf.RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
    
        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }
    
        $stmt->bind_param('i', $restaurantID );
    
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
    
        $result = $stmt->get_result();
    
        if (!$result) {
            die("Get result failed: " . $stmt->error);
        }
    
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    

    public function deleteReview($feedbackID)
    {
        $sql = "DELETE FROM restaurantfeedback WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $feedbackID);
        $stmt->execute();
    }

    // public function getBookings($hotelID)
    // {
    //     $sql = "SELECT rb.* FROM roombooking rb
    //             JOIN room r ON rb.RoomID = r.RoomID
    //             WHERE r.HotelID = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param('i', $hotelID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_all(MYSQLI_ASSOC);
    // }

    // public function setImagePath($PostID, $fileName)
    // {
    //     // Get temp image path
    //     $tempImgPath = $fileName['tmp_name'];

    //     // Get the file name (original file name from the upload)
    //     $originalFileName = $fileName['name'];

    //     // Get the file extention
    //     $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

    //     // Create a new file name
    //     $newFileName = $PostID . '.' . $extention;

    //     // Define the target directory
    //     $targetDir = __DIR__ . '/../../public/images/database/hotel_post/';

    //     // Check the directory exists and create it
    //     if (!is_dir($targetDir)) {
    //         mkdir($targetDir, 077, false);
    //     }

    //     // Create the image path
    //     $imgDir = $targetDir . $newFileName;

    //     // Move the image to the target directory
    //     $moving = move_uploaded_file($tempImgPath, $imgDir);

    //     // Define the image path
    //     $imgPath = '/ExploreEase/public/images/database/hotel_post/' . $newFileName;

    //     // Enter the image path to the database
    //     if ($moving) {
    //         $sql = "UPDATE hotelpost SET ImgPath = ? WHERE PostID = ?";
    //         $stmt = $this->conn->prepare($sql);
    //         $stmt->bind_param('si', $imgPath, $PostID);
    //         $stmt->execute();
    //     }
    // }

    // public function getPost($hotelID, $postID = null)
    // {
    //     $sql = "SELECT * FROM hotelpost WHERE HotelID = ?";
    //     if ($postID) {
    //         $sql .= " AND PostID = ?";
    //     }
    //     $stmt = $this->conn->prepare($sql);
    //     if ($postID) {
    //         $stmt->bind_param('ii', $hotelID, $postID);
    //     } else {
    //         $stmt->bind_param('i', $hotelID);
    //     }
    //     $stmt->execute();
    //     $result = $stmt->get_result();
        
    //     return $postID ? $result->fetch_assoc() : $result->fetch_all(MYSQLI_ASSOC);
    // }

    // public function getTotalBookings($hotelId) {
    //     $sql = "SELECT COUNT(*) AS totalBookings 
    //             FROM RoomBooking rb
    //             JOIN Room r ON rb.RoomID = r.RoomID
    //             WHERE r.HotelID = ?";
        
    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $hotelId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalBookings'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }

    // public function getTotalRooms($hotelId) {
    //     $sql = "SELECT COUNT(*) AS totalRooms 
    //             FROM Room 
    //             WHERE HotelID = ?";
        
    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $hotelId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalRooms'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }

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

    // public function getTotalRatings($hotelId) {
    //     $sql = "SELECT COUNT(*) AS totalRatings 
    //             FROM HotelFeedback hf
    //             JOIN Room r ON hf.RoomID = r.RoomID
    //             WHERE r.HotelID = ?";
        
    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $hotelId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalRatings'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }

    // public function getTotalFeedbacks($hotelId) {
    //     $sql = "SELECT COUNT(*) AS totalFeedbacks 
    //             FROM HotelFeedback hf
    //             JOIN Room r ON hf.RoomID = r.RoomID
    //             WHERE r.HotelID = ?";
        
    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $hotelId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalFeedbacks'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }

    // public function updateRoom($roomID, $room_type, $price, $capacity, $description)
    // {
    //     $sql = "UPDATE room SET Type = ?, Price = ?, MaxOccupancy = ?, Description = ? WHERE RoomID = ?";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param('sdisi', $room_type, $price, $capacity, $description, $roomID);
    //     $stmt->execute();
    // }

    // public function getRoomImage($roomID)
    // {
    //     $sql = "SELECT ImgPath FROM room WHERE RoomID = ?";
    //     $stmt = $this->conn->prepare($sql);
        
    //     if (!$stmt) {
    //         return null;
    //     }
        
    //     $stmt->bind_param('i', $roomID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
        
    //     if ($result && $result->num_rows > 0) {
    //         return $result->fetch_assoc()['ImgPath'];
    //     }
        
    //     return null;
    // }

    // public function addPost($title, $description, $hotelID)
    // {
    //     $sql = "INSERT INTO hotelpost (Title, Description, HotelID) VALUES (?, ?, ?)";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param('ssi', $title, $description, $hotelID);
    //     $stmt->execute();
        
    //     return $stmt->insert_id;
    // }

    // public function getPostImage($postID)
    // {
    //     $sql = "SELECT ImgPath FROM hotelpost WHERE PostID = ?";
    //     $stmt = $this->conn->prepare($sql);
        
    //     if (!$stmt) {
    //         return null;
    //     }
        
    //     $stmt->bind_param('i', $postID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();
        
    //     if ($result && $result->num_rows > 0) {
    //         return $result->fetch_assoc()['ImgPath'];
    //     }
        
    //     return null;
    // }

}