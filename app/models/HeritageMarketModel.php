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
}
