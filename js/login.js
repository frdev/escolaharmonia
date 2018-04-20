$(function(){
    // Função do formulário de login para validar acesso do usuário
    $('#formLogin').submit(function(e){
        e.preventDefault();
        var btn_login = $('.btn-login');
        btn_login.html('<i class="fas fa-circle-notch fa-spin"></i> Entrar');
        btn_login.prop('disabled', true);
        $('.retorno').html('<span class="alert alert-info">Yay, espere um pouquinho.</span>');
        var dados = $(this).serialize();
        $.ajax({
            url: base_url + 'login/signin',
            type: 'POST',
            data: dados
        }).done(function(result){
            if(result){
                $('.retorno').html('<span class="alert alert-success">Login realizado, aguarde redirecionamento.</span>');
                setTimeout(function(){
                    window.location.href = base_url + 'home/';
                }, 2200);
            } else {
                $('.retorno').html('<span class="alert alert-danger">Usuário ou senha inválidos, tente novamente.</span>');
                btn_login.html('<i class="fas fa-sign-in-alt"></i> Entrar');
                btn_login.prop('disabled', false);
            }
        });
    });
});