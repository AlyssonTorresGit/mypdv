<?php

namespace App\Models;

class Configuracoes
{

    private ?string $id;
    private ?string $razaosocial;
    private ?string $nomefantasia;
    private ?string $cnpj;
    private ?string $ie;
    private ?string $im;
    private ?string $regimetributario;
    private ?string $imagem;
    private ?string $cep;
    private ?string $logradouro;
    private ?string $numero;
    private ?string $bairro;
    private ?string $cidade;
    private ?string $uf;
    private ?string $contato;

    public function __construct(
        string $id = '',
        string $razaosocial = '',
        string $nomefantasia = '',
        string $cnpj = '',
        string $ie = '',
        string $im = '',
        string $regimetributario = '',
        string $imagem = '',
        string $cep = '',
        string $logradouro = '',
        string $numero = '',
        string $bairro = '',
        string $cidade = '',
        string $uf = '',
        string $contato = ''
    ) {
        $this->id = $id;
        $this->razaosocial = $razaosocial;
        $this->nomefantasia = $nomefantasia;
        $this->cnpj = $cnpj;
        $this->ie = $ie;
        $this->im = $im;
        $this->regimetributario = $regimetributario;
        $this->logo = $imagem;
        $this->cep = $cep;
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->contato = $contato;
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
            "razaosocial" => $this->razaosocial,
            "nomefantasia" => $this->nomefantasia,
            "cnpj" => $this->cnpj,
            "ie" => $this->ie,
            "im" => $this->im,
            "regimetributario" => $this->regimetributario,
            "logo" => $this->imagem,
            "cep" => $this->cep,
            "logradouro" => $this->logradouro,
            "numero" => $this->numero,
            "bairro" => $this->bairro,
            "cidade" => $this->cidade,
            "uf" => $this->uf,
            "contato" => $this->contato,
        ];
    }

    public function atributosPreenchidos()
    {
        return array_filter($this->toArray(), fn($value) => $value !== null && $value !== '');
    }
}
