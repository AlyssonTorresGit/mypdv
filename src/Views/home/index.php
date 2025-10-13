<?php
define('BASE_URL', 'http://localhost:5100/');
require_once "../src/Views/shared/header.php";
?>
<section class="home hg-full">
    <div class="container-100 flex justify-end">

        <div class="box-6">
            <img src="/lib/img/bg/login.png" alt="">
        </div>
        <div class="box-6 bg-primario flex justify-center item-centro hg-full">

            <form action="/" method="POST" class="box-10">
                <h1 class=" poppins-black fnc-branco txt-c">MyPdv</h1>
                <p class="txt-c fonte14 mg-b-3 fnc-laranja-claro poppins-black">Acesse o sistema com suas credenciais de acesso.</p>

                <label for="" class="fnc-terciario">Usuario</label>
                <input type="text" name="usuario" class="fnc-terciario">
                <label for="" class="fnc-terciario">Senha</label>
                <input type="password" name="senha" class="fnc-terciario">

                <input type="submit" class="btn-100 bg-secundario fnc-terciario" value="Acessar">

            </form>
        </div>
    </div>
</section>