<?php require_once "../src/Views/venda/index.php"; ?>
<div class="modal">
    <div class="lista-produto-modal bg-branco  animate__animated animate__flipInX">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-tags mg-r-1 fonte22 fnc-preto-azulado"></i> Itens do carrrinho
        </h2>
        <table class="zebra wd-100 collapse" id="tabela">
            <thead>
                <tr>
                    <th class="txt-c">Produto</th>
                    <th class="txt-c">Quantidade</th>
                    <th class="txt-c">desconto</th>
                    <th class="txt-c">Val Uni</th>
                    <th class="txt-c">Sub Total</th>
                    <th class="txt-c">Ação</th>
                </tr>
            </thead>
            <!-- body -->
            <tbody>
                <?php
                if (!isset($_SESSION)):
                    session_start();
                endif;

                if (isset($_SESSION['carrinho'])):
                    foreach ($_SESSION['carrinho'] as $key => $item):
                        // calculos de totalizadores
                        $preco = (float) $item['preco'];
                        $qtde = (int) $item['qtde'];
                        $desconto = isset($item['desc']) ? (float) $item['desc'] : 0;

                        $subtotal = $preco * $qtde; // Subtotal antes do desconto
                        $descontoValor = round(($subtotal * $desconto) / 100, 2); // Calcula o desconto e arredonda para 2 casas decimais
                        $subtotalFinal = round($subtotal - $descontoValor, 2); // Subtrai o desconto e arredonda


                ?>

                        <tr>
                            <td class="txt-e"><?= $item['nome']; ?></td>
                            <td class="txt-e"><?= $item['qtde']; ?></td>
                            <td class="txt-e"><?= $item['desc']; ?></td>
                            <td class="txt-e">R$ <?= number_format($preco, 2, ',', '.'); ?></td>
                            <td class="txt-e">R$ <?= number_format($subtotal - $descontoValor, 2, ',', '.'); ?></td>
                            <td><a href="/excluir-item-carrinho/<?= $key; ?>"> <i class="fa-solid fa-trash-can fnc-error"></i> </a>
                        </tr>
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