<?php
define('BASE_URL', 'http://localhost:5100/');
require_once "../src/Views/shared/header.php";
?>
<section class="home hg-full">
    <div class="container flex justify-center">
        <div class="box-4 bg-branco mg-t-10 shadow-down radius pd-20">
            <form action="" class="" method="POST">
                <h1 class="poppins-black txt-c">MyPdv</h1>
                <p class="txt-c fonte12 mg-b-3 poppins-medium fw-300">Acesse o sistema com suas credenciais de acesso
                </p>
                <label for="">Usuario</label>
                <input type="text" name="usuario">

                <label for="">Senha</label>
                <input type="password" name="senha">

                <input type="submit" class="btn-100 bg-verde fnc-branco" value="Acessar">
            </form>
        </div>
    </div>
</section>