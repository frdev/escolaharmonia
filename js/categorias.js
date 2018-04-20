$(function(){
    $('#formNewCategory').submit(function(e){
        e.preventDefault();
        var dados = $(this).serialize();
        $.ajax({
            url: base_url + 'categorias/save',
            type: 'POST',
            data: dados
        }).done(function(result){
            if(result){
                bootbox.alert("Categoria cadastrada com sucesso!", function(){
                    window.location.reload();
                });
            } else {
                bootbox.alert("Erro ao cadastrar categoria");
            }
        });
    });
    $('#formNewSubCategory').submit(function(e){
        e.preventDefault();
        var dados = $(this).serialize();
        $.ajax({
            url: base_url + 'subcategorias/save',
            type: 'POST',
            data: dados
        }).done(function(result){
            if(result){
                bootbox.alert("Subcategoria cadastrada com sucesso!", function(){
                    window.location.reload();
                });
            } else {
                bootbox.alert("Erro ao cadastrar subcategoria");
            }
        });
    });
    $('#categoria').on('change', function(){
        var categoria_id   = $(this).val();
        var categoria_nome = $('#categoria :selected').text();
        if(categoria_id != ''){
            $('#form-subcategoria').show();
            $.ajax({
                url: base_url + 'subcategorias/getSubcategorias',
                data: {id: categoria_id},
                type: 'POST'
            }).done(function(result){
                var data       = JSON.parse(result);
                var list_group = '';
                $.each(data, function(index, value){
                    list_group += '<li class="list-group-item">';
                    list_group += value.descricao;
                    list_group += '</li>';
                });
                $('.list-subcategorias').find('.list-group').html(list_group);
                $('.list-subcategorias').find('.nome-categoria').html('Subcategorias de ' + categoria_nome);
                $('.list-subcategorias').show();
            });
        } else {
            $('#form-subcategoria').hide();
            $('.list-subcategorias').hide();
        }
    });
});