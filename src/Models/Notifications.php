<?php

namespace App\Models;

abstract class Notifications
{
    // A URL do CSS pode ser centralizada, evitando repetição de código
    private function getCssLink()
    {
        return "<link rel='stylesheet' type='text/css' href='lib/css/aurora.css' />";
    }

    // Gera uma mensagem de sucesso e a retorna como string
    protected function success($mensagem, $retorno)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='aviso'>
                <div class='msg bg-branco'>
                    <h2 class='fonte12 poppins-black fnc-secundario'>
                        %s
                    </h2>
                        <a href='%s' class='btn-msg fnc-secundario'> Fechar Sair </a>                    
                </div>
            </div>",
            $css,
            htmlspecialchars($mensagem),
            htmlspecialchars($retorno)
        );
        return $mensagem;
    }

    // Solicita confirmação para exclusão de dados
    protected function confirm($mensagem, $rota, $rota2)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='aviso'>
                <div class='msg bg-branco'>
                    <h2 class='fonte12 poppins-medium fnc-secundario'>
                        %s 
                    </h2>
                    <div class='botoes mg-t-1 flex justify-between'>
                        <a href='%s' class='btn-mini fnc-error bg-azul mg-auto'> Sim </a>
                        <a href='%s' class='btn-mini fnc-sucesso bg-vermelho mg-auto'> Não </a>
                    </div>
                </div>
            </div>",
            $css,
            htmlspecialchars($mensagem),
            htmlspecialchars($rota),
            htmlspecialchars($rota2),
        );
        return $mensagem;
    }

    // Retorna uma mensagem de erro no login
    protected function loginError($mensagem)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='aviso'>
                <div class='msg bg-branco'>
                    <h2 class='fonte12 poppins-black fnc-secundario'>
                      %s!
                    </h2>
                        <a href='/' class='btn-msg fnc-secundario'> Fechar Sair </a>                    
                </div>
            </div>",
            $css,
            htmlspecialchars($mensagem)
        );
        return $mensagem;
    }

   protected function defaultMessage($mensagem, $submensagem, $rota)
    {
        $css = $this->getCssLink();
        $mensagem = sprintf(
            "%s<div class='aviso'>
                <div class='bg-branco sellSuccess radius'>
                    <h2 class=' fonte30 poppins-black fnc-sucesso pd-20 txt-c'>
                       <i class='fa-solid fa-check fonte18 fnc-sucesso'></i> 
                        %s                        
                    </h2>
                    <h3 class='txt-c fonte50 poppins-black'>
                        %s 
                       <i class='fa-regular fa-face-smile-beam fonte18 fnc-sucesso'></i>
                    </h3> 
                    <a href='%s' class='btn mg-auto bg-laranja mg-t-10 fnc-preto-azulado'> Fechar e Sair </a>
                </div>
            </div>",
            $css,
            htmlspecialchars($mensagem),
            htmlspecialchars($submensagem),
            htmlspecialchars($rota)
        );
        return $mensagem;
    }

}
