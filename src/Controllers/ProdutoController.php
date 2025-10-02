<?php

namespace App\Controllers;

use App\Models\Dao\CategoriaDao;
use App\Models\Produto;
use App\Models\Dao\ProdutoDao;
use App\Models\Dao\EstoqueDao;
use App\Services\FileUploadService;
use App\Services\ProdutoService;
use App\Controllers\BaseController;


class ProdutoController extends BaseController
{
    private $produto;
    private $produtoDao;
    private $estoqueDao;
    private $categoriaDao;
    private $produtoService;
    private $fileUploadService;

    public function __construct()
    {
        $this->produto = new Produto();
        $this->produtoDao = new ProdutoDao();
        $this->estoqueDao = new EstoqueDao();
        $this->categoriaDao = new CategoriaDao();
        $this->categoriaDao = new CategoriaDao();
       $this->produtoService = new ProdutoService($this->produtoDao);
        $this->fileUploadService = new FileUploadService('lib/img/upload/produtos');
    }

    public function index($id = null)
    {
        $method = $_SERVER["REQUEST_METHOD"];
        $categorias = $this->categoriaDao->listarTodos();
        $estoque = $this->estoqueDao->listarTodos();

        if ($method === "GET" && $id) {
            $produtos = $this->produtoDao->obterPorId($id);            
            $this->render("produto/index", ["produtos" => $produtos, "id" => $id, "categorias" => $categorias, 'estoque'=>$estoque]);
        }

        if ($method === 'POST') {
            // Determina se será uma inserção ou alteração com base no ID
            if ($_POST['id']) {
                $this->alterar($_POST,$_FILES);
            } else {
                $this->inserir($_POST, $_FILES);
            }
        }
        $this->render("produto/index", ["categorias" => $categorias, 'estoque'=> $estoque]);
    }

    public function listar()
    {
        $produtos = $this->produtoDao->listarTodos();
        $estoque = $this->estoqueDao->listarTodos();
        $this->render("produto/listar", ["produtos" => $produtos, 'estoque'=> $estoque]);
    }

        public function consultar()
    {
        $produtos = $this->produtoDao->listarTodos();
        $estoque = $this->estoqueDao->listarTodos();
        require_once "../src/Views/venda/produto-modal.php";
    }


    public function inserir($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Valida e cria o usuário via serviço dedicado
        $retorno = $this->produtoService->adicionarProduto($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Produto Cadastrado com sucesso", "/listar-produtos");
    }

    // Função responsável por alterar os dados de um usuário
    public function alterar($dados, $files)
    {
        $picture = '';
        // Utiliza o serviço de upload para lidar com a imagem
        if(!is_null($files)):
            $picture = $files['imagem'];
        endif;
        
        $imagem = $this->fileUploadService->upload($picture);

        // Atualiza o usuário via serviço dedicado
        $retorno = $this->produtoService->alterarProduto($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Produto Alterado com sucesso", "/listar-produtos");
    }
// metodo responsavel por avisar o usuario da exclusão
    function deleteConfirm($id)
    {         
        if ($id):
            echo $this->confirm('Deseja realmente excluir este produto',"/excluir-produto/{$id}", "/listar-produtos");
        endif;
        require_once "../src/Views/shared/header.php";
    }
// metodo responsavel por excluir um objeto no banco de dados
    function excluir($id)
    {
        if ($id): 
            $this->produtoDao->excluir($id);
            echo $this->success('Produto Excluido com sucesso!', '/listar-produtos');
        endif;

        require_once "../src/Views/shared/header.php";
    }

    public function alterarStatus($id,$ativo)
    {
        if ($id):
            $produto = new Produto($id, "","","","","","","","","","",$ativo,"");
            $this->produtoDao->alterar($produto);
        endif;
    }

}
