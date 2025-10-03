<?php

namespace App\Models\Dao;

use App\core\Contexto;
use App\Models\Estoque;

class EstoqueDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('ESTOQUE');
    }
    public function obterPorId($id)
    {
        return $this->listar('ESTOQUE', "WHERE ID = ?", [$id]);
    }

    public function adicionar(Estoque $estoque)
    {
        $atributos = array_keys($estoque->atributosPreenchidos());
        $valores = array_values($estoque->atributosPreenchidos());
        return $this->inserir('ESTOQUE', $atributos, $valores);
    }

    public function alterar(Estoque $estoque)
    {
        $atributos = array_keys($estoque->atributosPreenchidos());
        $valores = array_values($estoque->atributosPreenchidos());
        return $this->atualizar('ESTOQUE', $atributos, $valores, $estoque->getId());
    }
    public function excluir($id)
    {
        return $this->deletar('ESTOQUE', $id);
    }
}
