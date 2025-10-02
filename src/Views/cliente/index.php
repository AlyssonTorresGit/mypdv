<section class="cad mg-t-4">
    <div class="container">

        <div class="box-12 mg-t-2">
            <h2 class=" poppins-medium fw-300 fonte22 fnc-preto-azulado">
                <i class="fa-solid fa-bag-shopping mg-r-1 fonte22 fnc-preto-azulado"></i>
                <?php
                $titulo = isset($id) && $id <> '' ?  'Atualizar cliente ' : 'Cadastrar cliente';
                echo $titulo;
                ?>

            </h2>
        </div>

        <div class="box-12 divider mg-t-1 mg-b-2"></div>

        <div class="box-12">

            <form id="formCadastro" action="/cadastrar-cliente" method="POST" enctype="multipart/form-data" class="box-12 shadow-down  pd-10">
                <div class="box-12">
                    <input type="hidden" name="id" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->ID;
                                                endif; ?>">
                </div>
                <div class="box-8">
                    <label for="">Nome </label>
                    <input type="text" name="nome" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->NOME;
                                                endif; ?>" required>
                </div>

                <div class="box-4">
                    <label for="">Cpf </label>
                    <input type="text" name="cpf" id="cpf" maxlength="14" onkeypress="formata_mascara(this, '###.###.###-##')" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->CPF;
                                                endif; ?>" required>
                    <span id="cpfFeedback"></span>
                </div> 

                <div class="box-3">
                    <label for="">Data de Nascimento </label>
                    <input type="date" name="datanascimento" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->DATANASCIMENTO;
                                                endif; ?>">
                </div>

                <div class="box-3">
                    <label for="">Cep </label>
                    <input type="text" name="cep" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->CEP;
                                                endif; ?>" onkeypress="formata_mascara(this, '#####-###')" maxlength="9" onblur="getDadosEnderecoPorCEP(this.value)" required>
                </div>

                <div class="box-6">
                    <label for="">Endereço </label>
                    <input type="text" id='endereco' name="logradouro" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->LOGRADOURO;
                                                endif; ?>" readonly>
                </div>

                <div class="box-6">
                    <label for="">Bairro </label>
                    <input type="text" id="bairro" name="bairro" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->BAIRRO;
                                                endif; ?>" readonly>
                </div>

                <div class="box-6">
                    <label for="">Cidade </label>
                    <input type="text" id="cidade" name="cidade" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->CIDADE;
                                                endif; ?>" readonly>
                </div>

                <div class="box-2">
                    <label for="">Numero </label>
                    <input type="text" name="numero" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->NUMERO;
                                                endif; ?>" required>
                </div>

                <div class="box-2">
                    <label for="">Uf </label>
                    <input type="text" id="uf" name="uf" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->UF;
                                                endif; ?>" readonly>
                </div>                               

                <div class="box-8">
                    <label for="">Email </label>
                    <input type="email" name="email" id="email" value="<?php if (isset($id) && $id <> ''): echo $cliente[0]->EMAIL;
                                                endif; ?>" required>
                    <span id="emailFeedback"></span>
                </div>

                <div class="box-12">
                    <label for="img">Cadastrar Imagem </label>
                    <input type="file" name="imagem" id="img">
                </div>

                <div class="box-12">
                    <input type="submit" value="cadastrar" class="btn-100 bg-primario fnc-terciario mg-t-4">
                </div>

            </form>
        </div>
    </div>
</section>