<?php

namespace app\models;

class User {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM traveler WHERE TravelerID = ?");
        $stmt->bind_param("s", $id);  // "s" indicates that the parameter is a string
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
}
