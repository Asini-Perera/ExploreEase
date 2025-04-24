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
            if ($user) {
                $user['Type'] = $table;
                return $user;
            }
        }
        return null;
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

    public function restaurant($name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $weekdaysOpenHours, $weekendsOpenHours, $cuisineType, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink)
    {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the restaurant data
        $sql = "INSERT INTO restaurant (Name, Address, ContactNo, Email, Password, Latitude, Longitude, Website, Description, WeekdayOpenHours, WeekendOpenHours, CuisineType, Tagline, FacebookLink, InstagramLink, TikTokLink, YouTubeLink) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssddssssssssss', $name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $weekdaysOpenHours, $weekendsOpenHours, $cuisineType, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink);
        $stmt->execute();

        // Get the RestaurantID
        $sql = "SELECT RestaurantID FROM restaurant WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $RestaurantID = $stmt->get_result()->fetch_assoc()['RestaurantID'];

        return $RestaurantID;
    }

    public function hotel($name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink)
    {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the hotel data
        $sql = "INSERT INTO hotel (Name, Address, ContactNo, Email, Password, Latitude, Longitude, Website, Description, Tagline, FacebookLink, InstagramLink, TikTokLink, YoutubeLink) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssddsssssss', $name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink);
        $stmt->execute();

        // Get the HotelID
        $sql = "SELECT HotelID FROM hotel WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $HotelID = $stmt->get_result()->fetch_assoc()['HotelID'];

        return $HotelID;
    }

    public function heritageMarket($name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $weekdaysOpenHours, $weekendsOpenHours, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink)
    {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the heritage market data
        $sql = "INSERT INTO heritagemarket (Name, Address, ContactNo, Email, Password, Latitude, Longitude, Website, Description, WeekdayOpenHours, WeekendOpenHours, Tagline, FacebookLink, InstagramLink, TikTokLink, YouTubeLink) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssddsssssssss', $name, $address, $contactNo, $email, $password, $latitude, $longitude, $website, $description, $weekdaysOpenHours, $weekendsOpenHours, $tagline, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink);
        $stmt->execute();

        // Get the ShopID
        $sql = "SELECT ShopID FROM heritagemarket WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $ShopID = $stmt->get_result()->fetch_assoc()['ShopID'];

        return $ShopID;
    }

    public function culturalEventOrganizer($name, $email, $password, $contactNo, $description, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink)
    {
        // Hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the cultural event organizer data
        $sql = "INSERT INTO culturaleventorganizer (Name, Email, Password, ContactNo, Description, FacebookLink, InstagramLink, TikTokLink, YouTubeLink) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssssss', $name, $email, $password, $contactNo, $description, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink);
        $stmt->execute();

        // Get the OrganizerID
        $sql = "SELECT OrganizerID FROM culturaleventorganizer WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $OrganizerID = $stmt->get_result()->fetch_assoc()['OrganizerID'];

        return $OrganizerID;
    }
}
