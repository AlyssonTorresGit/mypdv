<?php

namespace App\Models;

class Caixa
{
    private ?string $id;
    private ?string $usuario;
    private ?string $dataabertura;
    private ?string $datafechamento;
    private ?string $saldoinicial;
    private ?string $saldofinal;
    private ?string $status;

    public function __construct(?string  $id, string $usuario,  string $datafechamento, string $saldoinicial, string $saldofinal, string $status)
    {
        date_default_timezone_set('America/Sao_paulo');
        $this->id = $id;
        $this->usuario = $usuario;
        $this->dataabertura = date('Y-m-d H:i:s');
        $this->datafechamento = date('Y-m-d H:i:s');
        $this->saldoinicial = $saldoinicial;
        $this->saldofinal = $saldofinal;
        $this->status = $status;
    }
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        return $this->id = $id;
    }
    public function __set($chave, $valor)
    {
        if (property_exists($this, $chave)):
            $this->$chave = $valor ?: '';
        endif;
    }
    public function toArray()
    {
        return  [
            "id" => $this->id,
            "usuario" => $this->usuario,
            "dataabertura" => $this->dataabertura,
            "datafechamento" => $this->datafechamento,
            "saldoinicial" => $this->saldoinicial,
            "saldofinal" => $this->saldofinal,
            "status" => $this->status,

        ];
    }
    public function atributosPreenchidos()
    {
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}
