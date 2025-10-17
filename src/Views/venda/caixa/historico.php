<div class="box-12 mg-t-2">
    <div class="box-8">
        <h2 class="poppins-medium fw-300 fonte22">

        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="/historico-caixas" class="bg-primario fnc-terciario pd-10 radius fw-600">Ver histórico de caixa</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse" id="tabela">
        <thead>
            <tr>
                <th class="txt-c fonte12 pd-10">Fechado por</th>
                <th class="txt-c fonte12 pd-10">Data Abertura</th>
                <th class="txt-c fonte12 pd-10">Data Fechamento</th>
                <th class="txt-c fonte12 pd-10">Saldo Inicial</th>
                <th class="txt-c fonte12 pd-10">Saldo Final</th>
                <th class="txt-c fonte12 pd-10">Estatus</th>
                <th class="txt-c fonte12 pd-10">Fechado por</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($caixas) && count($caixas)):
                foreach ($caixas as $caixa):
                    if ($caixa->STATUS == 'FECHADO'):

                        if (is_null($caixa->CODIGO)): $caixa->CODIGO = 0;
                        endif; ?>
                        <tr>
                            <td class="fonte12 pd-10 txt-c"><?= ucwords(strtolower($caixa->ABERTOPOR)); ?></td>
                            <td class="fonte12 pd-10 txt-c"><?= $caixa->DATAABERTURA; ?></td>
                            <td class="fonte12 pd-10 txt-c"><?= $caixa->DATAFECHAMENTO; ?></td>
                            <td class="fonte12 pd-10 txt-c"><?= $caixa->SALDOINICIAL; ?></td>
                            <td class="fonte12 pd-10 txt-c"><?= $caixa->SALDOFINAL; ?></td>
                            <td class="fonte12 pd-10 txt-c"><?= $caixa->STATUS; ?></td>
                            <td class="fonte12 pd-10 txt-c"><?= ucfirst(strtolower($caixa->FECHADOPOR)); ?></td>

                            <!-- <td class="txt-c">
                                <a href="/fechar-caixa<?= $caixa->CODIGO; ?>">
                                    <i class="fa-solid fa-money-check-dollar fonte16 mg-r-2 fnc-primario"></i>
                                </a>
                                <a href="/historico-caixas">
                                    <i class="fa-solid fa-circle-info fonte16 mg-r-2 fnc-error"></i>
                                </a>
                            </td> -->
                        </tr>
            <?php
                    endif;
                endforeach;
            endif; ?>
        </tbody>
    </table>
</div>