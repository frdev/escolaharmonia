<div data-controller="categorias">
    <div class="row">
        <h2 class="text-center">Categorias</h2>
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Cadastrar Categoria</h3>
            <form id="formNewCategory" class="row">
                <div class="form-group col-md-3">
                    <label for="descricao">Descrição</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" required>
                </div>
                <div class="form-group col-md-9">
                    <button type="submit" class="btn btn-md btn-primary" style="margin-top: 3%;">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <hr>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3>Cadastrar Subcategoria</h3>
            <form id="formNewSubCategory" class="row">
                <div class="form-group col-md-3">
                    <label for="categoria">Categoria</label>
                    <select class="form-control" name="categoria" id="categoria">
                        <option value="">Selecione...</option>
                        <?php foreach($categorias as $categoria) : ?>
                            <option value="<?=$categoria['id']?>"><?=$categoria['descricao']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div id="form-subcategoria" style="display: none;">
                    <div class="form-group col-md-3">
                        <label for="subcategoria">Subcategoria</label>
                        <input type="text" name="subcategoria" class="form-control" id="subcategoria">
                    </div>
                    <div class="form-group col-md-6">
                        <button type="submit" class="btn btn-md btn-primary" style="margin-top: 4.5%;">Cadastrar</button>
                    </div>
                </div>
            </form>
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
</div>