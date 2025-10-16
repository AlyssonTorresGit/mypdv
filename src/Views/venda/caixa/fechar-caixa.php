<?php require_once "../src/Views/venda/index.php"; ?>
<div class="modal">
    <div class="lista-produto-modal bg-branco  animate__animated animate__flipInX flex justify-center flex-wrap">

        <form action="/fechar-caixa" method="POST" class="box-6">

            <h3 class="fonte20 fw-500 espaco-letra txt-c borda-light mg-t-10 ma-b-4">Abir Caixa</h3>

            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="usuario" value="<?= $_SESSION["idusuario"] ?>">

            <input type="text" name="totalfechamento" class="mg-b-2" placeholder="Insira o valor inicial deste caixa EX: 100.95" class="mg-b-2">
            <input type="submit" name="Abri Caixa" value="Abrir Caixa" class="btn-100 bg-primario fnc-branco">
        </form>

    </div>
</div>