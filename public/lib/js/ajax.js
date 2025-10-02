$(function () {
    $('.toggle-status').on('click', function () {
        const span = $(this);
        const userId = span.data('id');
        const newStatus = span.data('status');
        const url = span.data('url');

        $.ajax({
            type: 'GET',
            url: `${url}/${userId}/${newStatus}`,
            beforeSend: function () {
                span.css('opacity', '0.5'); // efeito suave
            },
            success: function () {
                // Atualiza o status diretamente no HTML
                const icon = span.find('i');
                if (newStatus == 1) {
                    icon.removeClass('fa-lock fnc-laranja-claro')
                        .addClass('fa-lock-open fnc-sucesso');
                    span.data('status', 0); // atualiza para o próximo clique
                } else {
                    icon.removeClass('fa-lock-open fnc-sucesso')
                        .addClass('fa-lock fnc-laranja-claro');
                    span.data('status', 1);
                }
            },
            complete: function () {
                span.css('opacity', '1'); // restaura o ícone
            },
            error: function () {
                alert('Erro ao alterar o status do usuário. Tente novamente.');
            }
        });
    });
});

$(function () {
    $('.qtde').change(function () {
        var quantidade = $(this).val();
        var linha = $(this).data('linha'); 

        $.ajax({
            type: "POST",
            url: "index.php?controller=CarrinhoController&metodo=atualizarCarrinho",
            data: { linha: linha, quantidade: quantidade }, 
            success: function () {
                location.reload();
            }
        });
    });
});

// METODO RESPONSAVEL POR INSEIR PRODUTOS NO CARRINHO
$(function () {
    $('#inputProduto').change(function () {
        var codigo = $('#inputProduto').val();
        var qtde = parseInt($('#inputQtde').val());
        //alert("Chegou aqui!"+codigo+"  qtde "+qtde);
        $.ajax({
            type: "POST",
            url: "/gerar-venda",
            data: { codigo: codigo, qtde: qtde },
            success: function () {
                location.reload();
            }
        });
    });
});