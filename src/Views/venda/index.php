<?php require_once "../src/Views/shared/header.php"; ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PDV - Caixa Livre</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/pdv.css"> -->
</head>
<body>

  <div class="container-fluid main-bg p-3">
    <div class="pdv-container d-flex gap-3">

      <!-- Área principal esquerda -->
      <div class="flex-grow-1 painel-esquerdo p-3 rounded-4 shadow-sm">

        <!-- Campo de busca -->
        <div class="mb-3">
          <input type="text" class="form-control input-busca" placeholder="Digite o código, descrição ou código de barras do produto">
        </div>

        <!-- Linha com Quantidade e Descontos -->
        <div class="d-flex gap-3 mb-3">
          <div class="flex-fill">
            <label class="form-label small text-muted">Quantidade</label>
            <input type="number" class="form-control campo-dark text-center fs-5" value="1" min="1">
          </div>
          <div class="flex-fill">
            <label class="form-label small text-muted">Desconto em R$</label>
            <input type="number" class="form-control campo-dark text-center fs-5" placeholder="0,00">
          </div>
          <div class="flex-fill">
            <label class="form-label small text-muted">Desconto em %</label>
            <input type="number" class="form-control campo-dark text-center fs-5" placeholder="0%">
          </div>
        </div>

        <!-- Cabeçalho da tabela -->
        <div class="d-flex tabela-cabecalho text-light fw-bold px-2 py-2">
          <div class="flex-fill">Código</div>
          <div class="flex-fill">Produto</div>
          <div class="flex-fill">Quantidade</div>
          <div class="flex-fill">Desconto</div>
          <div class="flex-fill">Val. Uni</div>
          <div class="flex-fill">Sub-total</div>
        </div>

        <!-- Corpo da tabela -->
        <div class="painel-produtos d-flex align-items-center justify-content-center mt-4">
          <h1 class="fw-bold text-light opacity-75">Caixa Livre!</h1>
        </div>

      </div>

      <!-- Painel lateral -->
      <div class="painel-lateral p-3 rounded-4 shadow-sm d-flex flex-column justify-content-between">

        <div>
          <!-- Header do caixa -->
          <div class="d-flex justify-content-between align-items-center text-light mb-3">
            <div><i class="fa-solid fa-cash-register"></i> Caixa 01</div>
            <div>Caixa: Aberto</div>
            <div><i class="fa-solid fa-user"></i> Admin</div>
          </div>

          <!-- Totais -->
          <div class="mb-3">
            <p class="text-danger mb-1 fw-semibold">Total</p>
            <div class="caixa-total text-end">R$ 0,00</div>
          </div>

          <div class="mb-4">
            <p class="text-danger mb-1 fw-semibold">Desconto</p>
            <div class="caixa-desconto text-end">R$ 0,00</div>
          </div>

          <!-- Atalhos -->
          <h6 class="text-light mb-3">Atalhos úteis</h6>
          <div class="d-grid gap-2 mb-4">
            <button class="btn btn-dark-dark text-light"><i class="fa-solid fa-box"></i> Consultar Produto (F1)</button>
            <button class="btn btn-dark-dark text-light"><i class="fa-solid fa-user"></i> Consultar Cliente (F2)</button>
            <button class="btn btn-dark-dark text-light"><i class="fa-solid fa-percent"></i> Desconto (F4)</button>
          </div>

          <!-- Ações -->
          <h6 class="text-light mb-3">Ações</h6>
          <div class="d-grid gap-2">
            <button class="btn btn-dark-dark text-light"><i class="fa-solid fa-ban"></i> Cancelar Venda (F3)</button>
            <button class="btn btn-dark-dark text-light"><i class="fa-solid fa-trash"></i> Remover Item (F11)</button>
            <button class="btn btn-primary text-light"><i class="fa-solid fa-check"></i> Finalizar Venda (F9)</button>
          </div>
        </div>

        <!-- Rodapé -->
        <div class="d-flex justify-content-between mt-4 small text-light-50">
          <span><a href="#" class="text-light text-decoration-none">Logout</a></span>
          <span><a href="#" class="text-light text-decoration-none">Painel de Controle</a></span>
        </div>

      </div>
    </div>
  </div>

</body>
</html>
