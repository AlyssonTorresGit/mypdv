<?php

namespace App\routes;

use App\core\Router;
use App\Controllers\BaseController;
use App\Controllers\ClienteController;
use App\Controllers\PainelController;
use App\Controllers\UsuarioController;
use App\Controllers\ProdutoController;
use App\Controllers\CategoriaController;
use App\Controllers\ConfiguracaoController;
use App\Controllers\CarrinhoController;
use App\Controllers\RelatorioController;

Router::add("GET","/",BaseController::class,"home");
Router::add("POST","/",BaseController::class,"home");
Router::add("GET","/painel-controle",PainelController::class,"index");
Router::add("GET","/cadastrar-usuario",UsuarioController::class,"index");
Router::add("POST","/cadastrar-usuario",UsuarioController::class,"index");
Router::add("GET","/listar-usuarios",UsuarioController::class,"listar");
Router::add("GET","/editar-usuario/{id}",UsuarioController::class,"index");
Router::add("GET","/deletar-usuario/{id}",UsuarioController::class,"deleteConfirm");
Router::add("GET","/excluir-usuario/{id}",UsuarioController::class,"excluir");
Router::add("GET","/alterar-status-usuario/{id}/{status}",UsuarioController::class,"alterarStatus");
Router::add("GET","/logout",UsuarioController::class,"logout");
// ROTAS DE PRODUTOS
Router::add("GET","/cadastrar-produto",ProdutoController::class,"index");
Router::add("POST","/cadastrar-produto",ProdutoController::class,"index");
Router::add("GET","/listar-produtos",ProdutoController::class,"listar");
Router::add("GET","/consultar-produtos",ProdutoController::class,"consultar");
Router::add("GET","/editar-produto/{id}",ProdutoController::class,"index");
Router::add("GET","/deletar-produto/{id}",ProdutoController::class,"deleteConfirm");
Router::add("GET","/excluir-produto/{id}",ProdutoController::class,"excluir");
Router::add("GET","/alterar-status-produto/{id}/{status}",ProdutoController::class,"alterarStatus");
// ROTAS DE CLIENTE
Router::add("GET","/cadastrar-cliente",ClienteController::class,"index");
Router::add("POST","/cadastrar-cliente",ClienteController::class,"index");
Router::add("GET","/listar-clientes",ClienteController::class,"listar");
Router::add("GET","/consultar-clientes",ClienteController::class,"consultar");
Router::add("GET","/editar-cliente/{id}",ClienteController::class,"index");
Router::add("GET","/deletar-cliente/{id}",ClienteController::class,"deleteConfirm");
Router::add("GET","/excluir-cliente/{id}",ClienteController::class,"excluir");
Router::add("GET","/alterar-status-cliente/{id}/{status}",ClienteController::class,"alterarStatus");
// ROTAS DE CATEGORIA
Router::add("GET","/cadastrar-categoria",CategoriaController::class,"index");
Router::add("POST","/cadastrar-categoria",CategoriaController::class,"index");
Router::add("GET","/listar-categorias",CategoriaController::class,"listar");
Router::add("GET","/editar-categoria/{id}",CategoriaController::class,"index");
Router::add("GET","/deletar-categoria/{id}",CategoriaController::class,"deleteConfirm");
Router::add("GET","/excluir-categoria/{id}",CategoriaController::class,"excluir");
Router::add("GET","/alterar-status-categoria/{id}/{status}",CategoriaController::class,"alterarStatus");
// ROTAS DE CONFIGURACAO
Router::add("GET","/cadastrar-configuracao",ConfiguracaoController::class,"index");
Router::add("POST","/cadastrar-configuracao",ConfiguracaoController::class,"index");
Router::add("GET","/listar-configuracoes",ConfiguracaoController::class,"listar");
Router::add("GET","/editar-configuracao/{id}",ConfiguracaoController::class,"index");
Router::add("GET","/deletar-configuracao/{id}",ConfiguracaoController::class,"deleteConfirm");
Router::add("GET","/excluir-configuracao/{id}",ConfiguracaoController::class,"excluir");
Router::add("GET","/alterar-status-configuracao/{id}/{status}",ConfiguracaoController::class,"alterarStatus");

Router::add("GET","/gerar-venda",CarrinhoController::class,"gerarVenda");
Router::add("POST","/gerar-venda",CarrinhoController::class,"gerarVenda");
Router::add("GET","/consultar-carrinho",CarrinhoController::class,"consultarCarrinho");
Router::add("GET","/excluir-item-carrinho/{linha}",CarrinhoController::class,"atualizarCarrinho");
Router::add("GET","/cancelar-venda",CarrinhoController::class,"cancelarVenda");
Router::add("GET","/opcoes-venda",CarrinhoController::class,"opcoesVenda");
Router::add("POST","/finalizar-venda",CarrinhoController::class,"finalizarVenda");
// ROTAS PARA PAGINA DE RELATÓRIOS
Router::add("GET","/relatorios",RelatorioController::class,"relatorio");
Router::add("GET","/relatorios/gerar",RelatorioController::class,"gerarRelatorio");
