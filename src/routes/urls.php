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
Router::add("GET", "/deletar-usuarios/{id}", UsuarioController::class, "deleteConfirm");
Router::add("GET", "/ecluir-usuarios/{id}", UsuarioController::class, "excluir");
Router::add("GET", "/alterar-status/{id}/{status}", UsuarioController::class, "alterarStatus");
