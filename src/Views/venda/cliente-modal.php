<?php require_once "../src/Views/venda/index.php"; ?>
<div class="modal">
    <div class="lista-produto-modal bg-branco  animate__animated animate__flipInX">
        <h2 class=" poppins-medium fw-300 fonte22">
            <i class="fa-solid fa-tags mg-r-1 fonte22 fnc-preto-azulado"></i> Lista de Clientes
        </h2>
        <table class="zebra wd-100 collapse" id="tabela">
            <thead>
                <tr>
                    <th class="fonte12 espaco-letra fw-bold">Data Cadastro</th>
                    <th class="fonte12 espaco-letra fw-bold">Nome</th>
                    <th class="fonte12 espaco-letra fw-bold">Cpf</th>
                    <th class="fonte12 espaco-letra fw-bold">Endereço</th>
                    <th class="fonte12 espaco-letra fw-bold">Bairro</th>
                    <th class="fonte12 espaco-letra fw-bold">Cidade</th>
                    <th class="fonte12 espaco-letra fw-bold">Status</th>
                    <th class="fonte12 espaco-letra fw-bold">Açoes</th>
                </tr>
            </thead>
            <tbody>

                <?php
                #var_dump($proprietario);
                if (isset($clientes) && count($clientes) > 0):
                    foreach ($clientes as  $cliente):
                        $dataCadastro = $cliente->DATACADASTRO ?: date('0000-00-00');
                ?>
                        <tr class="tr">
                            <td class="fonte12 espaco-letra fw-300 txt-c"><?= $formater->formatarDataTime($dataCadastro); ?></td>
                            <td class="fonte12 espaco-letra fw-300 txt-c"><?= $formater->formataTextoCap($cliente->NOME); ?></td>
                            <td class="fonte12 espaco-letra fw-300 txt-c"><?= $formater->formataTextoCap($cliente->CPF); ?></td>
                            <td class="fonte12 espaco-letra fw-300 txt-c"><?= $formater->formataTextoCap($cliente->LOGRADOURO); ?></td>
                            <td class="fonte12 espaco-letra fw-300 txt-c"><?= $formater->formataTextoCap($cliente->BAIRRO); ?></td>
                            <td class="fonte12 espaco-letra fw-300 txt-c"><?= $formater->formataTextoCap($cliente->CIDADE); ?></td>
                            <td class=" txt-c">
                                <span class="toggle-status"
                                    data-id="<?= $cliente->ID; ?>"
                                    data-status="<?= $cliente->ATIVO == '1' ? '0' : '1'; ?>"
                                    data-url="/alterar-status-cliente">
                                    <?php if ($cliente->ATIVO == '1'): ?>
                                        <i class="fa-solid fa-lock-open fonte12 fnc-sucesso"></i>
                                    <?php else: ?>
                                        <i class="fa-solid fa-lock fonte12 fnc-laranja-claro"></i>
                                    <?php endif; ?>
                                </span>
                            </td>
                            <td class="txt-c">
                                <a href="/deletar-cliente/<?= $cliente->ID; ?>">
                                    <i class="fa-solid fa-trash-can fonte12 mg-r-2 fnc-error"></i>
                                </a>
                                <a href="/editar-cliente/<?= $cliente->ID; ?>">
                                    <i class="fa-solid fa-pen fonte12 fnc-primario"></i>
                                </a>

                            </td>
                        </tr>
            </tbody>
        <?php endforeach;
                else: ?>
        <tfoot>
            <tr>
                <td colspan="8" class="pd-t-2">
                    <h1 class="txt-c fonte16 poppins-medium fw-300 fnc-secundario"> Nenhum registro na base de dados </h1>
                </td>
            </tr>
        </tfoot>

    <?php endif; ?>




        </table>
    </div>
</div>
<script>
    let table = new DataTable('#tabela');
</script>