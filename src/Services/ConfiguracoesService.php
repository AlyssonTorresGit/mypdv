<?php

namespace App\Services;

use App\Models\Dao\ConfiguracoesDao;
use App\Models\Configuracoes;

class ConfiguracoesService
{
    private $configuracoesDao;
    private $fileUploadService;

    public function __construct(ConfiguracoesDao $configuracoesDao)
    {
        $this->configuracoesDao = $configuracoesDao;
    }

    public function adicionarConfiguracoes($dados, $imagem)
    {

        $configuracoes = new Configuracoes();
        $dados['imagem'] = $imagem;

        foreach ($dados as $chave => $valor) {
            $configuracoes->$chave = $valor;
        }

        return $this->configuracoesDao->Adicionar($configuracoes); 
    }

    public function alterarConfiguracoes($dados, $imagem)
    {
        
        $configuracoes = new Configuracoes();
        $dados['imagem'] = $imagem ?: '';

        foreach ($dados as $chave => $valor) {
            $configuracoes->$chave = $valor;
        }

        return $this->configuracoesDao->alterar($configuracoes);
    }
}