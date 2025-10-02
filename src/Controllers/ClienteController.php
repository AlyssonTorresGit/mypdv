<?php

namespace App\Controllers;

use App\Configurations\Formater;

session_start();

use App\Models\Cliente;
use App\Models\Dao\ClienteDao;
use App\Models\Notifications;
use App\Services\FileUploadService;
use App\Services\ClienteService;

class ClienteController extends BaseController
{
  private $clienteDao;
  private $fileUploadService;
  private $clienteService;

  // Injeção de dependências para melhor testabilidade e organização
  public function __construct()
  {
    $this->clienteDao = new ClienteDao();
    $this->fileUploadService = new FileUploadService("lib/img/upload/clientes");
    $this->clienteService = new ClienteService($this->clienteDao);
  }

  // Função responsável por listar todos os usuários
  public function listar()
  {
    // Separação da responsabilidade de buscar os dados e exibir a view
    $clientes = $this->clienteDao->ListarTodos();
    $this->render("cliente/listar", ["clientes" => $clientes]);
  }
    public function consultar()
  {
    // Separação da responsabilidade de buscar os dados e exibir a view
    $clientes = $this->clienteDao->ListarTodos();
    require_once "../src/Views/venda/cliente-modal.php";
  }


  // Função principal de gerenciamento de usuários (inserção, alteração e listagem)
  public function index($id = null)
  {
      $method = $_SERVER["REQUEST_METHOD"];

      if ($method === "GET" && $id) {
      // Recupera dados para edição de usuário
      $cliente = $this->clienteDao->obterPorId($id);
      $this->render("cliente/index", ["cliente" => $cliente, "id"=> $id]);
    }

    if ($method === "POST") {
      // Determina se será uma inserção ou alteração com base no ID
      if ($_POST['id']) {
        $this->alterar($_POST, $_FILES);
      } else {
        $this->inserir($_POST, $_FILES);
      }
    }
    $this->render("cliente/index");
  }

  // Função responsável por inserir um usuário
  public function inserir($dados, $files)
  {
    // Utiliza o serviço de upload para lidar com a imagem
    $imagem = $this->fileUploadService->upload($files['imagem']);

    // Valida e cria o usuário via serviço dedicado
    $retorno = $this->clienteService->adicionarCliente($dados, $imagem);

    // Exibe mensagem de sucesso
    echo $this->Success("Cliente Cadastrado com sucesso!", "/listar-clientes");
  }

  // Função responsável por alterar os dados de um usuário
  public function alterar($dados, $files)
  {
    // Utiliza o serviço de upload para lidar com a imagem
    $imagem = $this->fileUploadService->upload($files['imagem']);

    // Atualiza o usuário via serviço dedicado
    $retorno = $this->clienteService->alterarCliente($dados, $imagem);

    // Exibe mensagem de sucesso
    echo $this->Success("Cliente Cadastrado com sucesso!", "/listar-clientes");
  }

  // Confirmação de exclusão de usuário
  public function deleteConfirm( $id)
  {
    if ($id) {
      echo $this->Confirm("Deseja realmente Excluir cliente?", "/excluir-cliente/{$id}", "/listar-clientes");
    }
    require_once "../src/Views/shared/header.php";
  }

  // Função responsável por excluir um usuário
  public function excluir($id)
  {
    if ($id) {
      $this->clienteDao->excluir($id);
      echo $this->Success("Cliente Excluido com sucesso!", "/listar-clientes");
    }

    require_once "../src/Views/shared/header.php";
  }
  
  public function validarDadosCliente()
  {

    header("Content-Type: application/json; charset=UTF-8");
    $dados = json_decode(file_get_contents("php://input"), true);

    if (!isset($dados['campo']) || !isset($dados["valor"])):
      echo (json_encode(["erro" => "Dados Invalidos"]));
      exit;
    endif;

    $campo = trim($dados['campo']);
    $valor = trim($dados['valor']);

    $existe = $this->clienteDao->validarDados($campo, $valor);

    echo json_encode(["existe" => $existe ? true : false]);
    exit;
  }
}
