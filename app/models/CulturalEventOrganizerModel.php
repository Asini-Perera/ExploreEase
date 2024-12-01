<?php

namespace app\Models;

class CulturalEventOrganizerModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getEvent($eventID)
    {
        $sql = "SELECT * FROM culturalevent WHERE EventID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $eventID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addEvent($title, $address, $date,$start_time,$end_time,$description, $capacity,$price,$status,$eventID)
    {
        $sql = "INSERT INTO room (EventID, `Name`, `Address`, `Longitude`, `Latitude`, `Date`, `StartTime`, `EndTime`, `Description`, `Capacity`, `TicketPrice`, `Status`, `OrganizerID`) VALUES (?, ?, ?, ?,?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdisi', $title, $address, $date,$start_time,$end_time,$description, $capacity,$price,$status,$eventID);
        $stmt->execute();
        
        return $stmt->insert_id;
    }

    public function setImgPath($OrganizerID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $OrganizerID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/culturaleventorganizer/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/culturaleventorganizer/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE traveler SET ImgPath = ? WHERE TravelerID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $OrganizerID);
            $stmt->execute();
        }
    }

    public function getImgPath($OrganizerID)
    {
        $sql = "SELECT ImgPath FROM culturaleventorganizer WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $OrganizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['ImgPath'];
    }

    public function updateOrganizer($OrganizerID, $name, $email, $contactNo, $description, $smLink)
    {
        $sql = "UPDATE culturaleventorganizer SET `Name` = ?, `Email` = ?, `ContactNo` = ?, `Description` = ?, `SMLink` = ? WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssissi', $name, $email, $contactNo, $description, $smLink, $OrganizerID);
        $stmt->execute();
    }

    public function checkCurrentPassword($OrganizerID, $currentPassword)
    {
        $sql = "SELECT * FROM culturaleventorganizer WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $OrganizerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashedPassword = $result->fetch_assoc()['Password'];

        return password_verify($currentPassword, $hashedPassword);
    }

    public function changePassword($OrganizerID, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE culturaleventorganizer SET Password = ? WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $newPassword, $OrganizerID);
        $stmt->execute();
    }

    public function deleteEvent($eventID)
    {
        $sql = "DELETE FROM culturalevent WHERE EventID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $eventID);
        $stmt->execute();
    }

    public function addPost($title, $description, $organizerID)
    {
        $sql = "INSERT INTO culturaleventorganizerpost (`Title`, `Description`, `OrganizerID`) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $title, $description, $organizerID);
        $stmt->execute();

        return $stmt->insert_id;
    }
}