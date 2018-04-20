        <script type="text/javascript" src="<?=base_url('js/tinymce/tinymce.min.js')?>"></script>
        <script type="text/javascript">tinymce.init({ selector: 'textarea', language : 'pt_BR' });</script>
        <div class="row">
            <h2 class="text-center">Biografia</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p><small>* Escrever um resumo sobre suas qualidades, conquistas e história de vida relacionado a carreira.</small></p>
                <div class="row">
                    <?= form_open('', 'id="formBiografia"') ?>
                        <div class="form-group col-md-12">
                            <?php
                             $data = array(
                                    'name'        => 'biografia',
                                    'id'          => 'biografia',
                                    'class'       => 'form-control'
                                );
                            echo form_textarea($data);
                            ?>
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
                                'class'   => 'btn btn-md btn-primary btn-formacoes',
                                'content' => 'Cadastrar',
                                'style'   => 'margin-top: 6.7%;'
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
            <div class="col-md-12 list-subcategorias" style="display: none;">
                <h3 class="nome-categoria"></h3>
                <ul class="list-group">
                    
                </ul>
            </div>
        </div>
        

        <script src="<?=base_url('js/perfil_professores.js')?>"></script>