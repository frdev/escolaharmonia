    <div data-controller="cursos">
        <div class="row">
            <h2 class="text-center">Publicar Curso</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Cadastrar Curso</h3>
                <?= form_open('', 'id="formCurso"') ?>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <?= form_label('Subcategoria', 'subcategoria_id') ?>
                            <?= form_dropdown('subcategoria_id', $subcategorias, '', 'class="selectpicker" id="subcategoria_id" data-width="100%" required') ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?= form_label('Nível', 'nivel') ?>
                            <?= form_dropdown('nivel', $niveis, '', 'class="selectpicker" id="nivel" data-width="100%" required') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Título', 'titulo');
                            echo form_input(array(
                                'name'      => 'titulo',
                                'id'        => 'titulo',
                                'class'     => 'form-control',
                                'maxLength' => '150',
                                'required'  => 'required'
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <small>* Descrição do curso que será apresentado, tal como ementa e plano de ensino.</small>
                            <textarea name='descricao_curso' id='descricao_curso'></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <?php
                            echo form_button(array(
                                'type'    => 'submit',
                                'class'   => 'btn btn-md btn-primary pull-right',
                                'content' => 'Cadastrar'
                            ));
                            ?>
                        </div>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <h3>Cursos Cadastrados</h3>
                <small>* Para publicar um curso, deve-se ter pelo menos um vídeo vinculado ao mesmo. Caso esteja acontecendo erro na publicação, verifique se existe alguma vídeo aula publicada.</small>
                <table class="table table-bordered table-cursos">
                    <thead>
                        <tr>
                            <th class="text-center">Título</th>
                            <th class="text-center">Subcategoria</th>
                            <th class="text-center">Nível</th>
                            <th class="text-center">Publicado?</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($cursos)) : ?>
                            <?php foreach($cursos as $curso) : ?>
                                <tr>
                                    <td class="text-center"><?=$curso['titulo']?></td>
                                    <td class="text-center"><?=$curso['descricao_sub']?></td>
                                    <td class="text-center">
                                        <?php
                                            if($curso['nivel'] == 0) :
                                                echo 'Básico';
                                            elseif($curso['nivel'] == 1) :
                                                echo 'Intermediário';
                                            else :
                                                echo 'Avançado';
                                            endif
                                        ?>
                                    </td>
                                    <td class="text-center"><?=$curso['status'] == 0 ? 'Não' : 'Sim'?></td>
                                    <td class="text-center">
                                        <a href="<?=base_url('cursos/edit/'.$curso['id'])?>" class="btn btn-small btn-default" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                        <button class="btn btn-small btn-default change-status" data-id="<?=$curso['id']?>" data-status="<?=$curso['status']?>" title="<?=$curso['status'] == 1 ? 'Desativar' : 'Publicar' ?>"><?=$curso['status'] == 1 ? '<i class="far fa-times-circle"></i>' : '<i class="far fa-paper-plane"></i>'?></button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td class="text-center" colspan="5"><strong>Não existem cursos cadastrados</strong></td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>  
        </div>
    </div>
    <script type="text/javascript" src="<?=base_url('js/tinymce/tinymce.min.js')?>"></script>
    <script type="text/javascript">tinymce.init({ selector: 'textarea', language : 'pt_BR' });</script>