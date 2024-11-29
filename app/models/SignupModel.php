<?php

namespace app\Models;

class SignupModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
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
    
    public function restaurant($name, $address, $contactNo, $email, $password, $website, $description, $openHours, $cuisineType, $socialMediaLink)
    {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the restaurant data
        $sql = "INSERT INTO restaurant (Name, Address, ContactNo, Email, Password, Website, Description, OpenHours, CuisineType, SMLink) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssssss', $name, $address, $contactNo, $email, $password, $website, $description, $openHours, $cuisineType, $socialMediaLink);
        $stmt->execute();

        // Get the RestaurantID
        $sql = "SELECT RestaurantID FROM restaurant WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $RestaurantID = $stmt->get_result()->fetch_assoc()['RestaurantID'];

        return $RestaurantID;
    }

    public function hotel($name, $address, $contactNo, $email, $password, $website, $description, $smlink)
    {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the hotel data
        $sql = "INSERT INTO hotel (Name, Address, ContactNo, Email, Password, Website, Description, SMLink) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssssss', $name, $address, $contactNo, $email, $password, $website, $description, $smlink);
        $stmt->execute();

        // Get the HotelID
        $sql = "SELECT HotelID FROM hotel WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $HotelID = $stmt->get_result()->fetch_assoc()['HotelID'];

        return $HotelID;
    }

    public function heritageMarket($name, $address, $contactNo, $email, $password, $website, $description, $openHours, $smlink)
    {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the heritage market data
        $sql = "INSERT INTO heritagemarket (Name, Address, ContactNo, Email, Password, Website, Description, OpenHours, SMLink) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssssss', $name, $address, $contactNo, $email, $password, $website, $description, $openHours, $smlink);
        $stmt->execute();

        // Get the ShopID
        $sql = "SELECT ShopID FROM heritagemarket WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $ShopID = $stmt->get_result()->fetch_assoc()['ShopID'];

        return $ShopID;
    }
}