<?php
$acesso = $this->session->userdata('logged');
?>       
    <div class="publicados">
        <div class="row">
            <h2 class="text-center">Cursos Harmonia</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        <strong>Categoria:</strong>
                        <select class="selectpicker" id="categoria">
                            <option value="">Selecione...</option>
                            <?php foreach($select_categorias as $categoria) : ?>
                                <option value="<?=$categoria['id']?>"><?=$categoria['descricao']?></option>
                            <?php endforeach?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <strong>Subcategoria:</strong>
                        <select class="selectpicker" id="subcategoria">
                            <option value="">Selecione...</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <?php if(!empty($cursos['categorias'])) : ?>
            <?php foreach($cursos['categorias'] as $id_cat => $categoria) : ?>
                <div class="row animated fadeIn" data-categoria="<?=$id_cat?>">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading head-categoria"><?=$categoria['cat_descricao']?></div>
                            <?php foreach($categoria['subcategorias'] as $id_sub => $subcategoria) : ?>
                                <div class="panel-body animated bounceIn" data-subcategoria="<?=$id_sub?>">
                                    <ul class="list-group">
                                        <li class="list-group-item head-subcategoria"><?=$subcategoria['descricao']?></li>
                                        <?php foreach($subcategoria['cursos'] as $curso) : ?>
                                            <li class="list-group-item" data-curso="<?=$curso['id']?>"><?=$curso['titulo']?> - Prof <?=$curso['nome']?> 
                                                <?php if($acesso['nivel_id'] == 3) : ?>
                                                    <?php
                                                        $mat = false;
                                                        foreach($cursos_aluno as $matricula) :
                                                            if($matricula == $curso['id']){
                                                                $mat = true;
                                                                break;    
                                                            }
                                                        endforeach
                                                    ?>
                                                    <?php if($mat) : ?>
                                                        <a href="<?=base_url('cursos/curso/'.$curso['id']);?>" class="pull-right"><i class="fas fa-chevron-right"></i> Ir para o curso</a>
                                                    <?php else : ?>
                                                        <a class="pull-right matricula" data-id="<?=$curso['id']?>"><i class="fas fa-plus"></i> Matricule-se</a>
                                                    <?php endif ?>
                                                <?php else : ?>
                                                    <a href="<?=base_url('cursos/curso/'.$curso['id']);?>" class="pull-right"><i class="fas fa-chevron-right"></i> Ir para o curso</a>
                                                <?php endif ?>
                                            </li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php else : ?>
            <div class="alert alert-info text-center"><strong>Não existem cursos cadastrados.</strong></div>
        <?php endif ?>
    </div>