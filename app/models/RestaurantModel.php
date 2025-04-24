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

    
    public function getPostItem($postID)
    {
        $sql = "SELECT * FROM restaurantpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();

    }

    public function deletePost($postID)
    {
        $sql = "DELETE FROM restaurantpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
    }

    public function updatePost($title, $description,$postID)
    {
        $query = "UPDATE restaurantpost SET title = ?, description = ? WHERE PostID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $title, $description, $postID);
        $stmt->execute();
        $stmt->close();
    }

    public function setPostImgPath($PostID, $fileName)
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
        $targetDir = __DIR__ . '/../../public/images/database/post/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/post/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE restaurantpost SET ImgPath = ? WHERE PostID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $PostID);
            $stmt->execute();
        }
    }

    public function getPostImgPath($PostID)
    {
        $sql = "SELECT ImgPath FROM restaurantpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $PostID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['ImgPath'];
    }


    //bookings
    public function saveBooking($name,$email,$date_booking, $time_booking, $no_people,$special_request, $restaurantID, $travelerID)
    {
        $sql = "INSERT INTO tablebooking (Name, Email, BookingDate, BookingTime, NoOfGuests, SpecialRequest, RestaurantID, TravelerID) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssisii', $name,$email,$date_booking, $time_booking, $no_people,$special_request, $restaurantID, $travelerID);
        $stmt->execute();

        $sql = "SELECT BookingID FROM tablebooking WHERE TravelerID = ? AND RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $travelerID ,$restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $feedbackID = $result->fetch_assoc()['FeedbackID'];
        
        return $feedbackID;

    }

    public function getBookings($restaurantID)
    {
        $sql = "SELECT * FROM tablebooking WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

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
    

   

  

    public function getTotalBookings($restaurantId) {
        $sql = "SELECT COUNT(*) AS totalBookings 
                FROM tablebooking WHERE RestaurantID = ?";
        
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $restaurantId);
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

    public function getTotalMenus($restaurantId) {
        $sql = "SELECT COUNT(*) AS totalMenus 
                FROM menu 
                WHERE RestaurantID = ?";
        
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $restaurantId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalMenus'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalReviews($restaurantId) {
        $sql = "SELECT COUNT(*) AS totalReviews
                FROM restaurantfeedback 
                WHERE RestaurantID = ?";
        
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $restaurantId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalReviews'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
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

    // public function getTotalRatings($restaurantId) {
    //     $sql = "SELECT COUNT(*) AS totalRatings 
    //             FROM restaurantfeedback rf
    //             JOIN Room r ON hf.RestaurantID = r.RoomID
    //             WHERE r.RestaurantID = ?";
        
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

    public function getTotalPosts($restaurantId) {
        $sql = "SELECT COUNT(*) AS totalPosts 
                FROM restaurantpost  
                WHERE RestaurantID = ?";
        
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $restaurantId);
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

   
}