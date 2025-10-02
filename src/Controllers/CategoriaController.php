<?php

namespace App\Controllers;

use App\Models\Categoria;
use App\Models\Dao\CategoriaDao;
use App\Models\Notifications;
use App\Services\CategoriaService;
use App\Controllers\BaseController;

class CategoriaController extends BaseController
{
    private $categoria;
    private $categoriaDao;
    private $categoriaService;

    public function __construct()
    {
        $this->categoria = new Categoria();
        $this->categoriaDao = new CategoriaDao();
        $this->categoriaService = new CategoriaService($this->categoriaDao);
    }
    // METODO RESPONSAVEL POR VALIDAR OS DADOS E ENVIAR PARA SEU METODO RESPONSAVEL
    public function index($id = null)
    {
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method === "GET" && $id) {
            // Recupera dados para edição de usuário
            $categoria = $this->categoriaDao->obterPorId($id);
            $this->render("categoria/index", ["categoria" => $categoria, "id" => $id]);
        }

        if ($method === "POST") {
            if ($_POST['id']) {
                $this->alterar($_POST);
            } else {
                $this->inserir($_POST);
            }
        }

        $this->render("categoria/index");
    }

    public function listar()
    {
        $categorias = $this->categoriaDao->listarTodos();
        $this->render("categoria/listar", ["categorias" => $categorias]);
    }
    // metodo responsavel por inserir registros no banco de dados
    public function inserir($dados)
    {
        $retorno = $this->categoriaService->adicionarCategoria($dados);
        echo $this->Success("Categoria Cadastrada com sucesso!", "/listar-categorias");
    }
    // metodo responsavel por atualizar registros no banco de dados
    public function alterar($dados)
    {
        $retorno = $this->categoriaService->alterarCategoria($dados);
        echo $this->Success("Categoria Alterada com sucesso!", "/listar-categorias");
    }

    function deleteConfirm( $id)
    {
        if ($id):
            echo $this->confirm("Deseja realmente Excluir Categoria?", "/excluir-categoria/{$id}", "/listar-categorias");
        endif;
        require_once "../src/Views/shared/header.php";
    }
    // metodo responsavel por excluir um objeto no banco de dados
    function excluir($id)
    {
        if ($id):
            $this->categoriaDao->excluir($id);
            echo $this->success('Categoria Excluida com sucesso!', '/listar-categorias');
        endif;

        require_once "../src/Views/shared/header.php";
    }

    public function alterarStatus($id, $ativo)
    {
        if ($id):
            $categoria = new Categoria($id, "", $ativo);
            $this->categoriaDao->alterar($categoria);
        endif;
    }
}
