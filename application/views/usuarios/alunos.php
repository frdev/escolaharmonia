    <div data-controller="usuarios">    
        <div class="row">
            <h2 class="text-center">Alunos</h2>
            <hr>
        </div>
        <div class="row user">
            <?= form_open('', 'id="formUser"') ?>
                <input type="hidden" name="nivel_acesso" value="3">
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
                    <?php
                    echo form_button(array(
                        'type'    => 'submit',
                        'class'   => 'btn btn-md btn-primary btn-new-user',
                        'content' => 'Cadastrar'
                    ));
                    ?>
                </div>
            <?= form_close() ?>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row user">
            <h2 class="text-center">Pesquisar</h2>
            <?= form_open('usuarios/alunos', 'id="formPesquisa"') ?>
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
                        'type'      => 'email',
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
    </div>