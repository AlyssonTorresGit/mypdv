<?php

namespace App\Models\Dao;

use App\core\Contexto;
use PDO;

class RelatorioDao extends Contexto
{
   public function vendasPorPeriodo(string $datainicio, string $datafim){

    $sql = "SELECT DATE(v.datavenda) AS DATA, 
                 COUNT(v.id) AS total_vendas, 
                 SUM(v.valor) AS faturamento, 
                 AVG(v.valor) AS ticket_medio 
            FROM venda v 
           WHERE v.datavenda BETWEEN :inicio AND :fim
           GROUP BY DATE(v.datavenda)
           ORDER BY DATE(v.datavenda) ASC ";

    $stmt = self::getConexao()->prepare($sql);
    $stmt->bindValue(':inicio', $datainicio);
    $stmt->bindValue(':fim', $datafim);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC); 

   }


}
