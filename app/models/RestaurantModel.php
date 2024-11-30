<?php

namespace app\Models;

class RestaurantModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
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

    public function addMenu($name, $price, $category, $restaurantID)
    {
        $sql = "INSERT INTO menu (FoodName, Price, FoodCategory, RestaurantID) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdsi', $name, $price, $category, $restaurantID);
        $stmt->execute();
        
        return $stmt->insert_id;
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
            mkdir($targetDir, 077, false);
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
}