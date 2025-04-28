<?php

namespace app\Models;

class CulturalEventOrganizerModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllEvents($organizerID)
    {
        $sql = "SELECT * FROM culturalevent WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }





    public function addEvent($title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID)
    {
        try {
            // Log the SQL operation starting
            error_log("Adding new event for organizer ID: $organizerID");

            $sql = "INSERT INTO culturalevent (`Name`, `Address`, `Date`, `StartTime`, `EndTime`, `Description`, `Capacity`, `TicketPrice`, `Status`, `OrganizerID`) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                error_log("SQL prepare error: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param('ssssssidsi', $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID);

            $result = $stmt->execute();

            if (!$result) {
                error_log("SQL execute error: " . $stmt->error);
                return false;
            }

            $insertId = $stmt->insert_id;
            error_log("Event added successfully with ID: $insertId");

            return $insertId;
        } catch (\Exception $e) {
            error_log("Exception in addEvent model: " . $e->getMessage());
            return false;
        }
    }

    public function updateEvent($eventID, $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status)
    {
        try {
            $sql = "UPDATE culturalevent SET 
                    `Name` = ?, 
                    `Address` = ?, 
                    `Date` = ?, 
                    `StartTime` = ?, 
                    `EndTime` = ?, 
                    `Description` = ?, 
                    `Capacity` = ?, 
                    `TicketPrice` = ?, 
                    `Status` = ? 
                    WHERE EventID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ssssssidsi', $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $eventID);
            $stmt->execute();

            return $stmt->affected_rows > 0;
        } catch (\Exception $e) {
            error_log("Exception in updateEvent: " . $e->getMessage());
            return false;
        }
    }

    public function updateOrganizer($OrganizerID, $name, $email, $contactNo, $description, $facebookLink, $instagramLink, $tiktokLink, $youtubeLink)
    {
        $sql = "UPDATE culturaleventorganizer SET 
                `Name` = ?, 
                `Email` = ?, 
                `ContactNo` = ?, 
                `Description` = ?, 
                `FacebookLink` = ?,
                `InstagramLink` = ?,
                `TikTokLink` = ?,
                `YouTubeLink` = ?
                WHERE OrganizerID = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param(
            'ssisssssi',
            $name,
            $email,
            $contactNo,
            $description,
            $facebookLink,
            $instagramLink,
            $tiktokLink,
            $youtubeLink,
            $OrganizerID
        );
        $stmt->execute();

        return $stmt->affected_rows > 0;
    }

    public function setImgPath($OrganizerID, $fileName)
    {
        try {
            // Get temp image path
            $tempImgPath = $fileName['tmp_name'];

            // Get the file name (original file name from the upload)
            $originalFileName = $fileName['name'];

            // Get the file extension
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

            // Create a new file name
            $newFileName = 'organizer_' . $OrganizerID . '.' . $extension;

            // Define the target directory
            $targetDir = __DIR__ . '/../../public/images/database/culturaleventorganizer/';

            // Check the directory exists and create it
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Create the image path
            $imgDir = $targetDir . $newFileName;

            // Move the image to the target directory
            $moving = move_uploaded_file($tempImgPath, $imgDir);

            // Define the image path for the database
            $imgPath = '/ExploreEase/public/images/database/culturaleventorganizer/' . $newFileName;

            // Enter the image path to the database
            if ($moving) {
                $sql = "UPDATE culturaleventorganizer SET ImgPath = ? WHERE OrganizerID = ?";
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param('si', $imgPath, $OrganizerID);
                return $stmt->execute();
            }

            return false;
        } catch (\Exception $e) {
            error_log("Exception in setImgPath: " . $e->getMessage());
            return false;
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


    // public function addEvent($title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID)
    // {
    //     $sql = "INSERT INTO culturaleventorganizerpost (`Title`, `Description`, `OrganizerID`) VALUES (?, ?, ?)";
    //     $stmt = $this->conn->prepare($sql);
    //     $stmt->bind_param('ssi', $title, $address, $date, $start_time, $end_time, $description, $capacity, $price, $status, $organizerID);
    //     $stmt->execute();

    //     return $stmt->insert_id;
    // }


    public function getEventItem($eventID)
    {
        $sql = "SELECT * FROM culturalevent WHERE EventID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $eventID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
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
        try {
            $sql = "INSERT INTO culturaleventorganizerpost (`Title`, `Description`, `OrganizerID`, `Date`) VALUES (?, ?, ?, CURRENT_DATE())";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                error_log("SQL prepare error in addPost: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param('ssi', $title, $description, $organizerID);
            $result = $stmt->execute();

            if (!$result) {
                error_log("SQL execute error in addPost: " . $stmt->error);
                return false;
            }

            return $stmt->insert_id;
        } catch (\Exception $e) {
            error_log("Exception in addPost: " . $e->getMessage());
            return false;
        }
    }

    public function getPost($organizerID, $postID = null)
    {
        if ($postID) {
            // Fetch a specific post by ID
            $sql = "SELECT * FROM culturaleventorganizerpost WHERE PostID = ? AND OrganizerID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('ii', $postID, $organizerID);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_assoc(); // Return a single post as associative array
        } else {
            // Fetch all posts for the organizer
            $sql = "SELECT * FROM culturaleventorganizerpost WHERE OrganizerID = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param('i', $organizerID);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function updatePost($postID, $title, $description)
    {
        try {
            $sql = "UPDATE culturaleventorganizerpost SET Title = ?, Description = ? WHERE PostID = ?";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                error_log("SQL prepare error in updatePost: " . $this->conn->error);
                return false;
            }

            $stmt->bind_param('ssi', $title, $description, $postID);
            $result = $stmt->execute();

            if (!$result) {
                error_log("SQL execute error in updatePost: " . $stmt->error);
                return false;
            }

            return true;
        } catch (\Exception $e) {
            error_log("Exception in updatePost: " . $e->getMessage());
            return false;
        }
    }

    public function setPostImagePath($postID, $fileName)
    {
        try {
            // Log the start of image upload process
            error_log("Starting to set image for post ID: $postID");

            // Get temp image path
            $tempImgPath = $fileName['tmp_name'];

            // Get the file name (original file name from the upload)
            $originalFileName = $fileName['name'];

            // Get the file extension
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

            // Create a new file name
            $newFileName = 'post_' . $postID . '.' . $extension;

            // Define the target directory
            $targetDir = __DIR__ . '/../../public/images/database/culturaleventorganizerpost/';

            // Check if the directory exists and create it if not
            if (!is_dir($targetDir)) {
                if (!mkdir($targetDir, 0777, true)) {
                    error_log("Failed to create directory: $targetDir");
                    return false;
                }
                error_log("Created directory: $targetDir");
            }

            // Create the image path
            $imgDir = $targetDir . $newFileName;

            // Move the image to the target directory
            $moving = move_uploaded_file($tempImgPath, $imgDir);

            // Define the image path for the database
            $imgPath = '/ExploreEase/public/images/database/culturaleventorganizerpost/' . $newFileName;

            // Update the database with the image path
            if ($moving) {
                error_log("Image moved successfully to: $imgDir");
                $sql = "UPDATE culturaleventorganizerpost SET ImgPath = ? WHERE PostID = ?";
                $stmt = $this->conn->prepare($sql);

                if (!$stmt) {
                    error_log("Failed to prepare SQL statement: " . $this->conn->error);
                    return false;
                }

                $stmt->bind_param('si', $imgPath, $postID);
                $result = $stmt->execute();

                if (!$result) {
                    error_log("Failed to update image path in database: " . $stmt->error);
                    return false;
                }

                return true;
            } else {
                $uploadError = error_get_last();
                error_log("Failed to move uploaded file. Error: " . ($uploadError ? $uploadError['message'] : 'Unknown error'));
                return false;
            }
        } catch (\Exception $e) {
            error_log("Exception in setPostImagePath: " . $e->getMessage());
            return false;
        }
    }

    public function getPostItem($postID)
    {
        $sql = "SELECT * FROM culturaleventorganizerpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }
    public function deletePost($postID)
    {
        $sql = "DELETE FROM culturaleventorganizerpost WHERE PostID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $postID);
        $stmt->execute();
    }


    public function getTotalBookings($organizerID)
    {
        $sql = "SELECT COUNT(*) as TotalBookings 
                FROM culturaleventbooking ceb
                JOIN culturalevent ce ON ceb.EventID = ce.EventID
                WHERE ce.OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalBookings'];
    }

    public function getTotalEvents($organizerID)
    {
        $sql = "SELECT COUNT(*) as TotalEvents FROM culturalevent WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalEvents'];
    }

    // public function getTotalPosts($organizerID)
    // {
    //     $sql = "SELECT COUNT(*) as TotalPosts FROM culturaleventorganizerpost WHERE OrganizerID = ?";
    //     $stmt = $this->conn->prepare($sql);

    //     // Check if prepare was successful
    //     if (!$stmt) {
    //         // Log the error for debugging
    //         error_log("MySQL prepare error: " . $this->conn->error);
    //         return 0; // Return a default value
    //     }

    //     $stmt->bind_param('i', $organizerID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_assoc()['TotalPosts'];
    // }

    public function getTotalRatings($organizerID)
    {
        $sql = "SELECT COUNT(*) as TotalRatings FROM culturaleventorganizerfeedback WHERE OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalRatings'];
    }

    // public function getTotalRevenue($organizerID)
    // {
    //     $sql = "SELECT SUM(Amount) as TotalRevenue 
    //             FROM culturaleventbooking ceb
    //             JOIN culturalevent ce ON ceb.EventID = ce.EventID
    //             WHERE ce.OrganizerID = ?";
    //     $stmt = $this->conn->prepare($sql);

    //     // Check if prepare was successful
    //     if (!$stmt) {
    //         // Log the error for debugging
    //         error_log("MySQL prepare error: " . $this->conn->error);
    //         return 0; // Return a default value
    //     }

    //     $stmt->bind_param('i', $organizerID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_assoc()['TotalRevenue'];
    // }

    public function getTotalCustomers($organizerID)
    {
        $sql = "SELECT COUNT(DISTINCT CustomerID) as TotalCustomers FROM booking WHERE EventID IN (SELECT EventID FROM culturalevent WHERE OrganizerID = ?)";
        $stmt = $this->conn->prepare($sql);

        // Check if prepare was successful
        if (!$stmt) {
            // Log the error for debugging
            error_log("MySQL prepare error: " . $this->conn->error);
            return 0; // Return a default value
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc()['TotalCustomers'];
    }

    // public function getTotalFeedbacks($organizerID)
    // {
    //     $sql = "SELECT COUNT(*) as TotalFeedbacks FROM feedback WHERE EventID IN (SELECT EventID FROM culturalevent WHERE OrganizerID = ?)";
    //     $stmt = $this->conn->prepare($sql);

    //     // Check if prepare was successful
    //     if (!$stmt) {
    //         // Log the error for debugging
    //         error_log("MySQL prepare error: " . $this->conn->error);
    //         return 0; // Return a default value
    //     }

    //     $stmt->bind_param('i', $organizerID);
    //     $stmt->execute();
    //     $result = $stmt->get_result();

    //     return $result->fetch_assoc()['TotalFeedbacks'];
    // }


    public function setEventImage($eventID, $fileName)
    {
        // Log the start of image upload process
        error_log("Starting to set image for event ID: $eventID");

        // Get temp image path
        $tempImgPath = $fileName['tmp_name'];

        // Get the file name (original file name from the upload)
        $originalFileName = $fileName['name'];

        // Get the file extension
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION);

        // Create a new file name
        $newFileName = 'event_' . $eventID . '.' . $extension;

        // Define the target directory
        $targetDir = __DIR__ . '/../../public/images/database/culturalevent/';

        // Check if the directory exists and create it if not
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Create the image path
        $imgDir = $targetDir . $newFileName;

        // Move the image to the target directory
        $moving = move_uploaded_file($tempImgPath, $imgDir);

        // Define the image path for the database
        $imgPath = '/ExploreEase/public/images/database/culturalevent/' . $newFileName;

        // Update the database with the image path
        if ($moving) {
            $sql = "UPDATE culturalevent SET ImgPath = ? WHERE EventID = ?";
            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param('si', $imgPath, $eventID);
            $stmt->execute();
            $stmt->close();
        }
    }

    public function getBookings($organizerID)
    {
        error_log("Fetching bookings for organizer ID: $organizerID");

        // Let's check if we have any bookings in the table at all
        $checkSql = "SELECT COUNT(*) as count FROM culturaleventbooking";
        $checkStmt = $this->conn->prepare($checkSql);

        if (!$checkStmt) {
            error_log("MySQL prepare error for count check: " . $this->conn->error);
            return [];
        }

        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        $totalCount = $checkResult->fetch_assoc()['count'];
        error_log("Total bookings in culturaleventbooking table: $totalCount");

        // Now proceed with the actual query
        $sql = "SELECT ceb.*, ce.Name as EventName, t.FirstName, t.LastName 
                FROM culturaleventbooking ceb
                JOIN culturalevent ce ON ceb.EventID = ce.EventID
                LEFT JOIN traveler t ON ceb.TravelerID = t.TravelerID
                WHERE ce.OrganizerID = ?
                ORDER BY ceb.Date DESC";

        error_log("Executing SQL: " . str_replace('?', $organizerID, $sql));

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            error_log("MySQL prepare error: " . $this->conn->error);
            return [];
        }

        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        $bookings = $result->fetch_all(MYSQLI_ASSOC);
        $count = count($bookings);
        error_log("Found $count bookings for organizer ID: $organizerID");

        return $bookings;
    }

    public function getBookingById($bookingID)
    {
        $sql = "SELECT * FROM culturaleventbooking WHERE BookingID = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            error_log("MySQL prepare error in getBookingById: " . $this->conn->error);
            return null;
        }

        $stmt->bind_param('i', $bookingID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getTravelerById($travelerID)
    {
        $sql = "SELECT * FROM traveler WHERE TravelerID = ?";
        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            error_log("MySQL prepare error in getTravelerById: " . $this->conn->error);
            return null;
        }

        $stmt->bind_param('i', $travelerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function validateBookingOwnership($bookingID, $organizerID)
    {
        $sql = "SELECT COUNT(*) as count 
                FROM culturaleventbooking ceb
                JOIN culturalevent ce ON ceb.EventID = ce.EventID
                WHERE ceb.BookingID = ? AND ce.OrganizerID = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            error_log("MySQL prepare error in validateBookingOwnership: " . $this->conn->error);
            return false;
        }

        $stmt->bind_param('ii', $bookingID, $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['count'] > 0;
    }

    public function updateBooking($bookingID, $date, $quantity, $status, $eventID, $amount = null)
    {
        try {
            // Validate parameters
            if (!$bookingID || !$date || !$eventID) {
                error_log("Missing required booking parameters");
                return false;
            }

            // Validate numeric parameters
            if (!is_numeric($bookingID) || !is_numeric($eventID) || !is_numeric($quantity)) {
                error_log("Invalid numeric parameters in updateBooking");
                return false;
            }

            if ($amount !== null && !is_numeric($amount)) {
                error_log("Invalid amount parameter in updateBooking: $amount");
                return false;
            }

            // Type cast to ensure correct data types
            $bookingID = (int)$bookingID;
            $eventID = (int)$eventID;
            $quantity = (int)$quantity;
            if ($amount !== null) {
                $amount = (float)$amount;
            }

            // Log what we're about to do
            error_log("Attempting to update booking ID: $bookingID with data: " . json_encode([
                'date' => $date,
                'quantity' => $quantity,
                'status' => $status,
                'eventID' => $eventID,
                'amount' => $amount
            ]));

            // Check if the connection is still valid
            if (!$this->conn || $this->conn->connect_error) {
                error_log("Database connection error in updateBooking");
                return false;
            }

            // Prepare SQL based on whether amount is provided
            if ($amount !== null) {
                $sql = "UPDATE culturaleventbooking 
                        SET Date = ?, Quantity = ?, Status = ?, EventID = ?, Amount = ? 
                        WHERE BookingID = ?";
                $stmt = $this->conn->prepare($sql);

                if (!$stmt) {
                    error_log("SQL prepare error: " . $this->conn->error);
                    return false;
                }

                $stmt->bind_param('sisidi', $date, $quantity, $status, $eventID, $amount, $bookingID);
            } else {
                $sql = "UPDATE culturaleventbooking 
                        SET Date = ?, Quantity = ?, Status = ?, EventID = ? 
                        WHERE BookingID = ?";
                $stmt = $this->conn->prepare($sql);

                if (!$stmt) {
                    error_log("SQL prepare error: " . $this->conn->error);
                    return false;
                }

                $stmt->bind_param('sisii', $date, $quantity, $status, $eventID, $bookingID);
            }

            // Execute the update
            if (!$stmt->execute()) {
                error_log("SQL execute error: " . $stmt->error);
                return false;
            }

            // Check if any rows were affected
            $affected = $stmt->affected_rows;
            $stmt->close();

            // Log the result
            error_log("Update completed. Affected rows: $affected");

            // Return true if rows were affected or if no changes were needed
            return ($affected >= 0);
        } catch (\Exception $e) {
            error_log("Exception in updateBooking: " . $e->getMessage() . "\nStack Trace: " . $e->getTraceAsString());
            return false;
        }
    }

    public function getReviews($organizerID)
    {
        $sql = "SELECT f.*, t.FirstName, t.LastName 
                FROM culturaleventorganizerfeedback f
                JOIN traveler t ON f.TravelerID = t.TravelerID
                WHERE f.OrganizerID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('i', $organizerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function addReviewResponse($reviewID, $response)
    {
        $sql = "UPDATE culturaleventorganizerfeedback SET Response = ? WHERE FeedbackID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('si', $response, $reviewID);
        return $stmt->execute();
    }
}
