<?php

namespace app\Models;

class ReataurantModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
}