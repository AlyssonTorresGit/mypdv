<?php 
 use App\Configurations\Formater;
 $formater = new Formater();
?>
<div class="box-12 mg-t-2">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fas fa-cog mg-r-1 fonte22 fnc-preto-azulado"></i> Configuração Atual
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="/cadastrar-configuracao" class=" bg-primario fnc-terciario pd-10 radius fw-600">Nova Configuração</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse" id="tabela">
        <thead>
            <tr>
                <th class="fonte12 pd-10">Código</th>
                <th class="fonte12 pd-10">Razão Social</th>
                <th class="fonte12 pd-10">Nome Fantasia</th>
                <th class="fonte12 pd-10">CNPJ </th>
                <th class="fonte12 pd-10">Contato</th>
                <th class="fonte12 pd-10">Ação</th>
            </tr>
        </thead>

        <tbody>
            <?php if (isset($configuracoes) && count($configuracoes)):
                foreach ($configuracoes as $configuracao):
                    if (is_null($configuracao->ID)): $configuracao->ID = 0;
                    endif; ?>

                    <tr>
                        <td class="fonte12 pd-10 "><?= $formater->zeroEsquerda($configuracao->ID, 6); ?></td>
                        <td class="fonte12 pd-10 "><?= $formater->formataTextoCap($configuracao->RAZAOSOCIAL); ?></td>
                        <td class="fonte12 pd-10 "><?= $formater->formataTextoCap($configuracao->NOMEFANTASIA); ?></td>
                        <td class="fonte12 pd-10 "><?= $configuracao->CNPJ; ?></td>
                        <td class="fonte12 pd-10 "><?= $configuracao->CONTATO; ?></td>

                        <td class="pd-10">
                            <a href="/deletar-configuracao/<?= $configuracao->ID; ?>"><i class="fa-solid fa-trash-can mg-r-2 fnc-laranja fonte12"></i> </a>
                            <a href="/editar-configuracao/<?= $configuracao->ID; ?>"><i class="fa-solid fa-pen fnc-primario fonte12"></i> </a>
                        </td>
                    </tr>
            <?php endforeach;
            endif;
            ?>
        </tbody>
    </table>
</div>