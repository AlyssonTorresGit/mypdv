<?php

namespace App\Controllers;

use App\Models\Dao\CaixaDao;
use App\Models\Dao\UsuarioDao;
use App\Models\Notifications;

class BaseController extends Notifications
{

    public function home(): void
    {
        require_once "../src/Views/home/index.php";

        if ($_SERVER['REQUEST_METHOD'] === 'POST'):

            $usuario = $_POST['usuario'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $dadosUsuario = (new UsuarioDao())->autenticar($usuario);

            if (!empty($dadosUsuario) && password_verify($senha, $dadosUsuario[0]->SENHA)):
                $this->gerraSessao($dadosUsuario);

                $caixa = (new CaixaDao())->validarCaixa($_SESSION['idusuario']);

                if ($caixa[0]['EXISTE'] >= '1'):
                    header("Location:/gerar-venda");
                else:
                    header("Location:/abrir-caixa");
                endif;

                exit;
            else :
                echo $this->loginError('Usuario ou senha incorreto!');
            endif;

        endif;
    }

    public function gerraSessao($usuario)
    {
        $_SESSION['idusuario'] = $usuario[0]->ID;
        $_SESSION['nome'] = $usuario[0]->NOME;
        $_SESSION['imagem'] = $usuario[0]->IMAGEM;
    }
    // METODO RESPONSAVEL POR RENDERIZAR AS ROTAS
    public function render(string $view, array $data = [])
    {
        extract($data);

        ob_start();
        require_once __DIR__ . "/../Views/{$view}.php";
        $content = ob_get_clean();

        require_once __DIR__ . "/../Views/painel/index.php";
    }
}
