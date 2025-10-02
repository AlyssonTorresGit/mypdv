<?php

namespace App\Controllers;

use App\Models\Dao\RelatorioDao;
use App\Services\RelatorioService;

class RelatorioController extends BaseController
{
   private $relatorioDao;

   public function __construct()
   {
      $this->relatorioDao = new RelatorioDao();
   }

   public function relatorio()
   {
      $this->render('relatorio/index');
   }

   public function gerarRelatorio()
   {

      $tipo = $_GET['tipo'] ?? '';
      $export = $_GET['export'] ?? '';
      $dados = [];
      $titulo = '';
      $icon = '';
      $cabecalho = [];

      switch ($tipo) {
         case 'vendas-periodo':
            $inicio = $_GET['inicio'] ?? date('Y-m-d', strtotime('-7 days'));
            $fim = $_GET['fim'] ?? date('Y-m-d');
            $icon = 'fa-solid fa-money-bill-trend-up';
            $dados = $this->relatorioDao->vendasPorPeriodo($inicio, $fim);
            $titulo = 'Vendas Por Período';
            $cabecalho = ['Data da Venda', 'Total de Vendas', 'Faturamento', 'Ticket Médio'];
            //var_dump($dados);

            break;

         case 'vandas-produtos':
            echo "Vendas por produtos";
            break;
      }

      if ($export === 'pdf'):
         RelatorioService::exportarPdf($titulo, $cabecalho, $dados, "Relatotio_{$tipo}.pdf");
         return;
      endif;

      if ($export === 'excel'):
         RelatorioService::exportarExcel( $cabecalho, $dados, "Relatotio_{$tipo}.xlsx");
         return;
      endif;

      require_once '../src/Views/relatorio/base-relatorio.php';
   }
}
