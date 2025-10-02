<?php

namespace App\Models\Dao;

use App\core\Contexto;

class FormaPagamentoDao extends Contexto
{
    public function listarTodos(){
       return $this->listar("FORMAPAGAMENTO");
    }
}
