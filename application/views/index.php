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
            margin-top: 7%;
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
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-center info">
                <h1><u>Escola Harmonia</u></h1>
                <p>AQUI É ONDE VAI SE ENCONTRAR O TEXTO DE APRESENTAÇÃO</p>
                <p>AQUI QUE VAI SER A LISTAGEM DOS CURSOS</p>
                <ul class="list-group">
                    <li class="list-group-item">Curso 1</li>
                    <li class="list-group-item">Curso 2</li>
                    <li class="list-group-item">Curso 3</li>
                </ul>
                <p>LINK PARA REALIZAR O CADASTRO NA PLATAFORMA</p>
            </div>
            <div class="col-md-6 panel-login">
                <div class="row">
                    <?= form_open('', 'id="formLogin"') ?>
                        <div class="col-md-offset-2 col-md-8 col-md-offset-2">
                            <div class="panel panel-default" style="border-color: #000;">
                                <div class="panel-heading" style="color: #fff; background-color: #000; border-color: #000;">
                                    Conecte-se à sua conta
                                </div>
                                <div class="panel-body">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-user" aria-hidden="true"></i></span>
                                        <?php
                                            echo form_input(array(
                                                'name'        => 'email',
                                                'id'          => 'email',
                                                'class'       => 'form-control',
                                                'maxLength'   => '100',
                                                'type'        => 'email',
                                                'placeholder' => 'E-mail',
                                                'required'    => 'required'
                                            ));
                                        ?>
                                    </div>
                                    <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fas fa-key" aria-hidden="true"></i></span>
                                        <?php
                                            echo form_password(array(
                                                'name'        => 'senha',
                                                'id'          => 'senha',
                                                'class'       => 'form-control',
                                                'maxLength'   => '100',
                                                'placeholder' => '****',
                                                'required'    => 'required'
                                            ));
                                        ?>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <div class="row">
                                        <div>
                                            <?php
                                                echo form_button(array(
                                                    'type'    => 'submit',
                                                    'class'   => 'btn btn-md btn-primary pull-right btn-login',
                                                    'content' => '<i class="fas fa-sign-in-alt"></i> Entrar'
                                                ));
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?= form_close() ?>
                </div>
                <div class="row">
                    <div class="col-offset-md-2 col-md-8 col-md-offset-2">
                        <div class="retorno text-center"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>var base_url = '<?= base_url() ?>';</script>
    <script src="<?=base_url('js/jquery.min.js')?>"></script>
    <script src="<?=base_url('js/login.js')?>"></script>
</body>
</html>