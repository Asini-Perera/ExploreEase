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

    public function getTravelerReviews($TravelerID)
    {
        $sql = "SELECT hf.*, h.Name FROM hotelfeedback hf INNER JOIN hotel h ON hf.HotelID = h.HotelID WHERE hf.TravelerID = ?
        UNION ALL
        SELECT rf.*, r.Name FROM restaurantfeedback rf INNER JOIN restaurant r ON rf.RestaurantID = r.RestaurantID WHERE rf.TravelerID = ?
        UNION ALL
        SELECT cf.*, c.Name FROM culturaleventorganizerfeedback cf INNER JOIN culturaleventorganizer c ON cf.OrganizerID = c.OrganizerID WHERE cf.TravelerID = ?
        UNION ALL
        SELECT hf.*, hm.Name FROM heritagemarketfeedback hf INNER JOIN heritagemarket hm ON hf.ShopID = hm.ShopID WHERE hf.TravelerID = ?
        ORDER BY RAND()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iiii', $TravelerID, $TravelerID, $TravelerID, $TravelerID);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTravelerFutureBookings($TravelerID)
    {
        $sql = "SELECT h.Name, rb.CheckOutDate, rb.CheckInDate AS BookingDate FROM roombooking rb INNER JOIN room ro ON rb.RoomID = ro.RoomID INNER JOIN hotel h ON ro.HotelID = h.HotelID WHERE rb.TravelerID = ? AND rb.CheckInDate >= CURDATE()
        UNION ALL
        SELECT r.Name, tb.BookingTime, tb.BookingDate AS BookingDate FROM tablebooking tb INNER JOIN restaurant r ON tb.RestaurantID = r.RestaurantID WHERE tb.TravelerID = ? AND tb.BookingDate >= CURDATE()
        UNION ALL
        SELECT c.Name, c.StartTime, c.Date AS BookingDate FROM culturaleventbooking cb INNER JOIN culturalevent c ON cb.EventID = c.EventID WHERE cb.TravelerID = ? AND c.Date >= CURDATE()
        ORDER BY BookingDate ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iii', $TravelerID, $TravelerID, $TravelerID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTravelerPastBookings($TravelerID)
    {
        $sql = "SELECT h.Name, rb.CheckOutDate, rb.CheckInDate AS BookingDate FROM roombooking rb INNER JOIN room ro ON rb.RoomID = ro.RoomID INNER JOIN hotel h ON ro.HotelID = h.HotelID WHERE rb.TravelerID = ? AND rb.CheckInDate < CURDATE()
        UNION ALL
        SELECT r.Name, tb.BookingTime, tb.BookingDate AS BookingDate FROM tablebooking tb INNER JOIN restaurant r ON tb.RestaurantID = r.RestaurantID WHERE tb.TravelerID = ? AND tb.BookingDate < CURDATE()
        UNION ALL
        SELECT c.Name, c.StartTime, c.Date AS BookingDate FROM culturaleventbooking cb INNER JOIN culturalevent c ON cb.EventID = c.EventID WHERE cb.TravelerID = ? AND c.Date < CURDATE()
        ORDER BY BookingDate DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('iii', $TravelerID, $TravelerID, $TravelerID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
