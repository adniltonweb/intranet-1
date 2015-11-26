<?php
if (file_exists(FAST_PATH . "_models/AdminMetodo.class.php")):
    require_once FAST_PATH . "_models/AdminMetodo.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$AdminMetodo = new AdminMetodo();

if (!empty($Dados) && !is_array("", $Dados)):
    $AdminMetodo->ExeCreate($Dados);
endif;
?>
<h1 class="text-center">Metodos</h1>
<form method="post" class="form">

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Descrição:</label>
            <input required="true" class="form-control" title="Descrição" type="text" name="met_descricao" placeholder="Descrição" value="<?= $Dados['met_descricao']; ?>">
        </div>

    </div>
    <hr>
    <div class="btn-group">
        <input type="submit" class="btn btn-primary btn-block" name="cadastrar "value="Cadastrar"/>
        <input type="submit" class="btn btn-success btn-block" name="cadastrar Ativo"value="Cadastrar Ativo"/>
    </div>
</form>
