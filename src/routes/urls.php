<?php

namespace App\routes;

use App\core\Router;
use App\controllers\BaseController;
use App\Controllers\PainelController;
use App\Controllers\UsuarioController;

Router::add("GET", "/", BaseController::class, "index");
Router::add("GET", "/painel-controle", PainelController::class, "index");

Router::add("GET", "/cadastrar-usuario", UsuarioController::class, "index");
Router::add("POST", "/cadastrar-usuario", UsuarioController::class, "index");
Router::add("GET", "/listar-usuarios", UsuarioController::class, "listar");
