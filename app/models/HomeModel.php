<?php

namespace app\Models;

class HomeModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function saveReview($name, $email, $rating, $comment)
    {
        $sql = "INSERT INTO feedback (Name, Email, Rating, Comment) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssis", $name, $email, $rating, $comment);
        $stmt->execute();
    }

    public function getReviews()
    {
        $sql = "SELECT * FROM feedback ORDER BY RAND()";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
