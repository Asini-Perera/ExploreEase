<?php

namespace app\controllers;

// Include PHPMailer classes
require_once __DIR__ . '/../../libs/PHPMailer/src/PHPMailer.php';
require_once __DIR__ . '/../../libs/PHPMailer/src/SMTP.php';
require_once __DIR__ . '/../../libs/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use app\models\ForgotPasswordModel;

class ForgotPasswordController
{
    private $conn;

    public function __construct()
    {
        require_once __DIR__ . '/../../config/config.php';
        global $conn;
        $this->conn = $conn;

        // Include the AdminModel
        require_once __DIR__ . '/../models/ForgotPasswordModel.php';
    }
    public function index()
    {
        // Logic for admin forgot password
        require_once __DIR__ . '/../views/forgot_password.php';
    }

    public function request()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];

            // Check if the email exists in the database
            $forgotPasswordModel = new ForgotPasswordModel($this->conn);
            $user = $forgotPasswordModel->getUserByEmail($email);

            if ($user) {
                // Generate a unique token
                $token = bin2hex(random_bytes(50));
                $forgotPasswordModel->storeToken($email, $token, $user['Type']);

                // Send reset link with email
                $resetLink = "http://localhost/ExploreEase/reset?token=" . $token;
                
                $mail = new PHPMailer(true); // Create a new PHPMailer instance

                try {
                    // Server settings
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->Username = 'exploreease10@gmail.com'; // SMTP username
                    $mail->Password = 'tzes gckv czrx kgso'; // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                    $mail->Port = 587; // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                    // Recipients
                    $mail->setFrom('exploreease10@gmail.com', 'ExploreEase');
                    $mail->addAddress($email); // Add a recipient

                    // Content
                    $mail->isHTML(true); // Set email format to HTML
                    $mail->Subject = 'Reset your password';
                    $mail->Body = "Click <a href='$resetLink'>here</a> to reset your password.";

                    $mail->send();

                    // Set success message
                    $_SESSION['success'] = "Password reset link sent to your email.";
                } catch (Exception $e) {
                    // Set error message
                    $_SESSION['error'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                // Set error message
                $_SESSION['error'] = "No account found with that email.";
            }

            // Redirect to forgot password page
            header('Location: forgot');
            exit();
        }
    }

    public function reset()
    {
        // Logic for reset password page
        require_once __DIR__ . '/../views/reset_password.php';
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $newPassword = $_POST['password'];
            

            // Validate the token
            $forgotPasswordModel = new ForgotPasswordModel($this->conn);
            $tokenData = $forgotPasswordModel->validateToken($token);

            if ($tokenData) {
                // Update the password
                $forgotPasswordModel->updatePassword($tokenData['Email'], $newPassword, $tokenData['User_Type']);

                // Delete the token
                $forgotPasswordModel->deleteToken($token);

                // Set success message
                $_SESSION['success'] = "Password reset successfully.";

                // Redirect to login page
                switch ($tokenData['Table']) {
                    case 'admin':
                        header('Location: ../admin');
                        break;
                    case 'traveler':
                        header('Location: ../login');
                        break;
                    case 'hotel':
                        header('Location: ../hotel');
                        break;
                    case 'restaurant':
                        header('Location: ../restaurant');
                        break;
                    case 'heritagemarket':
                        header('Location: ../heritagemarket');
                        break;
                    case 'culturaleventorganizer':
                        header('Location: ../culturaleventorganizer');
                        break;
                }
                exit();
            } else {
                // Set error message
                $_SESSION['error'] = "Invalid or expired token." .  var_dump($token);

                // Redirect to forgot password page
                header('Location: forgot');
                exit();
            }
        }
    }
}
