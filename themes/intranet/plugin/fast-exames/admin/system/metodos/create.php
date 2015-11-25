<?php
if (file_exists(FAST_PATH . "_models/AdminExames.class.php")):
    require_once FAST_PATH . "_models/AdminExames.class.php";
endif;

$Dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$AdminExames = new AdminExames();
$FeSetor = new FeSetor();

if (!empty($Dados)):
    $Dados['ws_users_soli'] = Check::UserLogin()['user_id'];
    $Dados['ex_data_abertura'] = date('Y-m-d H:i:s');
    $AdminExames->ExeCreate($Dados);
endif;
?>
<h1 class="text-center">Formulario de requisição de exame</h1>
<form method="post" class="form">

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Descrição:</label>
            <input required="true" class="form-control" title="Descrição" type="text" name="ex_descricao" placeholder="Descrição" value="<?= $Dados['ex_descricao']; ?>">
        </div>

        <div class="form-group col-md-12">
            <label>Sinonimia:</label>
            <textarea class="form-control" title="Sinonimia" name="ex_sinonimia" placeholder="Sinonimia"><?= $Dados['ex_sinonimia']; ?></textarea>
        </div>

    </div>

    <div class="row bg-primary">

        <div class="form-group col-md-6">
            <label>Solicitante:</label>
            <select  required="true" title="Setor Solicitante" name="fe_setor_soli" class="form-control">
                <option value="">Selecione um solicitante</option>
                <?php
                $FeSetor->setSet_status(true);
                $FeSetor->setSet_solicita(true);
                $FeSetor->Execute()->Query("#set_status# AND #set_solicita#");
                foreach ($FeSetor->Execute()->getResult() as $setor):
                    extract((array) $setor);
                    $select = ($Dados['fe_setor_soli'] == $set_id ? 'selected=true' : '');
                    echo "<option value=\"{$set_id}\" {$select}>{$set_descricao}</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Setor execução:</label>
            <select required="true" title="Setor Solicitante" name="fe_setor_exec" class="form-control">
                <option value="">Selecione um setor</option>
                <?php
                $FeSetor->setSet_status(true);
                $FeSetor->setSet_solicita(null);
                $FeSetor->setSet_execucao(true);
                $FeSetor->Execute()->Query("#set_status# AND #set_execucao#");
                foreach ($FeSetor->Execute()->getResult() as $setor):
                    extract((array) $setor);
                    $select = ($Dados['fe_setor_exec'] == $set_id ? 'selected=true' : '');
                    echo "<option value=\"{$set_id}\" {$select}>{$set_descricao}</option>";
                endforeach;
                ?>
            </select>
        </div>

    </div>

    <div class="row bg-primary">
        <div class="form-group col-md-4">
            <label>Unidade:</label>
            <input class="form-control" title="Unidade" type="text" name="ex_unidade" placeholder="Unidade" value="<?= $Dados['ex_unidade']; ?>">
        </div>

        <div class="form-group col-md-4">
            <label>Prazo:</label>
            <input required="true" class="form-control" title="Prazo" type="text" name="ex_prazo" placeholder="Prazo" value="<?= $Dados['ex_prazo']; ?>">
        </div>

        <div class="form-group col-md-4">
            <label>Valor:</label>
            <input required="true" class="form-control" title="Valor" type="text" name="ex_valor" placeholder="Valor" value="<?= $Dados['ex_valor']; ?>">
        </div>
    </div>

    <div class="row bg-primary">
        <div class="form-group col-md-6">
            <label>Método:</label>
            <select  required="true" title="Método" name="fe_metodo" class="form-control">
                <option value="">Selecione um método</option>
                <?php
                $FeMetodo = new FeMetodo();
                $FeMetodo->setMet_status(true);
                $FeMetodo->Execute()->Query("#met_status#");
                foreach ($FeMetodo->Execute()->getResult() as $metodo):
                    extract((array) $metodo);
                    $select = ($Dados['fe_metodo'] == $met_id ? 'selected=true' : '');
                    echo "<option value=\"{$met_id}\" {$select}>{$met_descricao}</option>";
                endforeach;
                ?>
            </select>
        </div>

        <div class="form-group col-md-6">
            <label>Material:</label>
            <select  required="true" title="Material" name="fe_material" class="form-control">
                <option value="">Selecione um material</option>
                <?php
                $FeMaterial = new FeMaterial();
                $FeMaterial->setMat_status(true);
                $FeMaterial->Execute()->Query("#mat_status#");
                foreach ($FeMaterial->Execute()->getResult() as $material):
                    extract((array) $material);
                    $select = ($Dados['fe_material'] == $mat_id ? 'selected=true' : '');
                    echo "<option value=\"{$mat_id}\" {$select}>{$mat_descricao}</option>";
                endforeach;
                ?>
            </select>
        </div>
    </div>

    <div class="row bg-primary">

        <div class="form-group col-md-12">
            <label>Vr:</label>
            <textarea required="true" class="form-control" title="Valor de Referencia" name="ex_valor_referencia" placeholder="Valor de Referencia"><?= $Dados['ex_valor_referencia']; ?></textarea>
        </div>

    </div>

    <div class="row bg-primary">
        <div class="form-group col-md-6">
            <label>Informação Paciente:</label>
            <textarea class="form-control" title="Info Paciente" name="ex_info_paciente" placeholder="Info Paciente"><?= $Dados['ex_info_paciente']; ?></textarea>
        </div>

        <div class="form-group col-md-6">
            <label>Informação Coleta:</label>
            <textarea class="form-control" title="Info Coleta" name="ex_info_coleta" placeholder="Info Coleta"><?= $Dados['ex_info_coleta']; ?></textarea>
        </div>

        <div class="form-group col-md-6">
            <label>Informação Encaminhamento:</label>
            <textarea class="form-control" title="Info Encaminhamento" name="ex_info_encaminhamento" placeholder="Info Encaminhamento"><?= $Dados['ex_info_encaminhamento']; ?></textarea>
        </div>

        <div class="form-group col-md-6">
            <label>Informação Interferentes:</label>
            <textarea class="form-control" title="Info Interferentes" name="ex_info_interferentes" placeholder="Info Interferentes"><?= $Dados['ex_info_interferentes']; ?></textarea>
        </div>
    </div>

    <hr>
    <input type="submit" class="btn btn-success" value="Registrar"/>
</form>