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
Router::add("GET", "/listar-usuario", UsuarioController::class, "listar");
Router::add("GET", "/editar-usuario/{id}", UsuarioController::class, "index");
Router::add("GET", "/deletar-usuario/{id}", UsuarioController::class, "deleteConfirm");
Router::add("GET", "/ecluir-usuario/{id}", UsuarioController::class, "excluir");
Router::add("GET", "/alterar-status/{id}/{status}", UsuarioController::class, "alterarStatus");
