<?php

namespace app\Models;

class RestaurantModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }


    public function updateRestaurant($restaurantID, $name, $address, $contactNo, $email, $website, $weekdaysOpenHours, $weekendsOpenHours, $cuisineType, $description, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink, $tagline, $menuPDFPath)
    {
        $sql = "UPDATE restaurant SET Name = ?, Address = ?, ContactNo = ?, Email = ?, Website = ?, WeekdayOpenHours = ?, WeekendOpenHours = ?, CuisineType = ?, Description = ?, FacebookLink = ?, InstagramLink = ?, TikTokLink = ?, YouTubeLink = ?, Tagline = ?, MenuPDF = ? WHERE RestaurantID = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param('sssssssssssssssi', $name, $address, $contactNo, $email, $website, $weekdaysOpenHours, $weekendsOpenHours, $cuisineType, $description, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink, $tagline, $menuPDFPath, $restaurantID);
        $result = $stmt->execute();

        return $result;
    }

    // Add new method to handle PDF uploads
    public function setMenuPDFPath($restaurantID, $fileData)
    {
        // Get temp file path
        $tempFilePath = $fileData['tmp_name'];

        // Get original filename
        $originalFileName = $fileData['name'];

        // Get file extension
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Only allow PDF files
        if (strtolower($extension) != 'pdf') {
            return false;
        }

        // Create new filename with restaurant ID
        $newFileName = 'menu_' . $restaurantID . '_' . time() . '.' . $extension;

        // Define target directory
        $targetDir = __DIR__ . '/../../public/files/menu/';

        // Create directory if it doesn't exist
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Define target path
        $targetPath = $targetDir . $newFileName;

        // Move the uploaded file
        if (move_uploaded_file($tempFilePath, $targetPath)) {
            // Return the relative path to be stored in the database
            return '/ExploreEase/public/files/menu/' . $newFileName;
        }

        return false;
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

    public function updateMenu($name, $price, $category,  $popularDish, $menuID)
    {
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
        $stmt->bind_param('ssi', $title, $description, $restaurantID);
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

    public function updatePost($title, $description, $postID)
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
    public function saveBooking($name, $email, $date_booking, $time_booking, $no_people, $special_request, $restaurantID, $travelerID)
    {
        $sql = "INSERT INTO tablebooking (Name, Email, BookingDate, BookingTime, NoOfGuests, SpecialRequest, RestaurantID, TravelerID) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssisii', $name, $email, $date_booking, $time_booking, $no_people, $special_request, $restaurantID, $travelerID);
        $stmt->execute();

        $sql = "SELECT BookingID FROM tablebooking WHERE TravelerID = ? AND RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $travelerID, $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $feedbackID = $result->fetch_assoc()['FeedbackID'];

        return $feedbackID;
    }

    public function getBookings($restaurantID)
    {
        $sql = "SELECT * FROM tablebooking WHERE RestaurantID = ? AND TableNumber IS NOT NULL AND TableNumber != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateTableNo($bookingID, $tableNo)
    {
        $sql = "UPDATE tablebooking SET TableNumber = ? WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $tableNo, $bookingID);
        $stmt->execute();
    }


    //reviews
    public function addReview($restaurantID, $travelerID, $rating, $review, $date)
    {
        $sql = "INSERT INTO restaurantfeedback (RestaurantID, TravelerID, Rating, Comment, Date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiiss', $restaurantID, $travelerID, $rating, $review, $date);
        $stmt->execute();
    }

    public function getReview($restaurantID)
    {
        $sql = " SELECT rf.* , t.FirstName, t.LastName, t.ImgPath FROM restaurantfeedback rf
                INNER JOIN traveler t ON rf.TravelerID = t.TravelerID
                WHERE rf.RestaurantID = ?
                ORDER BY rf.Response IS NULL DESC, rf.Date DESC";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param('i', $restaurantID);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $result = $stmt->get_result();

        if (!$result) {
            die("Get result failed: " . $stmt->error);
        }

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function replyReview($reviewID, $reply)
    {
        $sql = "UPDATE restaurantfeedback SET Response = ? WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $reply, $reviewID);
        $stmt->execute();
    }


    public function getReviewItem($reviewID)
    {
        $sql = "SELECT * FROM restaurantfeedback WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $reviewID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    //images 

    public function addImage($title, $restaurantID)
    {
        $sql = "INSERT INTO restaurantimages (Title,  RestaurantID) VALUES ( ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $title, $restaurantID);
        $stmt->execute();

        // Get the ImageID
        $sql = "SELECT ImageID FROM restaurantimages WHERE Title = ? AND RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $title, $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $ImageID = $result->fetch_assoc()['ImageID'];

        return $ImageID;
    }



    public function getImage($restaurantID)
    {
        $sql = "SELECT * FROM restaurantimages WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


    public function getImageItem($imageID)
    {
        $sql = "SELECT * FROM restaurantimages WHERE ImageID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $imageID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function deleteImage($imageID)
    {
        $sql = "DELETE FROM restaurantimages WHERE ImageID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $imageID);
        $stmt->execute();
    }


    public function setRestImgPath($imageID, $fileName)
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
        $targetDir = __DIR__ . '/../../public/images/database/restaurant_images/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/restaurant_images/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE restaurantimages SET ImgPath = ? WHERE ImageID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $imageID);
            $stmt->execute();
        }
    }

    public function getRestImgPath($imageID)
    {
        $sql = "SELECT ImgPath FROM restaurantimages WHERE ImageID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $imageID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['ImgPath'];
    }





    public function getTotalBookings($restaurantId)
    {
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

    public function getTotalMenus($restaurantId)
    {
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

    public function getTotalReviews($restaurantId)
    {
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

    public function getAverageRating($restaurantID)
    {
        $sql = "SELECT AVG(Rating) AS average FROM restaurantfeedback WHERE RestaurantID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $restaurantID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return (float)$row['average'];
        } else {
            return 0.0;
        }
    }

<<<<<<< HEAD
    /**
     * Get all service providers by type
     * 
     * @param string $type Type of service provider
     * @return array Array of service providers
     */
    public function getAllServiceProviders($type)
    {
        $query = "";
        switch ($type) {
            case 'Hotel':
                $query = "SELECT h.HotelID as ID, h.Name, h.Address, h.ContactNo as Phone, h.Email, h.Website, h.Description 
                         FROM hotel h";
                break;
            case 'Restaurant':
                $query = "SELECT r.RestaurantID as ID, r.Name, r.Address, r.ContactNo as Phone, r.Email, r.Website, r.Description 
                         FROM restaurant r 
                         WHERE r.RestaurantID != ?";
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
            
            // Only bind session restaurant ID for restaurant query to exclude current restaurant
            if ($type == 'Restaurant') {
                $stmt->bind_param("i", $_SESSION['RestaurantID']);
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
=======
    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $restaurantId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalReviews'];
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

    // public function getTotalPosts($restaurantId)
    // {
    //     $sql = "SELECT COUNT(*) AS totalPosts 
    //             FROM restaurantpost  
    //             WHERE RestaurantID = ?";

    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $restaurantId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalPosts'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }
>>>>>>> cc271b72a003c69515347da7af55f09154ca5813

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
     * Get all packages created by a specific restaurant
     */
    public function getPackages($restaurantId)
    {
        $sql = "SELECT p.*, 
                COALESCE(h.Name, r.Name, hm.Name, c.Name) as PartnerName 
                FROM Package p 
                LEFT JOIN Hotel h ON p.HotelID = h.HotelID 
                LEFT JOIN Restaurant r ON p.RestaurantID = r.RestaurantID 
                LEFT JOIN HeritageMarket hm ON p.ShopID = hm.ShopID 
                LEFT JOIN CulturalEventOrganizer c ON p.EventID = c.OrganizerID 
                WHERE 
                    (p.Owner = 'restaurant' AND p.RestaurantID = ?)
                ORDER BY p.StartDate DESC";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getPackages: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $restaurantId);
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
    public function deletePackage($packageId, $restaurantId)
    {
        // Before deleting the package, delete related records from PackageCustomer
        $sql = "DELETE FROM PackageCustomer WHERE PackageID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $packageId);
            $stmt->execute();
        }
        
        // Now delete the package
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
     * Get all users across all packages for this restaurant
     */
    public function getAllPackageUsers($restaurantId)
    {
        $sql = "SELECT pc.*, t.TravelerID, t.FirstName, t.LastName, t.Email, t.ContactNo, t.ImgPath, p.Name as PackageName
                FROM PackageCustomer pc 
                JOIN Traveler t ON pc.TravelerID = t.TravelerID 
                JOIN Package p ON pc.PackageID = p.PackageID
                WHERE p.RestaurantID = ? OR (p.Owner != 'restaurant' AND (
                    p.HotelID IS NOT NULL OR 
                    p.ShopID IS NOT NULL OR 
                    p.EventID IS NOT NULL
                ))
                ORDER BY p.Name, t.FirstName";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getAllPackageUsers: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $restaurantId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPopularDishes($restaurantId)
    {
        $sql = "SELECT * FROM menu WHERE RestaurantID = ? AND IsPopular = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $restaurantId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
