<?php

namespace App\Controllers;

use App\Models\Dao\FormaPagamentoDao;
use App\Models\Dao\ProdutoDao;
use App\Models\Produto;
use App\Models\Dao\ClienteDao;
use App\Services\VendaService;
use App\Models\Dao\CaixaDao;
use Exception;

class CarrinhoController extends BaseController
{
    public function gerarVenda()
    {
        if (!isset($_SESSION)):
            session_start();
        endif;

        $caixa = (new CaixaDao())->validarCaixa($_SESSION['idusuario']);

        //verfica se o caixa esta aberto
        if ($caixa[0]['EXISTE'] >= 1):
            //se for requisição POST, adiciona o produto no carrinho
            if ($_SERVER["REQUEST_METHOD"] === "POST"):

                $codigo = str_pad($_POST['codigo'], '6', '0', STR_PAD_LEFT) ?? '';
                $qtde = max(1, (int) ($_POST['qtde'] ?? 1));

                $produto = (new ProdutoDao())->obterPorCodigo($codigo);

                if (!$produto):
                    http_response_code(404);
                    echo "Produto não encontrado";
                    exit;

                endif;

                if (!isset($_SESSION['carrinho'])):
                    $_SESSION['carrinho'] = [];
                endif;

                $indiceCarrinho = array_search($codigo, array_column($_SESSION['carrinho'], 'codigo'));

                if ($indiceCarrinho === false):
                    $_SESSION['carrinho'][] = [
                        "id" =>  $produto[0]->ID,
                        "codigo" => $produto[0]->CODIGO,
                        "nome"  => $produto[0]->NOME,
                        "preco"  => $produto[0]->PRECO,
                        "desc"  => $produto[0]->DESCONTO,
                        "imagem"  => $produto[0]->IMAGEM,
                        "qtde"  => $qtde,
                    ];
                else:
                    $_SESSION['carrinho'][$indiceCarrinho]['qtde'] += $qtde;
                endif;

                echo json_encode(["status" => "ok"]);
                exit;
            endif;
            // se não for POST, carrega a tela de vendas
            require_once "../src/Views/venda/index.php";
        else:
            //Se não hober caixa aberto, redicioona para o abrir caixa
            require_once "../src/Views/venda/caixa/abrir-caixa.php";
        endif;

        exit;
    } // inserir produto
    public function atualizarCarrinho($lin)
    {
        if (!isset($_SESSION)):
            session_start();
        endif;

        //if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['linha'])):
        $linha = $lin; #$_GET['linha'];

        if (isset($_SESSION["carrinho"][$linha])):
            // Atualiza a quantidade total e remove o item do carrinho
            $_SESSION['quantidade_carrinho'] -= $_SESSION["carrinho"][$linha]["qtde"];
            unset($_SESSION["carrinho"][$linha]);
            // Reindexa o array para evitar buracos nos índices
            $_SESSION["carrinho"] = array_values($_SESSION["carrinho"]);
            header("location:/gerar-venda");
        endif;
        exit;
        // endif;
    }


    public function cancelarVenda()
    {
        if (!isset($_SESSION)):
            session_start();
        endif;

        unset($_SESSION['carrinho']);

        header("Location: /gerar-venda");
        exit;
    }

    public function consultarCarrinho()
    {
        require_once "../src/Views/venda/item-list-modal.php";
    }

    public function opcoesVenda()
    {
        $formapagamento = (new FormaPagamentoDao())->listarTodos();
        $clientes = (new ClienteDao())->listarTodos();
        require_once "../src/Views/venda/opcoes-modal.php";
    }

    /* **********************************
                FINALIZAR VENDA
     ************************************ */
    public function finalizarVenda()
    {
        // echo "Entrou no método finalizarVenda";
        // var_dump($_POST, $_SESSION);
        // exit;
        // if (!isset($_SESSION)):
        // session_start();
        // endif;
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST'):
            header("location: /");
            exit;
        endif;

        if (empty($_SESSION['carrinho'])):
            header("location: /gerar-venda");
            exit;
        endif;

        $usuario = $_SESSION['idusuario'] ?? null;
        $clienteId = $_POST['cliente'] ?? null;
        $formaPagamento = $_POST['formapagamento'] ?? null;
        // echo " $usuario <br>";
        // echo " $clienteId <br>";
        // echo " $formaPagamento <br>";
        if (!$usuario || !$clienteId || !$formaPagamento) {
            $this->loginError("Dados obrigatórios não informados.");
            return;
        }

        $itensVenda = [];
        $total = 0.0;

        foreach ($_SESSION['carrinho'] as $item) {
            $preco = (float)$item['preco'];
            $qtde = (int)$item['qtde'];
            $desconto = round(($preco * $item['desc']) / 100, 2);
            $subTotal = round(($preco * $qtde) - $desconto, 2);
            $total += $subTotal;

            $itensVenda[] = [
                'produto' => $item['id'],
                'quantidade' => $qtde,
                'valorunitario' => $preco
            ];
        }

        $dadosVenda = [
            'valor' => round($total, 2),
            'status' => 'APROVADO',
            'formaPagamento' => $formaPagamento,
            'cliente' => $clienteId,
            'usuario' => $usuario,
            'itensvenda' => $itensVenda
        ];

        $valorRecebido = isset($_POST['valorRecebido']) && $_POST['valorRecebido'] !== '' ? (float) $_POST['valorRecebido'] : $total;
        $idPagamentoDinheiro = 1; // ajuste conforme o ID real no banco        
        $troco = 0.0;

        if ((int) $formaPagamento === $idPagamentoDinheiro):
            if ($valorRecebido <= 0) :
                // $this->loginError("Informe o valor recebido em dinheiro.");
                echo 'erro soso2';
                return;
            endif;

            if ($valorRecebido < $total) :
                // $this->loginError("Valor recebido é menor que o total da compra.");
                echo 'erro soso';
                return;
            endif;

            $troco = round($valorRecebido - $total, 2);
        endif;


        try {
            $vendaService = new VendaService();
            $vendaService->inserirVenda($dadosVenda);
            unset($_SESSION['carrinho']);

            echo $this->defaultMessage(
                "Venda finalizada com sucesso! ",
                ($troco > 0 ? "Troco: R$ " . number_format($troco, 2, ',', '.') : ""),
                "/gerar-venda"
            );
        } catch (Exception $e) {
            $this->loginError("Erro ao finalizar a venda: " . $e->getMessage());
        }
    }
}
