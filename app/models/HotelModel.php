<?php

namespace app\Models;

class HotelModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getRoom($hotelID, $roomID = null)
    {
        $sql = "SELECT * FROM room WHERE HotelID = ?";
        if ($roomID) {
            $sql .= " AND RoomID = ?";
        }
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            throw new \Exception("SQL error: " . $this->conn->error);
        }
        if ($roomID) {
            $stmt->bind_param('ii', $hotelID, $roomID);
        } else {
            $stmt->bind_param('i', $hotelID);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $roomID ? $result->fetch_assoc() : $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addRoom($room_type, $price, $capacity, $description, $hotelID)
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
            mkdir($targetDir, 0777, true);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/room/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE room SET ImgPath = ? WHERE RoomID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $RoomID);
            $stmt->execute();
        }
    }

    public function deleteRoom($roomID)
    {
        $sql = "DELETE FROM room WHERE RoomID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $roomID);
        $stmt->execute();
    }

    //update profile
    public function updateHotel($hotelID, $email, $name, $address, $contactNo, $description, $website, $tagline, $facebook_link, $instagram_link, $tiktok_link, $youtube_link)
    {
        $sql = "UPDATE hotel SET Email = ?, Name = ?, Address = ?, ContactNo = ?, Description = ?, Website = ?, Tagline = ?, FacebookLink = ?, InstagramLink = ?, TikTokLink = ?, YoutubeLink = ? WHERE HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sssssssssssi', $email, $name, $address, $contactNo, $description, $website, $tagline, $facebook_link, $instagram_link, $tiktok_link, $youtube_link, $hotelID);
        $result = $stmt->execute();
        return $result; // Return true on success, false on failure
    }

    public function checkCurrentPassword($hotelID, $currentPassword)
    {
        $sql = "SELECT * FROM hotel WHERE HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();
        $hashedPassword = $result->fetch_assoc()['Password'];

        return password_verify($currentPassword, $hashedPassword);
    }

    public function changePassword($hotelID, $newPassword)
    {
        $newPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE hotel SET Password = ? WHERE HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $newPassword, $hotelID);
        $stmt->execute();
    }

    public function getReviewsByFeedbackID($hotelID)
    {
        $sql = "SELECT * FROM hotelfeedback WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTravelerById($travelerId)
    {
        $sql = "SELECT * FROM traveler WHERE TravelerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $travelerId);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getBookings($hotelID)
    {
        $sql = "SELECT rb.*, t.FirstName, t.LastName 
                FROM roombooking rb
                JOIN room r ON rb.RoomID = r.RoomID
                LEFT JOIN traveler t ON rb.TravelerID = t.TravelerID
                WHERE r.HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function setImagePath($PostID, $fileName)
    {
        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extention
        $extention = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = $PostID . '.' . $extention;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/hotel_post/';

        // Check the directory exists and create it
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 077, false);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path
        $imgPath = '/ExploreEase/public/images/database/hotel_post/' . $newFileName;

        // Enter the image path to the database
        if ($moving) {
            $sql = "UPDATE hotelpost SET ImgPath = ? WHERE PostID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('si', $imgPath, $PostID);
            $stmt->execute();
        }
    }

    public function getPost($hotelID, $postID = null)
    {
        $sql = "SELECT * FROM hotelpost WHERE HotelID = ?";
        if ($postID) {
            $sql .= " AND PostID = ?";
        }
        $stmt = $this->conn->prepare($sql);
        if ($postID) {
            $stmt->bind_param('ii', $hotelID, $postID);
        } else {
            $stmt->bind_param('i', $hotelID);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        return $postID ? $result->fetch_assoc() : $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalBookings($hotelId)
    {
        $sql = "SELECT COUNT(*) AS totalBookings 
                FROM RoomBooking rb
                JOIN Room r ON rb.RoomID = r.RoomID
                WHERE r.HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalBookings'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalRooms($hotelId)
    {
        $sql = "SELECT COUNT(*) AS totalRooms 
                FROM Room 
                WHERE HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalRooms'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    // public function getTotalRevenue($hotelId) {
    //     $sql = "SELECT SUM(rb.TotalPrice) AS totalRevenue 
    //             FROM RoomBooking rb
    //             JOIN Room r ON rb.RoomID = r.RoomID
    //             WHERE r.HotelID = ?";

    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $hotelId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalRevenue'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }

    // public function getTotalRevenueInLastWeek($hotelId) {
    //     $sql = "SELECT SUM(rb.TotalPrice) AS totalRevenueLastWeek 
    //             FROM RoomBooking rb
    //             JOIN Room r ON rb.RoomID = r.RoomID
    //             WHERE r.HotelID = ? AND rb.BookingDate >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";

    //     $stmt = $this->conn->prepare($sql);
    //     if ($stmt) {
    //         $stmt->bind_param("i", $hotelId);
    //         $stmt->execute();
    //         $result = $stmt->get_result();
    //         if ($result) {
    //             return $result->fetch_assoc()['totalRevenueLastWeek'];
    //         } else {
    //             error_log("SQL Error: " . $this->conn->error);
    //             return 0;
    //         }
    //     } else {
    //         error_log("SQL Prepare Error: " . $this->conn->error);
    //         return 0;
    //     }
    // }

    public function getTotalCustomers($hotelID)
    {
        $sql = "SELECT COUNT(DISTINCT rb.TravelerID) AS totalCustomers 
                FROM roombooking rb
                JOIN room r ON rb.RoomID = r.RoomID
                WHERE r.HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelID);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalCustomers'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalPosts($hotelId)
    {
        $sql = "SELECT COUNT(*) AS totalPosts 
                FROM HotelPost 
                WHERE HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalPosts'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalRatings($hotelId)
    {
        $sql = "SELECT COALESCE(AVG(hf.Rating), 0) AS totalRating 
            FROM HotelFeedback hf
            WHERE HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                $totalRating = $result->fetch_assoc()['totalRating'];
                return $totalRating ? (int)$totalRating : 0;
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function getTotalFeedbacks($hotelId)
    {
        $sql = "SELECT COUNT(*) AS totalFeedbacks 
                FROM HotelFeedback
                WHERE HotelID = ?";

        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("i", $hotelId);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result) {
                return $result->fetch_assoc()['totalFeedbacks'];
            } else {
                error_log("SQL Error: " . $this->conn->error);
                return 0;
            }
        } else {
            error_log("SQL Prepare Error: " . $this->conn->error);
            return 0;
        }
    }

    public function updateRoom($roomID, $room_type, $price, $capacity, $description)
    {
        $sql = "UPDATE room SET Type = ?, Price = ?, MaxOccupancy = ?, Description = ? WHERE RoomID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('sdisi', $room_type, $price, $capacity, $description, $roomID);
        $stmt->execute();
    }

    public function getRoomImage($roomID)
    {
        $sql = "SELECT ImgPath FROM room WHERE RoomID = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('i', $roomID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['ImgPath'];
        }

        return null;
    }

    public function addPost($title, $description, $hotelID)
    {
        $sql = "INSERT INTO hotelpost (Title, Description, HotelID) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $title, $description, $hotelID);
        $stmt->execute();

        return $stmt->insert_id;
    }

    public function getPostImage($postID)
    {
        $sql = "SELECT ImgPath FROM hotelpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            return null;
        }

        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc()['ImgPath'];
        }

        return null;
    }

    public function deletePost($postID)
    {
        $sql = "DELETE FROM hotelpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
    }

    public function updatePost($postID, $title, $description)
    {
        $sql = "UPDATE hotelpost SET Title = ?, Description = ? WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssi', $title, $description, $postID);
        $stmt->execute();
    }

    public function getPostById($postID)
    {
        $sql = "SELECT * FROM hotelpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getBookingsById($bookingID)
    {
        $sql = "SELECT * FROM roombooking WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $bookingID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function updateBooking($bookingID, $checkInDate, $checkOutDate, $date, $status, $roomID)
    {
        $sql = "UPDATE roombooking SET CheckInDate = ?, CheckOutDate = ?, Date = ?, Status = ?, RoomID = ? WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssssii', $checkInDate, $checkOutDate, $date, $status, $roomID, $bookingID);
        $stmt->execute();
    }

    public function deleteBooking($bookingID)
    {
        $sql = "DELETE FROM roombooking WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $bookingID);
        $stmt->execute();
    }

    public function getBookingById($bookingID)
    {
        $sql = "SELECT * FROM roombooking WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $bookingID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getReviews($hotelID)
    {
        $sql = "SELECT hf.*, t.FirstName, t.LastName 
                FROM hotelfeedback hf
                LEFT JOIN traveler t ON hf.TravelerID = t.TravelerID
                WHERE hf.HotelID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $hotelID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function updateReviewResponse($reviewID, $response)
    {
        $sql = "UPDATE hotelfeedback SET Response = ? WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('si', $response, $reviewID);
            return $stmt->execute();
        }
        return false;
    }

    public function getReviewById($feedbackID)
    {
        $sql = "SELECT * FROM hotelfeedback WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $feedbackID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
}
