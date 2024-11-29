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
        $userTables = ['traveler', 'hotel', 'restaurant', 'heritagemarket', 'culturaleventorganizer'];
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
}
