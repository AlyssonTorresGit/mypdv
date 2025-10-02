<?php

namespace App\Models;

use DateTime;
use App\Models\ItensVenda;

class Venda
{
    private ?string $id;
    private ?string $datavenda;
    private ?float $valor;
    private ?string $status;
    private ?string $pagamento;
    private ?string $usuario;
    private ?string $cliente;
    private array $itensVenda = [];

    public function __construct(
        ?string $id = '',
        float $valor = 0.00,
        string $status = 'Pendente',
        ?string $pagamento = null,
        string $usuario = '',
        string $cliente = '',
    ) {
        date_default_timezone_set('America/Sao_Paulo');
        $this->id = $id;
        $this->datavenda =  date('Y-m-d H:i:s');
        $this->valor = $valor;
        $this->status = $status;
        $this->pagamento = $pagamento;
        $this->usuario = $usuario;
        $this->cliente = $cliente;
    }

    // Getters
    public function getId()
    {
        return $this->id;
    }

    public function getDatavenda()
    {
        return $this->datavenda;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
    public function getPagamento(): string
    {
        return $this->pagamento;
    }
    public function getCliente(): string
    {
        return $this->cliente;
    }

    public function getItens(): array
    {
        return $this->itensVenda;
    }
    // Setters
    public function setId($id): void
    {
        $this->id = $id;
    }

    public function setDatavenda($datavenda): void
    {
        $this->datavenda = $datavenda;
    }

    public function setValor(float $valor): void
    {
        $this->valor = $valor;
    }

    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

        public function setPagamento(string $pagamento): void
    {
        $this->pagamento = $pagamento;
    }
            public function setCliente(string $cliente): void
    {
        $this->cliente = $cliente;
    }

    // Adicionar itens à venda
    public function adicionarItem($itemVenda): void
    {
        $this->itensVenda[] = $itemVenda;
    }

    // Converter para array
    public function toArray(): array
    {
        return [
            "id" => $this->id,
            "datavenda" => $this->datavenda,
            "valor" => $this->valor,
            "status" => $this->status,
            "pagamento" => $this->pagamento,
            "usuario" => $this->usuario,
            "cliente" => $this->cliente,
            "itensVenda" => array_map(fn($item) => $item->toArray(), $this->itensVenda)
        ];
    }

    // Verifica atributos preenchidos
    public function atributosPreenchidos(): array
    {
        return array_filter($this->toArray(), fn($value) => !empty($value));
    }
}
