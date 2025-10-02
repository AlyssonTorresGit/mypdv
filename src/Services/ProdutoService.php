<?php

namespace App\Services;

use App\Models\Dao\EstoqueDao;
use App\Models\Dao\ProdutoDao;
use App\Models\Produto;
use App\Models\Estoque;

class ProdutoService
{
    private $produtoDao;
    private  $estoqueDao;
    private $fileUploadService;

    public function __construct(ProdutoDao $produtoDao)
    {
        $this->produtoDao = $produtoDao;
        $this->estoqueDao = new EstoqueDao();
    }

    public function adicionarProduto($dados, $imagem)
    {
         $codigo = $this->produtoDao->ObterUltimoRegistro('CODIGO');

        $produto = new Produto();
        $dados['imagem'] = $imagem;
        $dados['codigo'] = str_pad($codigo[0]->ULTIMOVALOR + 1, 6, '0', STR_PAD_LEFT);

        foreach ($dados as $chave => $valor) {
            $produto->$chave = $valor;
        }

        //return $this->produtoDao->Adicionar($produto);
        $produtoId = $this->produtoDao->Adicionar($produto);  
        $this->inserirEstoque($dados,$produtoId); 
   
    return true;
    }

    public function alterarProduto($dados, $imagem)
    {
        $produtoId = $dados['id'];
        $idEstoque = $dados['idestoque'];
        
        $produto = new Produto();
        $dados['imagem'] = $imagem ?: '';

        foreach ($dados as $chave => $valor) {
            $produto->$chave = $valor;
        }

        if($idEstoque):
            $estoque = new Estoque(
                id: $idEstoque,
                produto: $produtoId,
                quantidade: (int)($dados['quantidade'] ?? 0),
                estoqueminimo: (int)($dados['estoqueminimo'] ?? 0),
                datacadastro: date('Y-m-d H:i:s')
            );
            $this->estoqueDao->alterar($estoque);
        else:
            $this->inserirEstoque($dados,$produtoId);
        endif;        
        
        $this->produtoDao->alterar($produto);

    }

    public function inserirEstoque($dados, $id){
        $produtoId = $id;
        $estoque = new Estoque(
            id: 0,
            produto: $produtoId,
            quantidade: (int)($dados['quantidade'] ?? 0),
            estoqueminimo: (int)($dados['estoqueminimo'] ?? 0),
            datacadastro: date('Y-m-d H:i:s')
        );
        
        $this->estoqueDao->Adicionar($estoque);
    }
}