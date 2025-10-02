<?php

namespace App\Models;

class Estoque
{
    private ?int $id;
    private ?int $produto;
    private ?int $quantidade;
    private ?int $estoqueminimo;
    private ?string $datacadastro;

    public function __construct(
        int $id = 0,
        int $produto = 0,
        int $quantidade,
        string $datacadastro,
        int $estoqueminimo,
    ) {
        $this->id = $id;
        $this->produto = $produto;
        $this->quantidade = $quantidade;
        $this->estoqueminimo = $estoqueminimo;
        $this->datacadastro = $datacadastro ?? date('Y-m-d H:i:s');
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
            "produto" => $this->produto,
            "quantidade" => $this->quantidade,
            "estoqueminimo" => $this->estoqueminimo,
            "datacadastro" => $this->datacadastro,
        ];
    }

    public function atributosPreenchidos()
    {
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}
