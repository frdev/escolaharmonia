$(function(){
    $('#formCurso').submit(function(e){
        e.preventDefault();
        var dados = $(this).serialize();
        var url   = base_url + 'cursos/save';
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
});