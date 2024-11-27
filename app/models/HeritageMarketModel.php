<?php

namespace app\Models;

class HeritageMarketModel
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
}