<?php

namespace App\Models;

class Movimentacao
{
    private ?string $id;
    private ?string $caixa;
    private ?string $usuario;
    private ?string $totalfechamento;
    private ?string $datafechamento;


    public function __construct(?string  $id, string $caixa, string $usuario,  string $totalfechamento)
    {
        date_default_timezone_set('America/Sao_paulo');
        $this->id = $id;
        $this->caixa = $caixa;
        $this->usuario = $usuario;
        $this->totalfechamento = $totalfechamento;
        $this->datafechamento = date('Y-m-d H:i:s');
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
            "caixa" => $this->caixa,
            "usuario" => $this->usuario,
            "totalfechamento" => $this->totalfechamento,
            "datafechamento" => $this->datafechamento,
        ];
    }
    public function atributosPreenchidos()
    {
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}
