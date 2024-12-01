<?php

namespace app\Models;

class HotelModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getRoom($hotelID)
    {
        $sql = "SELECT * FROM room WHERE HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addRoom($room_type, $price, $capacity,$description, $hotelID)
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
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/room/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE roomimages SET ImgPath = ? WHERE RoomID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $RoomID);
            $stmt->execute();
        }
    }

    public function getReviews($hotelID)
    {
        $sql = "SELECT * FROM hotelfeedback WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBookings($hotelID)
    {
        $sql = "SELECT * FROM roombooking WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }


}