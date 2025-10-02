<?php

namespace App\routes;

use App\core\Router;
use App\controllers\BaseController;

Router::add("GET", "/", BaseController::class, "index");
