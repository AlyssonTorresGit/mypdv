<?php require_once "../src/Views/shared/header.php"; ?>
<head>
    <style>
        
    </style>
</head>


<section class="main-car">
    <div class="container flex wd-100">

        <div class="left-painel">

            <div class="top-inputs">
                <input id="inputProduto" class="bg-branco sem-borda shadow-down" type="text" name="codigo" placeholder="digite o código do produto">

                <div class="medium-inputs">
                    <label for="inputQtde" class="lbl-compacto">Qtd.</label>
                    <input id="inputQtde" class="bg-branco sem-borda shadow-down" type="number" name="qtde" min="1" value="1" placeholder="quantidade desejada...">

                    <label for="inputporcento" class="lbl-compacto">Desconto.</label>
                    <div id="inputdesconto">
                        <input id="inputR$" class="bg-branco sem-borda shadow-down" type="number" name="porcentagem" min="0" value="0" placeholder="quantidade desejada...">
                        <input id="input%" class="bg-branco sem-borda shadow-down" type="number" name="inteiro" min="0" value="0" placeholder="quantidade desejada...">
                    </div>
                </div>
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

        <div class="right-painel bg-primario ">
            <!-- STATUS CAIXA -->
            <div class="box-12 flex justify-between item-centro bg-branco pd-10 mg-b-2 radius">
                <a href="" class="fnc-secundario fnc-branco-hover">
                    <i class="fa-solid fa-cash-register fonte14 fnc-secundario fnc-branco-hover"></i>
                    <span>Caixa 01</span>
                </a>
                <a href="#" class="block fnc-secundario txt-d fnc-branco-hover">
                    <i class="fa-solid fa-cash-register fonte14 fnc-secundario fnc-branco-hover"></i>
                    <span>Caixa: Aberto</span>
                </a>

                <a href="#" class="block fnc-secundario txt-d fnc-branco-hover">
                    <i class="fas fa-user fonte14 fnc-secundario fnc-branco-hover"></i>
                    <span><?= ucfirst($_SESSION['nome']) ?? $naologado ?></span>
                </a>
           
            </div>
            <!-- TOTAIS -->
            <div class="box">
                <div class="linha flex justify-between mg-b-2">
                    <!-- <label for="">SubTotal</label> -->
                    <div class="total mg-b-1 bg-branco poppins-black"> R$ <?= number_format($subTotal, 2, ',', '.') ?> </div>
                    <!-- <label for="">Descontos</label>                    -->
                    <div class="total mg-b-1 bg-branco poppins-black"> R$ <?= number_format($valorDesconto, 2, ',', '.') ?> </div>
                </div>

                <div class="linha flex justify-end">
                    <!-- <label for="">Total</label> -->
                    <div class="total mg-b-1 bg-branco poppins-black"> R$ <?= number_format($total, 2, ',', '.') ?> </div>
                </div>
                <!-- BOTÕES ATALHOS -->
                <h3 class="fonte16 fnc-branco txt-c">Atalhos úteis</h3>
                <div>
                    <div class="atalhos flex justify-center mg-b-4">
                        <button class="pd-10 mg-r-1 fw-600"> Consultar Produto<span class=" fnc-amarelo poppins-black"><br>(F1)</span></button>
                        <button class="pd-10 mg-l-1 fw-600 ">Consultar Cliente <span class=" fnc-amarelo poppins-black"><br>(F2)</span></button>
                        <button class="pd-10 mg-r-1 fw-600">Desconto<span class=" fnc-amarelo poppins-black"><br>(F4)</span></button>
                        <button class="pd-10 mg-r-1 fw-600"> Consultar Produto<span class=" fnc-amarelo poppins-black"><br>(F1)</span></button>
                        <button class="pd-10 mg-l-1 fw-600 ">Consultar Cliente <span class=" fnc-amarelo poppins-black"><br>(F2)</span></button>
                        <button class="pd-10 mg-r-1 fw-600">Desconto<span class=" fnc-amarelo poppins-black"><br>(F4)</span></button>
                    </div>
                <!-- BOTOES ATALHOS -->    
                <h3 class="fonte16 fnc-branco txt-c">Ações</h3>
                    <div class="acoes flex justify-center">
                        <button class="pd-10 mg-r-1 fw-600">Cancelar Venda <span class=" fnc-vermelho poppins-black"><br>(F3)</span></button>
                        <button class="pd-10 mg-r-1 mg-l-1 fw-600">Remover Item <span class=" fnc-laranja poppins-black"><br>(F11)</span></button>
                        <button class="pd-10 mg-l-1 fw-600 ">Finalizar venda <span class=" fnc-verde-escuro poppins-black"><br>(F9)</span></button>
                        <button class="pd-10 mg-r-1 fw-600">Cancelar Venda <span class=" fnc-vermelho poppins-black"><br>(F3)</span></button>
                        <button class="pd-10 mg-r-1 mg-l-1 fw-600">Remover Item <span class=" fnc-laranja poppins-black"><br>(F11)</span></button>
                        <button class="pd-10 mg-l-1 fw-600">Finalizar venda <span class=" fnc-verde-escuro poppins-black"><br>(F9)</span></button>
                    </div>
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