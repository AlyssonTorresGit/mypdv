<?php require_once "../src/Views/shared/header.php"; ?>

<section class="main-car">
    <div class="container flex wd-100">

        <div class="left-painel">

            <div class="top-inputs">
                <input id="inputProduto" class="bg-branco sem-borda shadow-down" type="text" name="codigo" placeholder="digite o código do produto">
                <input id="inputQtde" class="bg-branco sem-borda shadow-down" type="number" name="qtde" min="1" value="1" placeholder="quantidade desejada...">
            </div>
            <?php
            if (!isset($_SESSION)):
                session_start();
            endif;
            ?>

            <div class="item-list bg-branco shadow-down">

                <div class="itens">
                    <span class="fw-bold fonte12">Codigo</span>
                    <span class="fw-bold fonte12">Produto</span>
                    <span class="fw-bold fonte12">Quantidade</span>
                    <span class="fw-bold fonte12">Desconto</span>
                    <span class="fw-bold fonte12">Val. Uni</span>
                    <span class="fw-bold fonte12">Sub-total</span>
                </div>

                <?php
                $total = 0.00;
                if (isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0):
                    foreach ($_SESSION['carrinho'] as $item):
                        $preco = (float) $item['preco'];
                        $qtde = (int) $item['qtde'];
                        $desc = (float) $item['desc'] ?? 0;

                        $subTotal = $qtde * $preco;
                        $valorDesconto = round(($subTotal * $desc) / 100, 2);
                        $subTotalDesconto = round($subTotal -  $valorDesconto, 2);

                        $total = round($total + $subTotalDesconto, 2);

                ?>
                        <div class="itens">
                            <?php
                            //if (isset($_SESSION['carrinho'])):
                            //     var_dump($_SESSION['carrinho']);
                            // else:
                            //     echo "Sessão Carrinho não existe";
                            // endif;
                            ?>
                            <span class="fonte10 fw-400 txt-e"><?= $item['codigo'] ?></span>
                            <span class="fonte10 fw-400 txt-e"><?= $item['nome'] ?></span>
                            <span class="fonte10 fw-400 txt-e"><?= $item['qtde'] ?></span>
                            <span class="fonte10 fw-400 txt-e"><?= $item['desc'] ?></span>
                            <span class="fonte10 fw-400 txt-e"><?= $item['preco'] ?></span>
                            <span class="fonte10 fw-400 txt-e"><?= $subTotalDesconto ?></span>
                        </div>
                <?php
                    endforeach;
                else:
                    echo "<h2 class='fonte48 txt-c fnc-preto-azulado mg-t-10' >Caixa Livre! </h2>";
                endif;
                ?>
            </div>

        </div>

        <div class="right-painel bg-primario">
            <div class="box">
                <div class="total mg-b-4 bg-branco poppins-black"> R$ <?= number_format($total, 2, ',', '.') ?> </div>
                <h3 class="fonte16 fnc-branco txt-c">Atalhos úteis</h3>
                <div class="atalhos flex justify-center mg-b-4">
                    <button class="pd-10 mg-r-1 fw-600"> Consultar Produto<span class=" fnc-amarelo poppins-black"><br>(F1)</span></button>
                    <button class="pd-10 mg-l-1 fw-600">Consultar Cliente <span class=" fnc-amarelo poppins-black"><br>(F2)</span></button>
                    <button class="pd-10 mg-r-1 fw-600">Desconto<span class=" fnc-amarelo poppins-black"><br>(F4)</span></button>
                </div>
                <h3 class="fonte16 fnc-branco txt-c">Ações</h3>
                <div class="acoes flex justify-center">
                    <button class="pd-10 mg-r-1 fw-600">Cancelar Venda <span class=" fnc-vermelho poppins-black"><br>(F3)</span></button>
                    <button class="pd-10 mg-r-1 mg-l-1 fw-600">Remover Item <span class=" fnc-laranja poppins-black"><br>(F11)</span></button>
                    <button class="pd-10 mg-l-1 fw-600">Finalizar venda <span class=" fnc-verde-escuro poppins-black"><br>(F9)</span></button>
                </div>
            </div>
            <div class="box-12 flex justify-between item-centro">
                <a href="/logout" class="fnc-secundario fnc-branco-hover">
                    <i class="fa-solid fa-right-from-bracket fonte14 fnc-secundario fnc-branco-hover"></i>
                    <span>Logout</span>
                </a>

                <a href="/painel-controle" class="block fnc-secundario txt-d fnc-branco-hover">
                    Painel de controle
                </a>
            </div>

        </div>

    </div>
</section>
<script type="text/javascript" src="/lib/js/pdv.js">
    window.onload = function() {
        document.getElementById('inputProduto').focus();
    };
</script>