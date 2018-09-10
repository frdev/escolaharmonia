<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="content-language" content="pt-br" />
    <meta name="author" content="Felipe Ristow" />
    <meta name="copyright" content="© 2018 Felipe Ristow" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <title>Escola Harmonia</title>
    <meta name="description" content="Tela de login" />
    <link rel="stylesheet" type="text/css" href="<?=base_url('css/bootstrap.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('css/fontawesome-all.min.css')?>">
    <style>
        html, body {
            margin: 0;
            padding: 0;
        }
        .info {
            margin-top: 11%;
        }
        .panel-login {
            margin-top: 11%;
        }
        .btn-login {
            margin-right: 5%;
        }
    </style>
</head>
<body>
    <div class="container" data-controller="login">
        <form id="formLogin" class="row panel-login">
            <input type="hidden" name="tipo_login" value="admin">
                <div class="col-md-offset-4 col-md-4 col-md-offset-4">
                    <div class="panel panel-default" style="border-color: #000;">
                        <div class="panel-heading" style="color: #fff; background-color: #000; border-color: #000;">
                            Conecte-se à sua conta - ÁREA ADMINISTRATIVA
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label>E-mail</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-at" aria-hidden="true"></i></span>
                                    <input type="text" name="email" id="email" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dado">Senha</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fas fa-id-card" aria-hidden="true"></i></span>
                                    <input type="password" name="senha" id="senha" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div>
                                    <button type="button" class="btn btn-md btn-info" style="margin-left: 5%;" data-toggle="modal" data-target="#modal"><i class="fa fa-user-plus"></i> Solicitar Acesso</button>
                                    <button type="submit" class="btn btn-md btn-primary pull-right btn-login"><i class="fas fa-sign-in-alt"></i> Entrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
        <div class="row">
            <div class="col-offset-md-2 col-md-8 col-md-offset-2">
                <div class="retorno text-center"></div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Solicitar Acesso</h4>
                </div>
                <div class="modal-body">
                    <p>Para solicitar acesso, deve-se encaminhar um e-mail para <a href="mailto:contato@escolavirtualharmonia.com.br">contato@escolavirtualharmonia.com.br</a> com as informações abaixo.</p>
                    <ul>
                        <li>Nome</li>
                        <li>E-mail</li>
                        <li>CPF</li>
                        <li>Nome da Associação</li>
                        <li>Número do Contrato</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    <script>var base_url = '<?= base_url() ?>';</script>
    <script src="<?=base_url('js/jquery.min.js')?>"></script>
    <script src="<?=base_url('js/jquery.mask.js')?>"></script>
    <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('js/app.js')?>"></script>
    <script src="<?=base_url('js/controller.js')?>"></script>
    <script src="<?=base_url('js/run.js')?>"></script>
</body>
</html>