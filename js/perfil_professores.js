$(function(){
    $('#formNewFormacao').submit(function(e){
        e.preventDefault();
        var dados = $(this).serialize();
        var url   = base_url + 'perfil/saveFormacao';
        $.post(url, dados, function(data){
            var result = JSON.parse(data);
            if(result.success){
                bootbox.alert(result.message, function(){
                    window.location.reload();
                });
            } else {
                bootbox.alert(result.message);
            }
        });
    });
    $('#formBiografia').submit(function(e){
        e.preventDefault();
        var dados = $(this).serialize();
        bootbox.confirm({
            message: "Deseja realmente alterar sua Biografia?",
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
                var url = base_url + 'perfil/saveBiografia';
                $.post(url, dados, function(data){
                    var result = JSON.parse(data);
                    if(result.success){
                        bootbox.alert(result.message, function(){
                            window.location.reload();
                        });
                    } else {
                        bootbox.alert(result.message);
                    }
                });
            }
        });
    });
    $('.btn-trash').on('click', function(){
        var formacao_id = $(this).data('id');
        bootbox.confirm({
            message: "Deseja realmente excluir a formação selecionada?",
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
                var url         = base_url + 'perfil/deleteFormacao';
                $.post(url, {formacao_id: formacao_id}, function(data){
                    var result = JSON.parse(data);
                    if(result.success){
                        bootbox.alert(result.message, function(){
                            window.location.reload();
                        });
                    } else {
                        bootbox.alert(result.message);
                    }
                });
            }
        });
    });
});