// Este bloco aguarda qualquer tecla ser pressionada
document.addEventListener('keydown', function (e) {
    // Previne o comportamento padrão da tecla (importante para F1 e F2 que abrem ajuda do navegador)
    if (e.key === 'F1' || e.key === 'F2' || e.key === 'F3' || e.key === 'F4' || e.key === 'F5') {
        e.preventDefault();
    }

    // Se pressionar F1, redireciona para a rota de consulta de produtos
    if (e.key === 'F1') {
        // Explicação: Simula o clique em um botão ou link. Ideal para atalhos de teclado.
        window.location.href = '/consultar-produtos';
    }

    // Se pressionar F2, redireciona para a rota de consulta de clientes
    if (e.key === 'F2') {
        window.location.href = '/consultar-clientes';
    }

     // Se pressionar F11, pergunta ao usuário se deseja cancelar a venda
    if (e.key === 'F3') {
        // Mostra um diálogo de confirmação
        const confirmar = confirm("Deseja realmente cancelar esta venda?");

        // Se o usuário confirmar, redireciona para uma rota que destrói a sessão da venda
        if (confirmar) {
            // Recomendado criar uma rota PHP como /cancelar-venda que dê um session_destroy() ou unset
            window.location.href = '/cancelar-venda';
        }
    }

    if (e.key === 'F4') {
        window.location.href = '/consultar-carrinho';
    }   

        if (e.key === 'F5') {
        window.location.href = '/opcoes-venda';
    }

    // Se pressionar ENTER, executa a finalização da venda
    if (e.key === 'Enter') {
        // Aqui você pode, por exemplo, fazer uma requisição AJAX para gravar a venda ou redirecionar formFinalizarVenda
        document.getElementById('formFinalizarVenda').submit();

    }

});

//   SCRIPT MODAL
// Mostra a modal com o título desejado
function abrirModal(titulo) {
    document.getElementById('modalTitulo').textContent = titulo;
    document.getElementById('modalConsulta').style.display = 'block';
}

// Atalhos de teclado (com redirecionamentos substituídos por modais)
document.addEventListener('keydown', function (e) {
    // Evita conflito com ajuda do navegador
    if (e.key === 'F1' || e.key === 'F2' || e.key === 'F3' || e.key === 'F11' || e.key === 'Escape') e.preventDefault();

    // F1 = Consultar Produto
    if (e.key === 'F1') {
        abrirModal('Consulta de Produtos');
    }

    // F2 = Consultar Cliente
    if (e.key === 'F2') {
        abrirModal('Consulta de Clientes');
    }
    // F2 = Consultar Cliente
    if (e.key === 'F5') {
        abrirModal('Excluir item carrinho');
    }

    // Enter = Finaliza venda
    if (e.key === 'Enter') {
        alert("Venda finalizada com sucesso!");
    }

    // ESC = Fecha a modal ou cancela a venda
    if (e.key === 'Escape') {
        window.location.href = '/gerar-venda';
    }
});