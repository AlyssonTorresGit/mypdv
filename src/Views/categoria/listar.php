<div class="box-12 mg-t-2">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-tags mg-r-1 fonte22 fnc-preto-azulado"></i> Lista de Categorias
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="/cadastrar-categoria" class=" bg-primario fnc-terciario pd-10 radius fw-600">Nova Categoria</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse" id="tabela">
        <thead>
            <tr>
                <th class="fonte12 pd-10">Código</th>
                <th class="fonte12 pd-10">Descrição</th>
                <th class="fonte12 pd-10">Estatus</th>
                <th class="fonte12 pd-10">Ações</th>
            </tr>
        </thead>

        <tbody>
            <?php
            if (isset($categorias) && count($categorias)):
                foreach ($categorias as $categoria):
                    if (is_null($categoria->ID)): $categoria->ID = 0;
                    endif; ?>
                    <tr>
                        <td class="fonte12 pd-10 txt-c"><?= str_pad($categoria->ID, 6, '0',STR_PAD_LEFT); ?></td>
                        <td class="fonte12 pd-10 txt-c"><?= ucfirst(strtolower($categoria->DESCRICAO)); ?></td>
                        <td class=" txt-c">
                            <span class="toggle-status"
                                data-id="<?= $categoria->ID; ?>"
                                data-status="<?= $categoria->ESTATUS == 'A' ? 'I' : 'A'; ?>"
                                data-url="/alterar-status-categoria">
                                <?php if ($categoria->ESTATUS == 'A'): ?>
                                    <i class="fa-solid fa-lock-open fonte12 fnc-sucesso"></i>
                                <?php else: ?>
                                    <i class="fa-solid fa-lock fonte12 fnc-laranja-claro"></i>
                                <?php endif; ?>
                            </span>
                        </td>
                        <td class="txt-c">
                            <a href="/deletar-categoria/<?= $categoria->ID; ?>">
                                <i class="fa-solid fa-trash-can fonte12 mg-r-2 fnc-error"></i>
                            </a>
                            <a href="/editar-categoria/<?= $categoria->ID; ?>">
                                <i class="fa-solid fa-pen fonte12 fnc-primario"></i>
                            </a>

                        </td>
                    </tr>
                <?php endforeach; endif; ?>
        </tbody>
    </table>
</div>