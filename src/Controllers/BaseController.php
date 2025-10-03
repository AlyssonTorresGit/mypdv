<?php

namespace App\Controllers;

use App\Models\Notifications;

class BaseController extends Notifications
{
    public function index()
    {
        require_once "../src/views/home/index.php";
    }
    public function render(string $view, array $data = [])
    {
        extract($data);
        ob_start();
        require_once "../src/Views/{$view}.php";
        $content = ob_get_clean();

        require_once "../src/views/painel/index.php";
    }
}
