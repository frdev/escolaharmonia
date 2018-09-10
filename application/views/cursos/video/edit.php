    <div data-controller="cursos">
        <div class="row">
            <h2 class="text-center">Curso - <?=$video['curso_titulo']?></h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Editar Aula - <?=$video['titulo']?></h3>
                <form id="formUpdateVideo" name="formVideo" action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?=$video['id']?>">
                    <input type="hidden" name="curso_id" value="<?=$video['curso_id']?>">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <?= form_label('Título', 'titulo') ?>
                            <input type="text" name="titulo_video" id="titulo_video" class="form-control" maxlength="150" value="<?=$video['titulo']?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <?= form_label('Vídeo', 'video') ?>
                            <input type="url" name="video" id="video" value="<?=$video['video']?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small>* Descrição do conteúdo da vídeo aula que será apresentado.</small>
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name='descricao' id='descricao' novalidate><?=$video['descricao']?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <?php
                            echo form_button(array(
                                'type'    => 'submit',
                                'class'   => 'btn btn-md btn-primary pull-right',
                                'content' => 'Atualizar'
                            ));
                            ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="text-center"><iframe width="560" height="315" src="<?=$video['video']?>?version=3&rel=0&modestbranding=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
    <script type="text/javascript" src="<?=base_url('js/tinymce/tinymce.min.js')?>"></script>
    <script type="text/javascript">tinymce.init({ selector: 'textarea', language : 'pt_BR' });</script>