<?php

namespace app\Models;

class TravelerModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function setImgPath($TravelerID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $TravelerID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/traveler/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/traveler/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE traveler SET ImgPath = ? WHERE TravelerID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $TravelerID);
            $stmt->execute();
        }
    }

    public function updateProfile($TravelerID, $firstName, $lastName, $email, $gender, $dob, $contactNumber)
    {
        // Prepare the SQL statement
        $sql = "UPDATE traveler SET FirstName = ?, LastName = ?, Email = ?, Gender = ?, DOB = ?, ContactNo = ? WHERE TravelerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssi', $firstName, $lastName, $email, $gender, $dob, $contactNumber, $TravelerID);
        $stmt->execute();
    }
}
