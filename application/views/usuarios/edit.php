<?php
    $tipo_usuario = '';
    switch($usuario['nivel_id']){
        case 1:
            $tipo_usuario = 'Customer';
            break;
        case 2:
            $tipo_usuario = 'Professor';
            break;
        case 3:
            $tipo_usuario = 'Aluno';
            break;
    }
?>
        <div class="row">
            <h2 class="text-center">Editar <?=$tipo_usuario?> - <?=$usuario['nome']?></h2>
            <hr>
        </div>
        <div class="row user">
            <div class="col-md-12">
                <?= form_open('', 'id="formUser"') ?>
                    <div class="row">
                        <input type="hidden" name="nivel_acesso" value="<?=$usuario['nivel_id']?>">
                        <input type="hidden" name="id" value="<?=$usuario['id']?>">
                        <div class="form-group col-md-3">
                            <?php
                            echo form_label('Nome', 'nome');
                            echo form_input(array(
                                'name'      => 'nome',
                                'id'        => 'nome',
                                'class'     => 'form-control',
                                'maxLength' => '100',
                                'value'     => $usuario['nome'],
                                'required'  => 'required'
                            ));
                            ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?php
                            echo form_label('Email', 'email');
                            echo form_input(array(
                                'name'      => 'email',
                                'id'        => 'email',
                                'class'     => 'form-control',
                                'maxLength' => '100',
                                'type'      => 'email',
                                'value'     => $usuario['email'],
                                'required'  => 'required'
                            ));
                            ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?php
                            echo form_label('Senha', 'senha');
                            echo form_password(array(
                                'name'      => 'senha',
                                'id'        => 'senha',
                                'class'     => 'form-control',
                                'maxLength' => '100'
                            ));
                            ?>
                        </div>
                        <div class="form-group col-md-3">
                            <!-- Vazio -->
                            <?php
                            if($usuario['nivel_id'] != 2){
                                echo form_button(array(
                                    'type'    => 'submit',
                                    'class'   => 'btn btn-md btn-primary btn-new-user',
                                    'content' => 'Atualizar',
                                    'style'   => 'margin-top: 7%;'
                                ));
                            }
                            ?>
                        </div>
                    </div>
                    <?php if($usuario['nivel_id'] == 2) : ?>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <?= form_label('Categoria', 'categoria_id') ?>
                            <select class="selectpicker" id="categoria_id" name="categoria_id" data-width="100%" required>
                                <option value="">Selecione...</option>
                                <?php
                                foreach($categorias as $categoria){
                                ?>
                                    <option value="<?=$categoria['id']?>" <?=$categoria['id'] == $usuario['categoria']['categoria_id'] ? 'selected' : '' ?>><?=$categoria['descricao']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <?= form_label('Subcategoria', 'subcategoria_id') ?>
                            <select class="selectpicker" id="subcategoria_id" name="subcategoria_id[]" data-width="100%" multiple>
                                <?php
                                foreach($subcategorias as $subcategoria){
                                    $selected = '';
                                    foreach($usuario['subcategorias'] as $sub_user){
                                        if($sub_user == $subcategoria['id']){
                                            $selected = 'selected';
                                            break;
                                        }
                                ?>
                                <?php
                                    }
                                ?>
                                    <option value="<?=$subcategoria['id']?>" <?=$selected?>><?=$subcategoria['descricao']?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <!-- Vazio -->
                        </div>
                        <div class="form-group col-md-3">
                            <?php
                            echo form_button(array(
                                'type'    => 'submit',
                                'class'   => 'btn btn-md btn-primary btn-new-user',
                                'content' => 'Atualizar',
                                'style'   => 'margin-top: 14%;'
                            ));
                            ?>
                        </div>
                    </div>
                    <?php endif ?>
                <?= form_close() ?>
            </div>
        </div>
        <script src="<?=base_url('js/usuario.js')?>"></script>