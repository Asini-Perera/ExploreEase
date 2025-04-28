<?php

namespace app\Models;

class HeritageMarketModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getProducts($shopID)
    {
        $sql = "SELECT * FROM product WHERE ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $shopID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addProduct($product_name, $price, $description, $shopID)
    {
        $sql = "INSERT INTO product (Name, Price, Description, ShopID) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdsi', $product_name, $price, $description, $shopID);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function editProduct($productID, $product_name, $price, $description)
    {
        $sql = "UPDATE product SET Name = ?, Price = ?, Description = ? WHERE ProductID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdsi', $product_name, $price, $description, $productID);
        $stmt->execute();
    }

    public function setImgPath($ProductID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $ProductID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/product/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/product/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE product SET ImgPath = ? WHERE ProductID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $ProductID);
            $stmt->execute();
        }
    }

    public function deleteProduct($productID)
    {
        $sql = "DELETE FROM product WHERE ProductID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $productID);
        $stmt->execute();
    }

    //update profile
    public function updateHeritage($heritageID, $email, $name,  $address, $contactNo, $description,  $website, $sm_link, $open_hours)
    {
        $sql = "UPDATE heritagemarket SET Email = ?, Name = ?, Address = ?, ContactNo = ?, Description = ?, Website = ?, SMLink = ?,OpenHours = ? WHERE ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssssi', $email, $name,  $address, $contactNo, $description,  $website, $sm_link, $open_hours, $heritageID);
        $stmt->execute();
    }

    public function checkCurrentPassword($heritageID, $currentPassword)
    {
        $sql = "SELECT * FROM heritagemarket WHERE ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $heritageID);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashedPassword = $result->fetch_assoc()['Password'];

        return password_verify($currentPassword, $hashedPassword);
    }

    public function changePassword($heritageID, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE heritagemarket SET Password = ? WHERE ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $newPassword, $heritageID);
        $stmt->execute();
    }

    public function getReviews($shopID)
    {
        $sql = "SELECT hf.*, t.FirstName, t.LastName FROM heritagemarketfeedback hf INNER JOIN traveler t ON hf.TravelerID = t.TravelerID WHERE hf.ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $shopID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addResponse($reviewID, $response)
    {
        $sql = "UPDATE heritagemarketfeedback SET Response = ? WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $response, $reviewID);
        $stmt->execute();
    }

    public function getProductByID($productID)
    {
        $sql = "SELECT * FROM product WHERE ProductID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $productID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getTotalProducts($shopID)
    {
        $sql = "SELECT COUNT(*) AS total FROM product WHERE ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $shopID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return (int)$row['total'];
        } else {
            return 0;
        }
    }

    public function getTotalReviews($shopID)
    {
        $sql = "SELECT COUNT(*) AS total FROM heritagemarketfeedback WHERE ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $shopID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return (int)$row['total'];
        } else {
            return 0;
        }
    }

    public function getAverageRatings($shopID)
    {
        $sql = "SELECT AVG(Rating) AS average FROM heritagemarketfeedback WHERE ShopID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $shopID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return (float)$row['average'];
        } else {
            return 0.0;
        }
    }
    public function getFeedbacksWith5($shopID)
    {
        $sql = "SELECT COUNT(*) AS total FROM heritagemarketfeedback WHERE ShopID = ? AND Rating = 5.0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $shopID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            return (int)$row['total'];
        } else {
            return 0;
        }
    }

    public function addReview($shopID, $travelerID, $rating, $review, $date)
    {
        $sql = "INSERT INTO heritagemarketfeedback (ShopID, TravelerID, Rating, Comment, Date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiiss', $shopID, $travelerID, $rating, $review, $date);
        $stmt->execute();
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
                $query = "SELECT r.RestaurantID as ID, r.Name, r.Address, r.ContactNo as Phone, r.Email, '' as Website, r.Description 
                         FROM restaurant r";
                break;
            case 'CulturalEvent':
                $query = "SELECT c.OrganizerID as ID, c.Name, c.Address, c.ContactNo as Phone, c.Email, '' as Website, '' as Description 
                         FROM culturaleventorganizer c";
                break;
            case 'HeritageMarket':
                $query = "SELECT h.ShopID as ID, h.Name, h.Address, h.ContactNo as Phone, h.Email, '' as Website, h.Description 
                         FROM heritagemarket h 
                         WHERE h.ShopID != ?";
                break;
        }

        if (!empty($query)) {
            $stmt = $this->conn->prepare($query);
            
            if (!$stmt) {
                error_log("SQL Error in getAllServiceProviders: " . $this->conn->error . " for query: " . $query);
                return [];
            }
            
            // Only bind session shop ID for heritage market query to exclude current shop
            if ($type == 'HeritageMarket') {
                $stmt->bind_param("i", $_SESSION['ShopID']);
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
     * Get all packages created by a specific heritage market
     */
    public function getPackages($shopId)
    {
        $sql = "SELECT p.*, 
                COALESCE(h.Name, r.Name, hm.Name, c.Name) as PartnerName 
                FROM Package p 
                LEFT JOIN Hotel h ON p.HotelID = h.HotelID 
                LEFT JOIN Restaurant r ON p.RestaurantID = r.RestaurantID 
                LEFT JOIN HeritageMarket hm ON p.ShopID = hm.ShopID 
                LEFT JOIN CulturalEventOrganizer c ON p.EventID = c.OrganizerID 
                WHERE 
                    (p.Owner = 'heritagemarket' AND p.ShopID = ?)
                ORDER BY p.StartDate DESC";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getPackages: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $shopId);
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
    public function deletePackage($packageId, $shopId)
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
     * Get all users across all packages for this heritage market
     */
    public function getAllPackageUsers($shopId)
    {
        $sql = "SELECT pc.*, t.TravelerID, t.FirstName, t.LastName, t.Email, t.ContactNo, t.ImgPath, p.Name as PackageName
                FROM PackageCustomer pc 
                JOIN Traveler t ON pc.TravelerID = t.TravelerID 
                JOIN Package p ON pc.PackageID = p.PackageID
                WHERE p.ShopID = ? OR (p.Owner != 'heritagemarket' AND (
                    p.RestaurantID IS NOT NULL OR 
                    p.HotelID IS NOT NULL OR 
                    p.EventID IS NOT NULL
                ))
                ORDER BY p.Name, t.FirstName";
        
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            error_log("SQL Error in getAllPackageUsers: " . $this->conn->error);
            return [];
        }
        
        $stmt->bind_param("i", $shopId);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_all(MYSQLI_ASSOC);
    }
=======
     //images 

     public function addImage($title ,$heritagemarketID)
     {
         $sql = "INSERT INTO heritagemarketimages (Title,  ShopID) VALUES ( ?, ?)";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('si',$title , $heritagemarketID);
         $stmt->execute();
         
         // Get the ImageID
         $sql = "SELECT ImageID FROM heritagemarketimages WHERE Title = ? AND ShopID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('si', $title, $heritagemarketID);
         $stmt->execute();
         $result = $stmt->get_result();
         $ImageID = $result->fetch_assoc()['ImageID'];
         
         return $ImageID;
     }
  
 
     
     public function getImage($heritagemarketID)
     {
         $sql = "SELECT * FROM heritagemarketimages WHERE ShopID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('i', $heritagemarketID);
         $stmt->execute();
         $result = $stmt->get_result();
 
         return $result->fetch_all(MYSQLI_ASSOC);
     }
 
     
     public function getImageItem($imageID)
     {
         $sql = "SELECT * FROM heritagemarketimages WHERE ImageID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('i', $imageID);
         $stmt->execute();
         $result = $stmt->get_result();
 
         return $result->fetch_assoc();
 
     }
 
     public function deleteImage($imageID)
     {
         $sql = "DELETE FROM heritagemarketimages WHERE ImageID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('i', $imageID);
         $stmt->execute();
     }
 
 
     public function setShopImgPath($imageID, $fileName)
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
         $targetDir = __DIR__ . '/../../public/images/database/heritagemarket_images/';
 
         // Check the directory exists and create it
         if (!is_dir($targetDir)) {
             mkdir($targetDir, 0777, false);
         }
 
         // Create the image path
         $imgDir = $targetDir . $newFileName;
 
         // Move the image to the target directory
         $moving = move_uploaded_file($tempImgPath, $imgDir);
 
         // Define the image path
         $imgPath = '/ExploreEase/public/images/database/heritagemarket_images/' . $newFileName;
 
         // Enter the image path to the database
         if ($moving) {
             $sql = "UPDATE heritagemarketimages SET ImgPath = ? WHERE ImageID = ?";
             $stmt = $this->conn->prepare($sql);
             $stmt->bind_param('si', $imgPath, $imageID);
             $stmt->execute();
         }
     }
 
     public function getRestImgPath($imageID)
     {
         $sql = "SELECT ImgPath FROM heritagemarketimages WHERE ImageID = ?";
         $stmt = $this->conn->prepare($sql);
         $stmt->bind_param('i', $imageID);
         $stmt->execute();
         $result = $stmt->get_result();
         return $result->fetch_assoc()['ImgPath'];
     }
   
 
 
 
 
>>>>>>> cc271b72a003c69515347da7af55f09154ca5813
}
