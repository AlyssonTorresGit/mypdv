<?php

namespace App\Controllers;

class BaseController
{
    public function index()
    {
        require_once "../src/views/home/index.php";
    }
}
