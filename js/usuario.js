$(function(){
    $('.selectpicker').selectpicker({
        noneSelectedText: 'Nada selecionado'
    })
    $('#formUser').submit(function(e){
        e.preventDefault();
        var dados = $(this).serialize();
        $.ajax({
            url: base_url + 'usuarios/save',
            type: 'POST',
            data: dados
        }).done(function(result){
            var resposta = JSON.parse(result);
            if(resposta.success){
                bootbox.alert(resposta.message, function(){
                    window.location.reload();
                });
            } else {
                bootbox.alert(resposta.message);
            }
        });
    });
    $('.change-status').on('click', function(){
        var id     = $(this).data('id');
        var status = $(this).data('status');
        var texto  = status == 1 ? 'desativar' : 'ativar';
        bootbox.confirm({
            message: "Deseja realmente " + texto + " o usuário?",
            buttons: {
                confirm: {
                    label: 'Sim',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'Não',
                    className: 'btn-danger'
                }
            },
            callback: function (result) {
                if(result){
                    $.ajax({
                        url: base_url + 'usuarios/changeStatus',
                        type: 'POST',
                        data: {id: id, status: status}
                    }).done(function(data){
                        if(data){
                            texto = texto == 'desativar' ? 'desativado' : 'ativado';
                            bootbox.alert('Usuário ' + texto + ' com sucesso.', function(){
                                window.location.reload();
                            });
                        } else {
                            bootbox.alert('Erro ao ' + texto + ' usuário, tente novamente.');
                        }
                    });
                }
            }
        });
    });
    $('#categoria_id').on('change', function(){
        var categoria_id = $(this).val();
        $.ajax({
            url: base_url + 'subcategorias/getSubcategorias',
            type: 'POST',
            data: {id: categoria_id}
        }).done(function(result){
            var dados   = JSON.parse(result);
            var options = '';
            $.each(dados, function(index,value){
                options += '<option value="' + value.id + '">' + value.descricao + '</option>';
            });
            $('#subcategoria_id').html(options);
            $('.selectpicker').selectpicker('refresh');
        });
    });
});