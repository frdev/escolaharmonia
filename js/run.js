// Arquivo que inicializa a variavel runApp para carregar as funções da View(data-controller)
$(function(){
    $('[data-controller]').each(function() {
        var controller = $(this).data('controller');

        if(controller in runApp.controller){
            runApp.controller[controller]();
        }
    });
});