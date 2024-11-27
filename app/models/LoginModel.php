<?php

namespace app\Models;

class LoginModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getUserByEmail($email)
    {
        $tables = ['traveler', 'hotel', 'restaurant', 'heritagemarket', 'culturaleventorganizer'];
        foreach ($tables as $table) {
            $sql = "SELECT * FROM $table WHERE Email = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch();
            if ($result) {
                return $result;
            }
        }
        return null;
    }
}