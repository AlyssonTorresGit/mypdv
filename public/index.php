<?php
require_once "../vendor/autoload.php";

require_once "../src/routes/urls.php";

use App\core\Router;

Router::dispatch();
