<?php

namespace app\Models;

class SignupModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function traveler($firstName, $lastName, $email, $password, $gender, $dob, $contactNo)
    {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the traveler data
        $sql = "INSERT INTO traveler (FirstName, LastName, Email, Password, Gender, DOB, ContactNo) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssss', $firstName, $lastName, $email, $password, $gender, $dob, $contactNo);
        $stmt->execute();

        // Get the TravelerID
        $sql = "SELECT TravelerID FROM traveler WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $TravelerID = $stmt->get_result()->fetch_assoc()['TravelerID'];

        return $TravelerID;
    }
    
    public function getUserByEmail($email)
    {
        $userTables = ['admin', 'traveler', 'hotel', 'restaurant', 'heritagemarket', 'culturaleventorganizer'];
        foreach ($userTables as $table) {
            $sql = "SELECT * FROM $table WHERE Email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            
            return $user;
        }
    }
}