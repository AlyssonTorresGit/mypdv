<?php 
 use App\Configurations\Formater;
 $formater = new Formater();
?>
<div class="box-12 mg-t-2">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-tags mg-r-1 fonte22 fnc-preto-azulado"></i> Lista de Produtos
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="/cadastrar-produto" class=" bg-primario fnc-terciario pd-10 radius fw-600">Novo Produto</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse" id="tabela">
        <thead>
            <tr>
                <th class="fonte12 pd-10">Código</th>
                <th class="fonte12 pd-10">Data Cadastro</th>
                <th class="fonte12 pd-10">Quantidade</th>
                <th class="fonte12 pd-10">Nome </th>
                <th class="fonte12 pd-10">Preco de Custo</th>
                <th class="fonte12 pd-10">Preço</th>
                <th class="fonte12 pd-10">Desconto</th>
                <th class="fonte12 pd-10">Estatus</th>
                <th class="fonte12 pd-10">Ação</th>
            </tr>
        </thead>

        <tbody>
            <?php if (isset($produtos) && count($produtos)):
                foreach ($produtos as $produto):
                    if (is_null($produto->CODIGO)): $produto->CODIGO = 0;
                    endif; ?>

                    <tr>
                        <td class="fonte12 pd-10 txt-c"><?= $formater->zeroEsquerda($produto->CODIGO, 6); ?></td>

                        <?php
                        $estoqueProduto = null;
                         foreach ($estoque as $value):
                            if($value->PRODUTO == $produto->ID): 
                                $estoqueProduto = $value;
                                break;
                            endif;                         
                        endforeach; 
                        if($estoqueProduto): ?>
                                <td class="fonte12 pd-10 txt-c"><?= $formater->formatarDataTime($estoqueProduto->DATACADASTRO); ?></td>
                                <td class="fonte12 pd-10 txt-c"><?= $estoqueProduto->QUANTIDADE; ?></td>
                            <?php else: ?>
                                <td class="fonte12 pd-10 txt-c">-</td>
                                <td class="fonte12 pd-10 txt-c">0</td>
                        <?php endif; ?>
                        <td class="fonte12 pd-10 txt-c"><?= $formater->formataTextoCap($produto->NOME); ?></td>
                        <td class="fonte12 pd-10 txt-c">R$ <?= $formater->converterMoeda($produto->PRECODECUSTO); ?></td>
                        <td class="fonte12 pd-10 txt-c">R$ <?= $formater->converterMoeda($produto->PRECO); ?></td>
                        <td class="fonte12 pd-10 txt-c"><?= $produto->DESCONTO; ?> %</td>
                        <td class=" txt-c fonte12">
                            <span class="toggle-status"
                                data-id="<?= $produto->ID; ?>"
                                data-status="<?= $produto->ESTATUS == 'A' ? 'I' : 'A'; ?>"
                                data-url="/alterar-status-produto">
                                <?php if ($produto->ESTATUS == 'A'): ?>
                                    <i class="fa-solid fa-lock-open fonte12 fnc-sucesso"></i>
                                <?php else: ?>
                                    <i class="fa-solid fa-lock fonte12 fnc-laranja-claro"></i>
                                <?php endif; ?>
                            </span>
                        </td>
                        <td class="pd-10 txt-c">
                            <a href="/deletar-produto/<?= $produto->ID; ?>"><i class="fa-solid fa-trash-can mg-r-2 fnc-laranja fonte12"></i> </a>
                            <a href="/editar-produto/<?= $produto->ID; ?>"><i class="fa-solid fa-pen fnc-primario fonte12"></i> </a>
                        </td>
                    </tr>
            <?php endforeach;
            endif; 
            // echo "<pre>"; var_dump($produtos); echo "</pre> <br> <hr>";
            // echo "<pre>"; var_dump($estoque); echo "</pre>";
            
        ?>

        </tbody>
    </table>
</div>