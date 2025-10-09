<?php

namespace App\Controllers;

session_start();

use App\Models\usuario;
use App\Models\Dao\PerfilDao;
use App\Models\Dao\usuarioDao;
use App\Controllers\BaseController;
use App\Services\FileUploadService;
use App\Services\userService;

class UsuarioController extends BaseController
{
    private $usuarioDao;
    private $perfilDao;
    private $fileUploadService;
    private $usuarioService;

    // Injeção de dependências para melhor testabilidade e organização
    public function __construct()
    {
        $this->usuarioDao = new UsuarioDao();
        $this->perfilDao = new PerfilDao();
        $this->fileUploadService = new FileUploadService("lib/img/upload/users");
        $this->usuarioService = new UserService($this->usuarioDao);
    }

    // Função responsável por listar todos os usuários
    public function listar()
    {
        // Separação da responsabilidade de buscar os dados e exibir a view
        $usuarios = (new UsuarioDao())->ListarTodos();
        $perfis = $this->perfilDao->listarTodos();
        $perfis = (new PerfilDao())->listarTodos(); // ← carrega os perfis
        // require_once "Views/painel/index.php";
        $this->render("usuario/listar", [
            "usuarios" => $usuarios,
            "perfis" => $perfis
        ]);
    }

    // Função principal de gerenciamento de usuários (inserção, alteração e listagem)
    public function index($id = null,)
    {

        $method = $_SERVER["REQUEST_METHOD"];

        $perfis = $this->perfilDao->listarTodos();

        if ($method === "GET" && $id) {
            $usuario = $this->usuarioDao->obterPorId($id);
            $this->render("usuario/index", ["usuario" => $usuario, "id" => $id, "perfis" => $perfis]);
        }

        if ($method === "POST") {
            if ($_POST['id']) {
                $this->alterar($_POST, $_FILES);
            } else {
                $this->inserir($_POST, $_FILES);
            }
        }
        // Carrega todos os usuários para listar
        $usuario = $this->usuarioDao->listarTodos();
        $this->render("usuario/index", [
            'usuarios' => $usuario,
            'perfis' => $perfis
        ]);
    }

    // Função responsável por inserir um usuário
    public function inserir($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Valida e cria o usuário via serviço dedicado
        $retorno = $this->usuarioService->adicionarusuario($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success("Usuario Cadastrado com sucesso", "/listar-usuario");
    }

    // Função responsável por alterar os dados de um usuário
    public function alterar($dados, $files)
    {
        // Utiliza o serviço de upload para lidar com a imagem
        $imagem = $this->fileUploadService->upload($files['imagem']);

        // Atualiza o usuário via serviço dedicado
        $retorno = $this->usuarioService->alterarusuario($dados, $imagem);

        // Exibe mensagem de sucesso
        echo $this->Success(" alterado com sucesso!", "/listar-usuario");
    }

    // Confirmação de exclusão de usuário
    public function deleteConfirm($id)
    {

        if ($id) {
            $this->usuarioDao->excluir($id);
            echo $this->Confirm("deseja realmente excluir", "/excluir-usuario/{$id}", "/listar-usuario");
        }

        require_once __DIR__ . "/../Views/shared/header.php";
    }

    // Função responsável por excluir um usuário
    public function excluir($id)
    {

        if ($id) {
            $this->usuarioDao->excluir($id); // aqui é realmente a exclusão
            echo $this->Success("Usuario excui do com sucesso! excluir",  "/listar-usuario");
            // echo $this->Success("Usuario excluido com sucesso!", "/listar-usuario");
        }

        require_once __DIR__ . "/../Views/shared/header.php";
    }
    public function alterarStatus($id, $status)
    {
        if ($id) :
            $usuario = new Usuario($id, "", "", "", "", "", $status);
            $this->usuarioDao->alterar($usuario);
        endif;
    }
}

//     public function logout()
//     {
//         session_destroy();
//         header("location:/");
//     }
// }
