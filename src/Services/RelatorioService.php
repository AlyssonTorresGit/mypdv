<?php

namespace App\Services;

class RelatorioService
{
    public static function exportarPdf(string $titulo, array $cabecalho, array $dados, string $nomeArquivo = "Relatorio_Pdf")
    {
        // var_dump($dados);
        $html = "
         <style>
             body {
             font-family: DejaVu Sans, sans-serif;
             font-size: 12px;
             color: #333;
         }
         h1 {
             text-align: center;
             font-size: 20px;
             margin-bottom: 20px;
             color: #222;
         }
         table {
             width: 100%;
             border-collapse: collapse;
             margin-top: 15px;
         }
         th, td {
             border: 1px solid #999;
             padding: 8px 10px;
             text-align: left;
         }
         th {
             background-color: #f2f2f2;
             font-weight: bold;
             text-transform: uppercase;
             font-size: 11px;
         }
         tr:nth-child(even) {
             background-color: #f9f9f9;
         } 
         </style>
            <h1> {$titulo} </h1>
            <table>
            <tr>
         ";
        foreach ($cabecalho as $col):
            $html .= "<th> {$col} </th>";
        endforeach;
        $html .= "</tr>";

        foreach ($dados as $linha):
            $html .= "<tr>";
            foreach ($linha as $valor):
                $html .= "<td>{$valor} </td>";
            endforeach;
            $html .= "</tr>";
        endforeach;
        $html .= "</table>";

        $domPdf = new \Dompdf\Dompdf();
        $domPdf->loadHtml($html);
        $domPdf->setPaper("A4", "portrait");
        $domPdf->render();
        $domPdf->stream($nomeArquivo, ["Attachment" => true]);
    }

    // função que exporta o relatorio no form,ato xlsx
    public static function exportarExcel(array $cabecalho, array $dados, string $nomeArquivo = "Relatorio_Excel")
    {
        // instanciando a classe spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // criando a planilha
        $sheet =  $spreadsheet->getActiveSheet();
        $sheet->setTitle("Faturamento");

        // criar o cabeçalha da planilha
        $sheet->fromArray($cabecalho, null, 'A1');

        // inserir os dados da planilha
        $linha = 2;
        foreach($dados as $d):
            $sheet->fromArray(array_values($d),null,"A$linha");
            $linha ++;
        endforeach;

        // Ajustando o header para download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename=\"{$nomeArquivo}\"");
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1'); // Para IE

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, writerType: 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}
