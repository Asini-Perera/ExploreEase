<?php

namespace app\Controllers;

class KeywordController
{
    public function traveler()
    {
        require_once __DIR__ . '/../views/keyword_traveler.php';
    }

    public function serviceprovider()
    {
        require_once __DIR__ . '/../views/keyword_serviceprovider.php';
    }

    public function keywordsearch()
    {
        require_once __DIR__ . '/../views/keyword_search.php';
    }
}
