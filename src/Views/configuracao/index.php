<div class="box-12 mg-t-2">
    <h2 class=" poppins-medium fw-300 fonte22">
        <i class="fa-solid fa-bag-shopping mg-r-1 fonte22 fnc-preto-azulado"></i> 
        <?php  
        $titulo = isset($id) && $id <> '' ?  'Atualizar Configuracao ' : 'Cadastrar Configuracao';
        echo $titulo;
        ?>
        
    </h2>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <form action="/cadastrar-configuracao" method="POST" enctype="multipart/form-data">
        <div class="box-12 mg-b-2">
            <input type="hidden" name="id" value="<?php if(isset($id) && $id <> ''): echo $configuracoes[0]->ID; endif;?>">
       </div>

        <div class="box-6 mg-b-2">
            <label for="">Razão Social</label>
            <input type="text" name="razaosocial" value="<?php if(isset($id) && $id <> ''): echo $configuracoes[0]->RAZAOSOCIAL; endif;?>">
        </div>


        <div class="box-6 mg-b-2">
            <label for="">Nome Fantasia</label>
            <input type="text" name="nomefantasia" value="<?php if(isset($id) && $id <> ''): echo $configuracoes[0]->NOMEFANTASIA; endif;?>">
        </div>


        <div class="box-3 mg-b-2">
            <label for="" class="captalize">cnpj</label>
            <input type="text" name="cnpj"  onkeypress="formata_mascara(this, '###.###.###/####-##')" maxlength="19" value="<?php if(isset($id) && $id <> ''): echo $configuracoes[0]->CNPJ; endif;?>">
        </div>

        <div class="box-3 mg-b-2">
            <label for="" class="captalize">ie</label>
            <input type="text" name="ie" onkeypress="formata_mascara(this, '###.###.###.###')" maxlength="15" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->IE;  endif;?>">
        </div>

        <div class="box-3 mg-b-2">
            <label for="" class="captalize">im</label>
            <input type="text" name="im" onkeypress="formata_mascara(this, '###.###.###.###')" maxlength="15" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->IM;  endif;?>">
        </div>
        
        <div class="box-3 mg-b-2">
            <label for="" class="captalize">regimetributario</label>
            <input type="text" name="regimetributario" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->REGIMETRIBUTARIO;  endif;?>">
        </div>
        
        <div class="box-3 mg-b-2">
            <label for="" class="captalize">cep</label>
            <input type="text" name="cep" id="cep" onkeypress="formata_mascara(this, '#####-###')" maxlength="9" onblur="getDadosEnderecoPorCEP(this.value)" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->CEP;  endif;?>">
        </div>
        
        <div class="box-6 mg-b-2">
            <label for="" class="captalize">logradouro</label>
            <input type="text" name="logradouro" id="endereco" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->LOGRADOURO;  endif;?>">
        </div>        
        
        <div class="box-3 mg-b-2">
            <label for="" class="captalize">numero</label>
            <input type="text" name="numero" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->NUMERO;  endif;?>">
        </div>
        
        <div class="box-6 mg-b-2">
            <label for="" class="captalize">bairro</label>
            <input type="text" name="bairro"  id="bairro" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->BAIRRO;  endif;?>">
        </div>
        
        <div class="box-6 mg-b-2">
            <label for="" class="captalize">cidade</label>
            <input type="text" name="cidade" id="cidade" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->CIDADE;  endif;?>">
        </div>
        
        <div class="box-4 mg-b-2">
            <label for="" class="captalize">uf</label>
            <input type="text" name="uf" id="uf" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->UF;  endif;?>">
        </div>
        
        <div class="box-4 mg-b-2">
            <label for="" class="captalize">contato</label>
            <input type="text" name="contato" onkeypress="formata_mascara(this, '## #####-####')" maxlength="13" value="<?php if(isset($id) && $id <> '' ): echo $configuracoes[0]->CONTATO;  endif;?>">
        </div>
        

        <div class="box-6">
            <?php
            $imagem = isset($id) && $id != '' ?  $configuracoes[0]->LOGO : 'logo-padrao.png';
            $dirImagem = '/lib/img/upload/configuracoes/' . $imagem;
            $imagemAlt = $imagem === 'logo-padrao.png' ? 'Escolha o seu logo' : 'Logo atual';
            ?>
            <label for="img" class="file-label bg-cinza fonte12 radius fnc-preto-azulado txt-e mg-t-3 pd-10 ">
                <i class="fa-solid fa-file-image fonte16 fnc-cinza"></i>
                <?= $imagemAlt; ?>
            </label>
            <input type="file" id="img" name="imagem" class="" onchange="mostrar(this)" value="<?= $imagem; ?>">
            <img class=" borda-light pd-5 logo-150 mg-b-2" id="foto" src="<?= $dirImagem ?>" alt="<?= $imagemAlt; ?>">
        </div>

        <div class="box-12 ">
            <input type="submit" value="cadastrar" class="captalize btn-100 bg-primario fnc-terciario">
        </div>
    </form>
</div>