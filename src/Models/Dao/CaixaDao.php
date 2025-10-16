<?php

namespace App\Models\Dao;

use App\core\Contexto;
use App\Models\Caixa;
use PDO;

class CaixaDao extends Contexto
{
    public function listarTodos()
    {
        return $this->listar('CAIXA');
    }
    public function obterPorId($id)
    {
        return $this->listar('CAIXA', 'WHERE ID = ?', [$id]);
    }
    public function adicionar(Caixa $caixa)
    {
        $atributos = array_keys($caixa->atributosPreenchidos());
        $valores = array_values($caixa->atributosPreenchidos());
        return $this->inserir('CAIXA', $atributos, $valores);
    }
    public function validarCaixa($id)
    {
        $sql = "SELECT COUNT(1) AS EXISTE
                  FROM caixa c INNER JOIN
                       usuario u ON(u.id = c.usuario) LEFT JOIN
                       movimentacao m ON(m.caixa = c.id)
                 WHERE c.usuario = :id AND
                       c.status = 'ABERTO' ";

        $stmt = self::getConexao()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
