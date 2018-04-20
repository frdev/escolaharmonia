        <div class="row">
            <h2 class="text-center">Categorias</h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Cadastrar Categoria</h3>
                <div class="row">
                    <?= form_open('', 'id="formNewCategory"') ?>
                        <div class="form-group col-md-3">
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
                        <div class="form-group col-md-9">
                            <?php
                            echo form_button(array(
                                'type'    => 'submit',
                                'class'   => 'btn btn-md btn-primary',
                                'content' => 'Cadastrar',
                                'style'   => 'margin-top: 2.1%;'
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
                <h3>Cadastrar Subcategoria</h3>
                <div class="row">
                    <?= form_open('', 'id="formNewSubCategory"') ?>
                        <div class="form-group col-md-3">
                            <?php
                            echo form_label('Categoria', 'categoria');
                            echo form_dropdown('categoria', $categorias, '', 'id="categoria" class="form-control"');
                            ?>
                        </div>
                        <div id="form-subcategoria" style="display: none;">
                            <div class="form-group col-md-3">
                                <label for="subcategoria">Subcategoria</label>
                                <input type="text" name="subcategoria" class="form-control" id="subcategoria">
                            </div>
                            <div class="form-group col-md-6">
                                <button type="submit" class="btn btn-md btn-primary" style="margin-top: 3%;">Cadastrar</button>
                            </div>
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
        

        <script src="<?=base_url('js/categorias.js')?>"></script>