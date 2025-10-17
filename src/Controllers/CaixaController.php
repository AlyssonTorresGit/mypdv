<?php

namespace App\Controllers;

use App\Models\Caixa;
use App\Models\Dao\CaixaDao;
use APP\Models\Dao\UsuarioDao;
use App\Models\Movimentacao;

class CaixaController extends BaseController
{
    private CaixaDao $caixaDao;
    public function __construct(?CaixaDao $caixaDao = null)
    {
        $this->caixaDao = $caixaDao ?? new CaixaDao;
    }
    public function listarCaixa()
    {
        $caixas = $this->caixaDao->listarCaixas();
        $this->render("venda/caixa/listar", ["caixas" => $caixas]);
    }

    public function historicoCaixa()
    {
        $caixas = $this->caixaDao->listarCaixas();
        $this->render("venda/caixa/historico", ["caixas" => $caixas]);
    }
    public function fecharCaixa($id = null)
    {
        if ($_SERVER['REQUEST_METHOD'] === "POST"):
            $idcaixa = htmlspecialchars($_POST['id']);
            $idusuario = htmlspecialchars($_POST['usuario']);
            $total = htmlspecialchars($_POST['totalfechamento']);

            $data = date("Y-m-d H:m:s");


            $movimentacao = new Movimentacao(null, $idcaixa, $idusuario, $total);
            $caixa = new Caixa($idcaixa, "", $data, "", $total, "fechado");

            $this->caixaDao->fecharCaixa($movimentacao);
            $this->caixaDao->alterar($caixa);

            echo $this->success("Caixa Fechado com sucesso", "/listar-caixas");


        endif;

        $this->render("venda/caixa/fechar-caixa", ["id" => $id]);
    }
    public function abrirCaixa()
    {
        if (!isset($_SESSION)):
            session_start();
        endif;

        if ($_SERVER["REQUEST_METHOD"] === "POST"):
            $valorinicial = htmlspecialchars($_POST['saldoincial']);
            $usuario = $_SESSION['idusuario'];
            $caixa = new Caixa(null, $usuario, '', $valorinicial, '', 'ABERTO');
            $this->caixaDao->adicionar($caixa);

            echo $this->success('Caixa aberto', '/gerar-venda');
        endif;
        require_once "../src/views/venda/caixa/abrir-caixa.php";
    }
}
