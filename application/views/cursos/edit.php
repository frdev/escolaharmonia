    <div data-controller="cursos">
        <div class="row">
            <h2 class="text-center">Curso - <?=$curso['titulo']?></h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Editar Curso</h3>
                <form id="formCurso">
                    <input type="hidden" name="id" value="<?=$curso['id']?>">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="subcategoria_id">Subcategoria</label>
                            <select name="subcategoria_id" id="subcategoria_id" class="selectpicker" data-width="100%" required>
                                <option value=''>Selecione...</option>
                                <?php foreach($subcategorias as $subcategoria) : ?>
                                    <option value='<?=$subcategoria["subcategoria_id"]?>' <?=$subcategoria['subcategoria_id'] == $curso['subcategoria_id'] ? 'selected' : '' ?>><?=$subcategoria['descricao']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="nivel">Nível</label>
                            <?= form_label('Nível', 'nivel') ?>
                            <select name="nivel" id="nivel" class="selectpicker" data-width="100%" required>
                                <option value=''>Selecione...</option>
                                <?php foreach($niveis as $key => $nivel) : ?>
                                    <option value='<?=$key?>' <?=$key == $curso['nivel'] ? 'selected' : '' ?>><?=$nivel?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="titulo">Título</label>
                            <input type="text" name="titulo" id="titulo" class="form-control" maxlength="150" required value="<?=$curso['titulo']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <small>* Descrição do curso que será apresentado, tal como ementa e plano de ensino.</small>
                            <textarea name='descricao_curso' id='descricao_curso'><?=$curso['descricao']?></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-md btn-primary pull-right">Atualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12"> 
                <h3>Vídeos</h3>
                <table class="table table-bordered table-videos">
                    <thead>
                        <tr>
                            <th class="text-center">Título</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($videos)) : ?>
                            <?php foreach($videos as $video) : ?>
                                <tr>
                                    <td class="text-center"><?=$video['titulo']?></td>
                                    <td class="text-center">
                                        <a href="<?=base_url('cursos/video_edit/'.$video['id'])?>" class="btn btn-small btn-default" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                                        <button class="btn btn-small btn-default trash" data-id="<?=$video['id']?>" title="Excluir"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td class="text-center" colspan="5"><strong>Não existem vídeos cadastrados para este curso</strong></td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>  
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Adicionar Vídeo Aula</h3>
                <form id="formVideo" action="" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="curso_id" value="<?=$curso['id']?>">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="titulo_video">Título</label>
                            <input type="text" name="titulo_video" id="titulo_video" class="form-control" maxlength="150" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="video">Vídeo</label>
                            <input type="url" name="video" id="video" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <small>* Descrição do conteúdo da vídeo aula que será apresentado.</small>
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name='descricao' id='descricao' novalidate></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-md btn-primary pull-right">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Alunos</h3>
                <table class="table table-bordered table-videos">
                    <thead>
                        <tr>
                            <th class="text-center">Nome</th>
                            <th class="text-center">E-mail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($matriculas)) : ?>
                            <?php foreach($matriculas as $matricula) : ?>
                                <tr>
                                    <td class="text-center"><?=$matricula['nome']?></td>
                                    <td class="text-center"><?=$matricula['email']?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td class="text-center" colspan="5"><strong>Não existem matriculas para este curso.</strong></td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="<?=base_url('js/tinymce/tinymce.min.js')?>"></script>
    <script type="text/javascript">tinymce.init({ selector: 'textarea', language : 'pt_BR' });</script>