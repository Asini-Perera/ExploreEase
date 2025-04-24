<?php

namespace App\Controllers;

require_once '../lib/PHPMailer/PHPMailer.php';
require_once '../lib/PHPMailer/SMTP.php';
require_once '../lib/PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\RestaurantModel;

class TableBookingController
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function sendTableNo()
    {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $bookingID = $_POST['booking_id'];
        $tableNo = $_POST['table_no'];

        $restaurantModel = new RestaurantModel($this->conn);
        $restaurantID = $_POST['restaurant_id'];  
        $booking = $restaurantModel->getBookings($restaurantID);

        // Update table number
        $restaurantModel->updateTableNo($bookingID, $tableNo);

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your_email@gmail.com';
            $mail->Password   = 'your_email_password';
            $mail->SMTPSecure =  PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            $mail->setFrom('your_email@gmail.com', 'Your Restaurant');
            $mail->addAddress($booking['Email'], $booking['Name']);

            $mail->isHTML(true);
            $mail->Subject = "Your Table Number at Our Restaurant";
            $mail->Body    = "<p>Dear {$booking['Name']},</p>
                              <p>Thank you for your booking. Your table number is: <strong>{$tableNo}</strong>.</p>
                              <p>We look forward to seeing you!</p>";

            $mail->send();
            echo "Email sent successfully.";
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
    }
}
?>   