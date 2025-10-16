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
    public function listarCaixaS()
    {
        $sql = "SELECT C.ID AS CODIGO,
                        U.NOME AS ABERTOPOR,
                        DATE_FORMAT (C.DATAABERTURA, '%d/%m/%Y %H:%i:%s') AS DATAABERTURA,
                        DATE_FORMAT (C.DATAFECHAMENTO, '%d/%m/%Y %H:%i:%s') AS DATAFECHAMENTO,
                        FORMAT(C.SALDOINICIAL, 2, 'pt_BR') AS SALDOINICIAL,
                        FORMAT(C.SALDOFINAL, 2, 'pt_BR') AS SALDOFINAL,
                        C.STATUS,
                        IFNULL(UF.NOME, 'INDEFINIDO') AS FECHADOPOR
                   FROM CAIXA C INNER JOIN
                        USUARIO U ON U.ID = C.USUARIO LEFT JOIN
                        MOVIMENTACAO M ON M.CAIXA = C.ID LEFT JOIN
                        USUARIO UF ON UF.ID = M.USUARIO
                  ORDER BY C.ID DESC";
        $stmt = $this->executarConsulta($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
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
