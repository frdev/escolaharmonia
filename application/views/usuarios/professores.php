        <div class="row">
            <h2 class="text-center">Professores</h2>
            <hr>
        </div>
        <div class="row user">
            <div class="col-md-12">
                <?= form_open('', 'id="formUser"') ?>
                    <div class="row">
                        <input type="hidden" name="nivel_acesso" value="2">
                        <div class="form-group col-md-3">
                            <?php
                            echo form_label('Nome', 'nome');
                            echo form_input(array(
                                'name'      => 'nome',
                                'id'        => 'nome',
                                'class'     => 'form-control',
                                'maxLength' => '100',
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
                                'maxLength' => '100',
                                'required'  => 'required'
                            ));
                            ?>
                        </div>
                        <div class="form-group col-md-3">
                            <!-- Vazio -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <?= form_label('Categoria', 'categoria_id') ?>
                            <?= form_dropdown('categoria_id', $categorias, '', 'class="selectpicker" id="categoria_id" data-width="100%"') ?>
                        </div>
                        <div class="form-group col-md-3">
                            <?= form_label('Subcategoria', 'subcategoria_id') ?>
                            <?= form_dropdown('subcategoria_id[]', '', '', 'class="selectpicker" id="subcategoria_id" data-width="100%" multiple') ?>
                        </div>
                        <div class="form-group col-md-3">
                            <!-- Vazio -->
                        </div>
                        <div class="form-group col-md-3">
                            <?php
                            echo form_button(array(
                                'type'    => 'submit',
                                'class'   => 'btn btn-md btn-primary btn-new-user',
                                'content' => 'Cadastrar',
                                'style'   => 'margin-top: 14%;'
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
        <div class="row user">
            <h2 class="text-center">Pesquisar</h2>
            <?= form_open('usuarios/professores', 'id="formPesquisa"') ?>
                <div class="form-group col-md-3">
                    <?php
                    $options = array(
                        ''      => 'Selecione...',
                        'nome'  => 'Nome',
                        'email' => 'E-mail'
                    );
                    echo form_label('Tipo de Filtro', 'tipo_filtro');
                    echo form_dropdown('tipo_filtro', $options, '', 'class="form-control"');
                    ?>
                </div>
                <div class="form-group col-md-3">
                    <?php
                    echo form_label('Filtro', 'filtro');
                    echo form_input(array(
                        'name'      => 'filtro',
                        'id'        => 'filtro',
                        'class'     => 'form-control',
                        'maxLength' => '100',
                        'required'  => 'required'
                    ));
                    ?>
                </div>
                <div class="form-group col-md-3">
                    <?php
                    echo form_button(array(
                        'type'    => 'submit',
                        'class'   => 'btn btn-md btn-primary btn-buscar',
                        'content' => 'Buscar'
                    ));
                    ?>
                </div>
            <?= form_close() ?>
        </div>
        <table class="table table-bordered table-usuarios">
            <thead>
                <tr>
                    <th class="text-center">Nome</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario) : ?>
                    <tr>
                        <td class="text-center"><?=$usuario['nome']?></td>
                        <td class="text-center"><?=$usuario['email']?></td>
                        <td class="text-center"><?=$usuario['status'] == 1? 'Ativo' : 'Inativo'?></td>
                        <td class="text-center">
                            <a href="<?=base_url('usuarios/edit/'.$usuario["id"])?>" class="btn btn-small btn-default" title="Editar"><i class="fas fa-pencil-alt"></i></a>
                            <button class="btn btn-small btn-default change-status" data-id="<?=$usuario['id']?>" data-status="<?=$usuario['status']?>" title="<?=$usuario['status'] == 1 ? 'Desativar' : 'Ativar' ?>"><?=$usuario['status'] == 1 ? '<i class="far fa-times-circle"></i>' : '<i class="far fa-check-circle"></i>'?></button>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="row text-center">
            <?php if (isset($links)) { ?>
                <?php echo $links ?>
            <?php } ?>
        </div>
        <script src="<?=base_url('js/usuario.js')?>"></script>