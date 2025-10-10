<?php require_once "../src/Views/venda/index.php"; ?>
<div class="modal">
    <div class="lista-produto-modal bg-branco  animate__animated animate__flipInX">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-tags mg-r-1 fonte22 fnc-preto-azulado"></i> Lista de Produtos
        </h2>
        <table class="zebra wd-100 collapse" id="tabela">
            <thead>
                <tr>
                    <th class="txt-c">Imagem</th>
                    <th class="txt-c">Código</th>
                    <th class="txt-c">Nome</th>
                    <th class="txt-c">Preço</th>
                    <th class="txt-c">Estoque</th>
                    <!-- <th class="txt-c">Adicionar</th> -->
                </tr>
            </thead>
            <!-- body -->
            <tbody>
                <?php
                if (isset($produtos)):
                    $quantidade = 0;
                    foreach ($produtos as $produto):
                        foreach ($estoque as $qtde):
                            if ($qtde->PRODUTO == $produto->ID):
                                $quantidade = $qtde->QUANTIDADE;
                                break;
                            endif;
                        endforeach;
                ?>


                        <tr>
                            <td class="txt-e"><img class="logo-40" src="/lib/img/upload/produtos/<?= $produto->IMAGEM; ?>" alt=""></td>
                            <td class="txt-e"><?= $produto->CODIGO; ?></td>
                            <td class="txt-e"><?= $produto->NOME; ?></td>
                            <td class="txt-e">R$ <?= number_format($produto->PRECO, 2, ',', '.'); ?></td>
                            <td class="txt-e"><?= $quantidade; ?></td>
                            <!-- <td class="txt-c">
                                <a href="/carrinho-compras/<?= $produto->CODIGO; ?>" id="add-produto" class="fonte24 fnc-sucesso fw-bold"> 
                                    + 
                                </a>
                            </td> -->
                        </tr>

                <?php endforeach;
                endif;
                ?>

            </tbody>
        </table>
    </div>
</div>
<script>
    let table = new DataTable('#tabela');
</script>