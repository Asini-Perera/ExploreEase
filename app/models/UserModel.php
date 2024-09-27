<?php

namespace app\models;

class UserModel {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM traveler WHERE TravelerID = ?");
        $stmt->bind_param("s", $id);  // "s" indicates that the parameter is a string
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    

}
