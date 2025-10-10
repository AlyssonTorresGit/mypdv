<?php

namespace App\Controllers;


use App\Models\Configuracoes;
use App\Models\Dao\ConfiguracoesDao;
use App\Services\FileUploadService;
use App\Services\ConfiguracoesService;
use App\Controllers\BaseController;


class ConfiguracaoController extends BaseController
{
    private $configuracoes;
    private $configuracoesDao;
    private $configuracoesService;
    private $fileUploadService;

    public function __construct()
    {
        $this->configuracoes = new Configuracoes();
        $this->configuracoesDao = new ConfiguracoesDao();
       $this->configuracoesService = new ConfiguracoesService($this->configuracoesDao);
        $this->fileUploadService = new FileUploadService('lib/img/upload/configuracoes/');
    }

    public function index($id = null)
    {
        $method = $_SERVER["REQUEST_METHOD"];

        if ($method === "GET" && $id) {
            $configuracoes = $this->configuracoesDao->obterPorId($id);            
            $this->render("configuracao/index", ["configuracoes" => $configuracoes, "id" => $id]);
        }

        if ($method === 'POST') {
            // Determina se será uma inserção ou alteração com base no ID
            if ($_POST['id']) {
                $this->alterar($_POST,$_FILES);
            } else {
                $this->inserir($_POST, $_FILES);
            }
        }
        $this->render("configuracao/index");
    }

    public function listar()
    {
        $configuracoes = $this->configuracoesDao->listarTodos();
        $this->render("configuracao/listar", ["configuracoes" => $configuracoes]);
    }

    public function inserir($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Valida e cria o usuário via serviço dedicado
        $retorno = $this->configuracoesService->adicionarConfiguracoes($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Cadastro realizado com sucesso", "/listar-configuracoes");
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
        $retorno = $this->configuracoesService->alterarConfiguracoes($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Alterado com sucesso", "/listar-configuracoes");
    }
// metodo responsavel por avisar o usuario da exclusão
    function deleteConfirm($id)
    {         
        if ($id):
            echo $this->confirm('Deseja realmente excluir',"/excluir-configuracao/{$id}", "/listar-configuracoes");
        endif;
        require_once "../src/Views/shared/header.php";
    }
// metodo responsavel por excluir um objeto no banco de dados
    function excluir($id)
    {
        if ($id): 
            $this->configuracoesDao->excluir($id);
            echo $this->success('Excluido com sucesso!', '/listar-configuracoes');
        endif;

        require_once "../src/Views/shared/header.php";
    }
}
