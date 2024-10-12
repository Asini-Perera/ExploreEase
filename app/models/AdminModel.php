<?php

namespace app\models;

class AdminModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAdminByID($AdminID) {
        $sql = "SELECT * FROM admin WHERE AdminID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $AdminID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function setImgPath($AdminID, $fileName) {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];
        
        // Get the file extention
        $extention = pathinfo($fileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $AdminID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/admin/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgPath = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgPath);

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE admin SET ImgPath = ? WHERE AdminID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ss', $imgPath, $AdminID);
            $stmt->execute();
        }
    }
    
    public function createAdmin($firstName, $lastName, $email, $password, $contactNo) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admin (FirstName, LastName, Email, Password, ContactNo, IsVerified) 
                VALUES (?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $firstName, $lastName, $email, $hashedPassword, $contactNo);
        $stmt->execute();

        // Get the AdminID of the newly created admin
        $AdminID = $this->conn->insert_id;
        return $AdminID;
    }

    public function getUnverifiedAdmins() {
        $sql = "SELECT * FROM admin WHERE IsVerified = 0";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function verifyAdmin($AdminID) {
        $sql = "UPDATE admin SET IsVerified = 1 WHERE AdminID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $AdminID);
        $stmt->execute();
    }
}