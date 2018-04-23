<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$acesso = $this->session->userdata('logged');
if(empty($acesso)){
    redirect(base_url());
}
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
    <link rel="stylesheet" type="text/css" href="<?=base_url('css/bootstrap.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('css/bootstrap-select.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('css/fontawesome-all.min.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('css/navbar-fixed-side.css')?>">
    <link rel="stylesheet" type="text/css" href="<?=base_url('css/style.css')?>">
    <!-- Scripts -->
    <script>var base_url = '<?= base_url() ?>';</script>
    <script src="<?=base_url('js/jquery.min.js')?>"></script>
    <script src="<?=base_url('js/bootstrap.min.js')?>"></script>
    <script src="<?=base_url('js/bootstrap-select.min.js')?>"></script>
    <script src="<?=base_url('js/bootbox.min.js')?>"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 col-lg-2">
                <nav class="navbar navbar-fixed-side navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button class="navbar-toggle" data-target=".navbar-collapse" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?=base_url()?>home/">Escola Harmonia</a>
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="divider"></li>
                        <?php if($acesso['nivel_id'] == 1) : ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Administrativo <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=base_url('usuarios/customers')?>">Customers</a></li>
                                <li><a href="<?=base_url('usuarios/professores')?>">Professores</a></li>
                                <li><a href="<?=base_url('usuarios/alunos')?>">Alunos</a></li>
                            </ul>
                        </li>
                        <?php endif ?>
                        <?php if($acesso['nivel_id'] == 2) : ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Perfil <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="<?=base_url('perfil/edit')?>">Editar</a></li>
                                <li><a href="<?=base_url('perfil/professor/'.$acesso['id'])?>">Visualizar</a></li>
                            </ul>
                        </li>
                        <?php endif ?>
                        <?php if($acesso['nivel_id'] == 1) : ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cursos <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                    <li><a href="<?=base_url('cursos/')?>">Cursos</a></li>
                                    <li><a href="<?=base_url('categorias/')?>">Categorias</a></li>
                                <li><a href="<?=base_url('cursos/matriculados')?>"></a></li>
                            </ul>
                        </li>
                        <?php else : ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Meus Cursos <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <?php if($acesso['nivel_id'] == 2) : ?>
                                <li><a href="<?=base_url('cursos/publicar')?>">Publicar</a></li>
                                <?php else : ?>
                                <li><a href="cursos/matriculados">Matriculados</a></li>
                                <?php endif ?>
                            </ul>
                        </li>
                        <?php endif ?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Cursos <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Instrumentos</a></li>
                                <li><a href="#">Preparatórios Enem</a></li>
                            </ul>
                        </li>
                        
                    </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="<?=base_url('login/signout')?>">Sair</a></li>
                        </ul>
                    <p class="navbar-text">
                      Desenvolvido por<a href="http://www.frdevpro.com/portfolio" target="_blank"> FRDev</a>
                    </p>
                </div>
            </div>
          </nav>
            </div>
            <div class="col-sm-9 col-lg-10">
                <!-- Aqui que vai o conteúdo -->
            
