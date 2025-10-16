<?php require_once "../src/Views/venda/index.php"; ?>
<div class="modal">
    <div class="lista-produto-modal bg-branco  animate__animated animate__flipInX flex justify-center flex-wrap">
        <form action="/abrir-caixa" method="POST" class="box-8">
            <h3 class="fonte20 fw-500 espaco-letra txt-c borda-light mg-t-10 ma-b-4">Abir Caixa</h3>

            <input type="text" name="saldoinicial" class="mg-b-2" placeholder="Insira o valor inicial deste caixa EX: 100.95" class="mg-b-2">
            <input type="submit" name="Abri Caixa" value="Abrir Caixa" class="btn-100 bg-primario fnc-branco">
        </form>

    </div>
</div>