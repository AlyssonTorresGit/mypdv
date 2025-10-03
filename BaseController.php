<?php

namespace App\Controllers;

class BaseController
{
    public function index()
    {
        require_once "../src/Views/usuario/index.php";
    }
    public function listar()
    {
        require_once "../src/Views/usuario/listar.php";
    }
}
