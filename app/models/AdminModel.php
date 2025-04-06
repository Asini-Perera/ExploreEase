<?php

namespace app\Models;

class AdminModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAdminByEmail($email)
    {
        $sql = "SELECT * FROM admin WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function setImgPath($AdminID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $AdminID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/admin/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/admin/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE admin SET ImgPath = ? WHERE AdminID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $AdminID);
            $stmt->execute();
        }
    }

    public function getImgPath($AdminID)
    {
        $sql = "SELECT ImgPath FROM admin WHERE AdminID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $AdminID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()['ImgPath'];
    }

    public function createAdmin($firstName, $lastName, $email, $password, $contactNo)
    {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO admin (FirstName, LastName, Email, Password, ContactNo) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssss', $firstName, $lastName, $email, $password, $contactNo);
        $stmt->execute();

        // Get the AdminID
        $sql = "SELECT AdminID FROM admin WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $AdminID = $stmt->get_result()->fetch_assoc()['AdminID'];

        return $AdminID;
    }

    public function updateAdmin($AdminID, $firstName, $lastName, $email, $contactNo)
    {
        $sql = "UPDATE admin SET FirstName = ?, LastName = ?, Email = ?, ContactNo = ? WHERE AdminID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssi', $firstName, $lastName, $email, $contactNo, $AdminID);
        $stmt->execute();
    }

    public function checkCurrentPassword($AdminID, $password)
    {
        $sql = "SELECT Password FROM admin WHERE AdminID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $AdminID);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashedPassword = $result->fetch_assoc()['Password'];

        return password_verify($password, $hashedPassword);
    }

    public function changePassword($AdminID, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE admin SET Password = ? WHERE AdminID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $newPassword, $AdminID);
        $stmt->execute();
    }

    public function getTotalUsers($user)
    {
        $sql = "SELECT COUNT('Email') FROM $user";
        $result = $this->conn->query($sql);
        $count = $result->fetch_assoc();
        if ($count) {
            return (int)$count["COUNT('Email')"];
        } else {
            return 0;
        }
    }

    public function getUnverifiedUsers($user)
    {
        if ($user == 'admin') {
            $sql = "SELECT AdminID, FirstName, LastName, Email, ContactNo, ImgPath FROM $user WHERE IsVerified = 0";
        } else if ($user == 'restaurant') {
            $sql = "SELECT RestaurantID, Name, Email, Address, ContactNo FROM $user WHERE IsVerified = 0";
        } else if ($user == 'hotel') {
            $sql = "SELECT HotelID, Name, Email, Address, ContactNo FROM $user WHERE IsVerified = 0";
        } else if ($user == 'heritagemarket') {
            $sql = "SELECT ShopID, Name, Email, Address, ContactNo FROM $user WHERE IsVerified = 0";
        } else if ($user == 'culturaleventorganizer') {
            $sql = "SELECT OrganizerID, Name, Email, ContactNo, ImgPath FROM $user WHERE IsVerified = 0";
        }
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = $result->fetch_all(MYSQLI_ASSOC);

        return $users;
    }
}
