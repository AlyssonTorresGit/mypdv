<?php require_once "../src/Views/shared/header.php"; ?>

<div class="container pd-20">

    <div class="box-12 flex  justify-start item-centro bg-primario  pd-10">

        <h1 class="poppins-medium fonte22 box-6 fnc-branco">
            <?= $titulo; ?>
            <i class="<?= $icon ?> fnc-primario"></i>
        </h1>

        <div class="box-6 flex justify-end">
            <a href="?tipo=<?= htmlspecialchars($tipo) ?>&inicio=<?= urlencode($inicio)?>&fim=<?= urlencode($fim)?>&export=pdf" class="mg-r-2">
                <button class="sem-borda pd-5 bg-error fnc-branco">📄 Exportar PDF</button>
            </a>
            <a href="?tipo=<?= htmlspecialchars($tipo) ?>&inicio=<?= urlencode($inicio)?>&fim=<?= urlencode($fim)?>&export=excel">
                <button class="sem-borda pd-5 bg-sucesso fnc-branco">📊 Exportar Excel</button>
            </a>
        </div>
    </div>

    <div class="box-12 mg-t-4  grid collapse">
        <table class="wd-100">
            <thead>
                <tr>
                    <?php foreach ($cabecalho as $col): ?>
                        <th>
                            <?= htmlspecialchars($col) ?>
                        </th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dados)): ?>
                    <?php foreach ($dados as $linha): ?>
                        <tr>
                            <?php foreach ($linha as $valor): ?>
                                <td class="txt-c"><?= htmlspecialchars($valor) ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?= count($cabecalho) ?>" class="txt-c fonte14 poppins-medium fnc-laranja pd-t-4">Não há registros para o período selecionado!</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>