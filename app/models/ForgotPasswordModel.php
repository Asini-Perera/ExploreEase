<?php

namespace app\models;

class ForgotPasswordModel
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
    }

    public function storeToken($email, $token, $type)
    {
        // Delete any existing tokens for the user
        $sql = "DELETE FROM passwordreset WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        // Store the token in the database
        date_default_timezone_set('Asia/Colombo');
        $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));
        $sql = "INSERT INTO passwordreset (Email, Token, Expiry, UserType) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ssss', $email, $token, $expiry, $type);
        $stmt->execute();
    }

    public function validateToken($token)
    {
        date_default_timezone_set('Asia/Colombo');
        $sql = "SELECT * FROM passwordreset WHERE Token = ? AND Expiry > NOW()";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $token);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updatePassword($email, $password, $table)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE $table SET Password = ? WHERE Email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ss', $hashedPassword, $email);
        $stmt->execute();
    }

    public function deleteToken($token)
    {
        $sql = "DELETE FROM passwordreset WHERE Token = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $token);
        $stmt->execute();
    }
}
