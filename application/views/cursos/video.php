<?php
    $nivel_curso = 'Básico';
    if($curso['nivel'] == 1){
        $nivel_curso = 'Intermediário';
    } else if ($curso['nivel'] == 2){
        $nivel_curso = 'Avançado';
    }
?>
        <div class="row">
            <h2 class="text-center"><?=$curso['titulo']?></h2>
            <hr>
        </div>
        <div class="text-center"><iframe width="560" height="315" src="<?=$video_atual['video']?>?version=3&rel=0&modestbranding=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
        <div class="row">
            <hr>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading head-subcategoria">Descrição - <?=$video_atual['titulo']?></div>
                    <div class="panel-body">
                        <?=$video_atual['descricao']?>
                    </div>
                    <div class="panel-footer">
                        <strong>Nível:</strong> <?=$nivel_curso?><br>
                        <strong>Professor:</strong> <a href="<?=base_url('perfil/professor/'.$curso['id_professor'])?>" target="_blank"><?=$curso['nome']?></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <ul class="list-group">
                    <li class="list-group-item head-subcategoria">Aulas</li>
                    <?php foreach($videos as $video) : ?>
                        <li class="list-group-item"><?=$video_atual['id'] == $video['id'] ? '<i class="fas fa-star"></i>' : '' ?> <?=$video['titulo']?><a class="pull-right" href="<?=base_url('cursos/video/'.$curso['id'].'/'.$video['id'])?>"><?=$video_atual['id'] == $video['id'] ? 'Aula atual' : 'Acessar aula' ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>