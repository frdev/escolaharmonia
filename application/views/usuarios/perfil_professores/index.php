        <script type="text/javascript" src="<?=base_url('js/tinymce/tinymce.min.js')?>"></script>
        <script type="text/javascript">tinymce.init({ selector: 'textarea', language : 'pt_BR' });</script>
        <div class="row">
            <h2 class="text-center">Biografia de <?=$professor['nome']?></h2>
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12"><?=$professor['biografia']?></div>
                </div>
            </div>
        </div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Formações</h3>
                <ul class="perfil">
                    <?php foreach($formacoes as $formacao) : ?>
                        <li><i class="fas fa-caret-right"></i> <?=$formacao['descricao']?> - <?=date('Y', strtotime($formacao['data_conclusao']))?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <div class="row"> 
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Categoria de Ensino</h3>
                <ul class="perfil">
                    <li><i class="fas fa-caret-right"></i> <?=$categoria['descricao']?></li>
                </ul>
            </div>
        </div>
        <div class="row"> 
            <hr>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Professor de</h3>
                <ul class="perfil">
                    <?php foreach($subcategorias as $subcategoria) : ?>
                        <li><i class="fas fa-caret-right"></i> <?=$subcategoria['descricao']?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
        <script src="<?=base_url('js/perfil_professores.js')?>"></script>