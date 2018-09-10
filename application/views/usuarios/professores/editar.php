<?php
$acesso = $this->session->userdata('logged');
?> 
    <div data-controller="professores">
        <div class="row">
            <h2 class="text-center">Biografia</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><small>* Escrever um resumo sobre suas qualidades, conquistas e história de vida relacionado a carreira.</small></p>
                <div class="row">
                    <?= form_open('', 'id="formBiografia"') ?>
                    <input type="hidden" name="usuario_id" value="<?=$acesso['id']?>">
                        <div class="form-group col-md-12">
                            <textarea name='biografia' id='biografia'><?=$biografia['biografia']?></textarea>
                        </div>
                        <div class="col-md-12">
                            <?php
                            echo form_button(array(
                                'type'    => 'submit',
                                'class'   => 'btn btn-md btn-primary pull-right btn-biografia',
                                'content' => 'Cadastrar'
                            ));
                            ?>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Formações</h3>
                <p><small>* Cadastrar da seguinte forma: CURSO - INSTITUIÇÃO DE ENSINO</small></p>
                <div class="row">
                    <?= form_open('', 'id="formNewFormacao"') ?>
                        <input type="hidden" name="usuario_id" value="<?=$acesso['id']?>">
                        <div class="form-group col-md-6">
                            <?php
                            echo form_label('Descrição', 'descricao');
                            echo form_input(array(
                                'name'      => 'descricao',
                                'id'        => 'descricao',
                                'class'     => 'form-control',
                                'maxLength' => '100',
                                'required'  => 'required'
                            ));
                            ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?php
                            echo form_label('Ano Conclusão', 'conclusao');
                            echo form_input(array(
                                'name'      => 'conclusao',
                                'id'        => 'conclusao',
                                'class'     => 'form-control',
                                'maxLength' => '100',
                                'required'  => 'required',
                                'type'      => 'date'
                            ));
                            ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?php
                            echo form_button(array(
                                'type'    => 'submit',
                                'class'   => 'btn btn-md btn-primary btn-new-formacao',
                                'content' => 'Cadastrar'
                            ));
                            ?>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Formações Cadastradas</h3>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered table-formacoes">
                    <thead>
                        <tr>
                            <th class="text-center">Descrição</th>
                            <th class="text-center">Conclusão</th>
                            <th class="text-center">Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($formacoes)) : ?>
                            <?php foreach($formacoes as $formacao) : ?>
                                <tr>
                                    <td class="text-center"><?=$formacao['descricao']?></td>
                                    <td class="text-center"><?=date('Y', strtotime($formacao['data_conclusao']))?></td>
                                    <td class="text-center"><button type="button" class="btn btn-md btn-default btn-trash" title="Excluir" data-id="<?=$formacao['id']?>"><i class="fas fa-trash"></i></button></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td col-span='3'><strong>Não há formações cadastradas.</strong></td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
            <hr>
        </div>
    </div>
    <script type="text/javascript" src="<?=base_url('js/tinymce/tinymce.min.js')?>"></script>
    <script type="text/javascript">tinymce.init({ selector: 'textarea', language : 'pt_BR' });</script>