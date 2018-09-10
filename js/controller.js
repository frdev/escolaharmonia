// Inicializa as funções das controller
runApp.controller = {
    login:function(){
        // Função do formulário de login para validar acesso do usuário
        $('#formLogin').submit(function(e){
            e.preventDefault();
            var btn_login = $('.btn-login');
            btn_login.html('<i class="fas fa-circle-notch fa-spin"></i> Entrar');
            btn_login.prop('disabled', true);
            $('.retorno').html('<span class="alert alert-info">Yay, espere um pouquinho.</span>');
            var dados = $(this).serialize();
            $.post(base_url + 'login/signin', dados, function(result){
                if(result){
                    $('.retorno').html('<span class="alert alert-success">Login realizado, aguarde redirecionamento.</span>');
                    setTimeout(function(){
                        window.location.href = base_url + 'cursos/';
                    }, 2200);
                } else {
                    $('.retorno').html('<span class="alert alert-danger">Usuário ou senha inválidos, tente novamente.</span>');
                    btn_login.html('<i class="fas fa-sign-in-alt"></i> Entrar');
                    btn_login.prop('disabled', false);
                }
            });
        });
        $('select[name="tipo"]').on('change', function(){
            var valor = $(this).val();
            if(valor == 'titular'){
                $('#dado').mask('000.000.000-00');
                $('label[for="dado"]').html('CPF');
            } else {
                $('#dado').mask('00/00/0000');
                $('label[for="dado"]').html('Data de nascimento');
            }
            $('#dado').val('');
        });
    },
    categorias:function(){
        $('#formNewCategory').submit(function(e){
            e.preventDefault();
            var dados = $(this).serialize();
            $.post(base_url = 'categorias/save', dados, function(result){
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
            $.post(base_url + 'subcategorias/save', dados, function(result){
                if(result){
                    bootbox.alert("Subcategoria cadastrada com sucesso!", function(){
                        window.location.reload();
                    });
                } else {
                    bootbox.alert("Erro ao cadastrar subcategoria");
                }
            })
        });
        $('#categoria').on('change', function(){
            var categoria_id   = $(this).val();
            var categoria_nome = $('#categoria :selected').text();
            if(categoria_id != ''){
                $('#form-subcategoria').show();
                $.post(base_url + 'subcategorias/getSubcategorias', {id: categoria_id}, function(result){
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
    },
    cursos:function(){
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
        $('.change-status').on('click', function(){
            var id     = $(this).data('id');
            var status = $(this).data('status');
            var texto  = status == 1 ? 'desativar' : 'ativar';
            bootbox.confirm({
                message: "Deseja realmente " + texto + " o curso?",
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
                        $.post(base_url + 'cursos/' + texto, {id: id}, function(data){
                            if(data){
                                texto = texto == 'desativar' ? 'desativado' : 'ativado';
                                bootbox.alert('Curso ' + texto + ' com sucesso.', function(){
                                    window.location.reload();
                                });
                            } else {
                                bootbox.alert('Erro ao ' + texto + ' curso, tente novamente.');
                            }
                        });
                    }
                }
            });
        });
        $('#formVideo').submit(function(e){
            e.preventDefault();
            var dados = $(this).serialize();
            $.post(base_url + 'videos/save', dados, function(data){
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
        $('#formUpdateVideo').submit(function(e){
            e.preventDefault();
            var dados = $(this).serialize();
            $.post(base_url + 'videos/update', dados, function(data){
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
        $('.trash').on('click', function(){
            var id = $(this).data('id');
            bootbox.confirm({
                message: "Deseja realmente deletar essa vídeo aula?",
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
                            url: base_url + 'videos/delete',
                            type: 'POST',
                            data: {id: id}
                        }).done(function(data){
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
                }
            });
        });
    },
    publicados:function(){
        $('#categoria').on('change', function(){
            var categoria_id = $(this).val();
            if(!categoria_id){
                $('#subcategoria').html('<option value="">Selecione...</option>');
                $('.selectpicker').selectpicker('refresh');
                $('[data-categoria]').removeClass('fadeOut');
                setTimeout(function(){
                    $('[data-categoria]').show();
                }, 150);
            } else {
                var url = base_url + 'subcategorias/getSubsByCatIdAndCursosPublicados';
                $.post(url, {categoria_id: categoria_id}, function(data){
                    var result  = JSON.parse(data);
                    var options = '<option value="">Selecione...</option>';
                    $.each(result, function(index, value){
                        options += '<option value="' + value.id + '">' + value.descricao + '</option>';
                    });
                    $('#subcategoria').html(options);
                    $('.selectpicker').selectpicker('refresh');
                });
                $('[data-categoria]').addClass('fadeOut');
                $('[data-categoria="' + categoria_id + '"]').removeClass('fadeOut');
                $('[data-subcategoria]').removeClass('bounceOut');
                // Seta intervalo de tempo para esconder a div do html
                setTimeout(function(){
                    $('[data-categoria]').hide();
                    $('[data-categoria="' + categoria_id + '"]').show();
                    $('[data-subcategoria]').show();
                }, 670); 
            }
        });
        $('#subcategoria').on('change', function(){
            var categoria_id    = $('#categoria').val();
            var subcategoria_id = $(this).val();
            if(!subcategoria_id){
                $('#subcategoria').html('<option value="">Selecione...</option>');
                $('.selectpicker').selectpicker('refresh');
                $('[data-subcategoria]').removeClass('bounceOut');
                setTimeout(function(){
                    $('[data-subcategoria]').show();
                }, 150);
            } else {
                $('[data-subcategoria]').addClass('bounceOut');
                $('[data-subcategoria="' + subcategoria_id + '"]').removeClass('bounceOut');
                // Seta intervalo de tempo para esconder a div do html
                setTimeout(function(){
                    $('[data-subcategoria]').hide();
                    $('[data-subcategoria="' + subcategoria_id + '"]').show();
                }, 670);   
            }
        });
        $('.matricula').on('click', function(){
            var curso_id = $(this).data('id');
            bootbox.confirm({
                message: "Deseja realmente se matricular no curso?",
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
                    var url = base_url + 'cursos/matricula';
                    $.post(url, {curso_id: curso_id},function(result){
                        if(result){
                            bootbox.alert('Matrícula realizada com sucesso, aguarde o redirecionamento.', function(){
                                window.location.href = base_url + 'cursos/curso/' + curso_id;
                            });
                        } else {
                            bootbox.alert('Erro ao realizar Matrícula, tente novamente.');
                        }
                    });
                }
            });
        });
    },
    professores:function(){
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
    },
    usuarios:function(){
        $('.selectpicker').selectpicker({
            noneSelectedText: 'Nada selecionado'
        })
        $('#formUser').submit(function(e){
            e.preventDefault();
            var dados = $(this).serialize();
            $.post(base_url + 'usuarios/save', dados, function(result){
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
                        $.post(base_url + 'usuarios/changeStatus', {id: id, status: status}, function(data){
                            if(data){
                                texto = texto == 'desativar' ? 'desativado' : 'ativado';
                                bootbox.alert('Usuário ' + texto + ' com sucesso.', function(){
                                    window.location.reload();
                                });
                            } else {
                                bootbox.alert('Erro ao ' + texto + ' usuário, tente novamente.');
                            }
                        })
                    }
                }
            });
        });
        $('#categoria_id').on('change', function(){
            var categoria_id = $(this).val();
            $.post(base_url + 'subcategorias/getSubcategorias', {id: categoria_id}, function(result){
                var dados   = JSON.parse(result);
                var options = '';
                $.each(dados, function(index,value){
                    options += '<option value="' + value.id + '">' + value.descricao + '</option>';
                });
                $('#subcategoria_id').html(options);
                $('.selectpicker').selectpicker('refresh');
            });
        });
    }
}