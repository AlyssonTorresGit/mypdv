<?php require_once __DIR__ . "/../shared/header.php"; ?>
<div class="box-12 mg-t-2">
    <h2 class=" poppins-medium fw-300 fonte22 fnc-preto-azulado">
        <i class="fa-solid fa-bag-shopping mg-r-1 fonte22 fnc-preto-azulado"></i>
        <?php
        $titulo = isset($id) && $id <> '' ?  'Atualizar usuario ' : 'Cadastrar usuario';
        echo $titulo;
        ?>

    </h2>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <form action="/cadastrar-usuario" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php if (isset($id) && $id <> ''): echo $usuario[0]->ID;
                                                endif; ?>">
        <div class="box-12 mg-b-2">
            <input type="hidden" name="ativo" value="<?php if (isset($id) && $id <> ''): echo $usuario[0]->ATIVO;
                                                        endif; ?>">
        </div>
        <div class="box-6">
            <label for="">Nome </label>
            <input type="text" name="nome" value="<?php if (isset($id) && $id <> ''): echo $usuario[0]->NOME;
                                                    endif; ?>" required>
        </div>

        <div class="box-6">
            <label for="">Usuario </label>
            <input type="text" name="usuario" value="<?php if (isset($id) && $id <> ''): echo $usuario[0]->USUARIO;
                                                        endif; ?>" required>
        </div>
        <div class="box-4">
            <label for="">Email </label>
            <input type="email" name="email" id="email" value="<?php if (isset($id) && $id <> ''): echo $usuario[0]->EMAIL;
                                                                endif; ?>" required>
            <span id="emailFeedback"></span>
        </div>
        <?php if (isset($id) && $id <> ''):

        else: ?>
            <div class="box-4">
                <label for="">Senha </label>
                <input type="password" name="senha" required>
            </div>

        <?php endif; ?>
        <div class="box-4">
            <label for="" class="fnc-preto-azulado">Perfil</label>
            <select name="perfil" id="">
                <?php if (isset($perfis) && count($perfis) > 0):
                    foreach ($perfis as $perfil):
                        $selected  = (isset($id) && $id != '' && $usuario[0]->PERFIL == $perfil->ID) ? 'selected' : '';
                        $descricao = $perfil->DESCRICAO;
                        echo "<option value='{$perfil->ID}' {$selected} > {$descricao} </option>"
                ?>


                <?php endforeach;
                endif; ?>


            </select>
        </div>

        <div class="box-6 pd-l-2 fnc-preto-azulado radius pd-t-1 bg-light mg-t-2">
            <label for="img">Escolher uma Imagem </label>
            <input type="file" name="imagem" id="img">
        </div>

        <div class="box-12">
            <input type="submit" value="cadastrar" class="btn-100 bg-primario mg-t-4 fnc-terciario uppercase">
        </div>
    </form>
</div>