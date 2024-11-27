<?php

namespace app\Models;

class HotelModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
}