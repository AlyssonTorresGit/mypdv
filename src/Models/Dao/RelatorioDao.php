<?php

namespace App\Models\Dao;

use App\core\Contexto;
use PDO;

class RelatorioDao extends Contexto
{
   public function vendasPorPeriodo(string $datainicio, string $datafim)
   {
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

   public function vendasProdutos($datainicio, $datafim)
   {
      $sql = "SELECT 
               v.datavenda,
               p.nome AS produto,
               SUM(iv.quantidade) AS quantidade_vendida,
               SUM(iv.quantidade * iv.precounitario) AS faturamento
            FROM itensvenda iv
            INNER JOIN produto p ON p.id = iv.produto
            INNER JOIN venda v ON V.id = iv.venda
            WHERE v.datavenda BETWEEN :inicio AND :fim
            GROUP BY p.nome
            ORDER BY faturamento DESC";

      $stmt = self::getConexao()->prepare($sql);
      $stmt->bindValue(':inicio', $datainicio);
      $stmt->bindValue(':fim', $datafim);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   public function vendasCliente($datainicio, $datafim)
   {
      $sql = "SELECT 
            c.NOME AS cliente,
            COUNT(v.ID) AS total_vendas,
            SUM(v.VALOR) AS total_faturado,
            AVG(v.VALOR) AS ticket_medio
        FROM venda v
        INNER JOIN clientes c ON v.CLIENTE = c.ID
        WHERE v.DATAVENDA BETWEEN :inicio AND :fim
          AND v.STATUS = 'FINALIZADA'
        GROUP BY c.NOME
        ORDER BY total_faturado DESC";


      $stmt = self::getConexao()->prepare($sql);
      $stmt->bindValue(':inicio', $datainicio);
      $stmt->bindValue(':fim', $datafim);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
   public function vendasFormaPagamento($datainicio, $datafim)
   {
      $sql = "SELECT 
            v.PAGAMENTO AS forma_pagamento,
            COUNT(v.ID) AS total_vendas,
            SUM(v.VALOR) AS total_faturado,
            ROUND(SUM(v.VALOR) * 100 / (SELECT SUM(VALOR) 
                                       FROM venda 
                                       WHERE DATAVENDA BETWEEN :inicio AND :fim
                                       AND STATUS = 'FINALIZADA'), 2) AS percentual
         FROM venda v
        WHERE v.DATAVENDA BETWEEN :inicio AND :fim
          AND v.STATUS = 'FINALIZADA'
        GROUP BY v.PAGAMENTO
        ORDER BY total_faturado DESC";

      $stmt = self::getConexao()->prepare($sql);
      $stmt->bindValue(':inicio', $datainicio);
      $stmt->bindValue(':fim', $datafim);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}
