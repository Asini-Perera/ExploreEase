<?php

namespace app\models;

class AdminModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAdminByID($AdminID) {
        $sql = "SELECT * FROM Admin WHERE AdminID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('s', $AdminID);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }       
    
}