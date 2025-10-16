<?php

namespace App\Controllers;

use App\Models\Caixa;
use App\Models\Dao\CaixaDao;

class CaixaController extends BaseController
{
    public function abrirCaixa()
    {
        if (!isset($_SESSION)):
            session_start();
        endif;

        if ($_SERVER["REQUEST_METHOD"] === "POST"):
            $valorinicial = htmlspecialchars($_POST['saldoincial']);
            $usuario = $_SESSION['idusuario'];
            $caixa = new Caixa(null, $usuario, '', $valorinicial, '', 'ABERTO');
            $caixaDao = (new CaixaDao())->adicionar($caixa);

            echo $this->success('Caixa aberto', '/gerar-venda');
        endif;
        require_once "../src/views/venda/caixa/abrir-caixa.php";
    }
}
