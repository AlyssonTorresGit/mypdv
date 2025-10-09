<?php require_once __DIR__ . "/../shared/header.php"; ?>
<?php

use App\Configurations\Formater;

$formater = new Formater();
?>
<div class="box-12 mg-t-2">
    <div class="box-8">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-user mg-r-1 fonte22 fnc-preto-azulado"></i> Lista de Usuario
        </h2>
    </div>
    <div class="box-4 flex justify-end item-centro">
        <a href="/cadastrar-usuario" class=" bg-primario pd-10 radius fw-600 fnc-terciario">Novo Usuario</a>
    </div>
</div>

<div class="box-12 divider mg-t-1 mg-b-2"></div>

<div class="box-12">
    <table class="zebra wd-100 collapse" id="tabela">
        <thead>
            <tr>
                <th class="fonte12 espaco-letra fw-bold">Data Cadastro</th>
                <th class="fonte12 espaco-letra fw-bold">Nome</th>
                <th class="fonte12 espaco-letra fw-bold">Email</th>
                <th class="fonte12 espaco-letra fw-bold">Perfil</th>
                <th class="fonte12 espaco-letra fw-bold">Status</th>
                <th class="fonte12 espaco-letra fw-bold">Açoes</th>
            </tr>
        </thead>
        <tbody>

            <?php
            #var_dump($proprietario);
            if (isset($usuarios) && count($usuarios) > 0):
                foreach ($usuarios as  $usuario):
                    $dataCadastro = $usuario->DATACADASTRO ?: date('0000-00-00');
            ?>
            <tr class="tr">
                <td class="fonte12 espaco-letra fw-300 txt-c"><?= $formater->formatarDataTime($dataCadastro); ?></td>
                <td class="fonte12 espaco-letra fw-300 txt-c"><?= $formater->formataTextoCap($usuario->NOME); ?></td>
                <td class="fonte12 espaco-letra fw-300 txt-c"> <?= $formater->formataTextoLow($usuario->EMAIL); ?></td>
                <td class="fonte12 espaco-letra fw-300 txt-c"><?php if ($usuario->PERFIL == '1'): echo 'Administrador';
                                                                        elseif ($usuario->PERFIL == '2'): echo 'Gerente';
                                                                        else: echo "Operador";
                                                                        endif; ?> </td>
                <td class=" txt-c">
                    <span class="toggle-status" data-id="<?= $usuario->ID; ?>"
                        data-status="<?= $usuario->ATIVO == '1' ? '0' : '1'; ?>" data-url="/alterar-status-usuario">
                        <?php if ($usuario->ATIVO == '1'): ?>
                        <i class="fa-solid fa-lock-open fonte12 fnc-sucesso"></i>
                        <?php else: ?>
                        <i class="fa-solid fa-lock fonte12 fnc-laranja-claro"></i>
                        <?php endif; ?>
                    </span>
                </td>
                <td class="txt-c">
                    <a href="/deletar-usuario/<?= $usuario->ID; ?>">
                        <i class="fa-solid fa-trash-can fonte12 mg-r-2 fnc-error"></i>
                    </a>
                    <a href="/editar-usuario/<?= $usuario->ID; ?>">
                        <i class="fa-solid fa-pen fonte12 fnc-primario"></i>
                    </a>

                </td>
            </tr>
            <?php endforeach;
            else: ?>
            <td colspan="6" class="pd-t-2">
                <h1 class="txt-c fonte16 poppins-medium"> Nenhum registro na base de dados </h1>
            </td>
            <?php endif; ?>


        </tbody>
        <tfoot>

        </tfoot>
    </table>

</div>