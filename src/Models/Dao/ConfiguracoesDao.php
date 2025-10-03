<?php

namespace App\Models\Dao;

use App\core\Contexto;
use App\Models\Configuracoes;

class ConfiguracoesDao extends Contexto
{  
    public function listarTodos()
    {
        return $this->listar('CONFIGURACOES');
    }
    public function obterPorId($id)
    {
        return $this->listar('CONFIGURACOES', "WHERE ID = ?", [$id]);
    }

    public function adicionar(Configuracoes $configuracoes)
    {
        $atributos = array_keys($configuracoes->atributosPreenchidos());
        $valores = array_values($configuracoes->atributosPreenchidos());
        return $this->inserir('CONFIGURACOES', $atributos, $valores);
    }

    public function alterar(Configuracoes $configuracoes)
    {
        $atributos = array_keys($configuracoes->atributosPreenchidos());
        $valores = array_values($configuracoes->atributosPreenchidos());
        return $this->atualizar('CONFIGURACOES', $atributos, $valores, $configuracoes->getId());
    }
    public function excluir($id)
    {
        return $this->deletar('CONFIGURACOES', $id);
    }
}
