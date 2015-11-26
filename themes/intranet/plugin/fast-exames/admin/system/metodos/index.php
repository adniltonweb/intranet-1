<?php
$FeMetodo = new FeMetodo();
$FeMetodo->Execute()->findAll();
if (!$FeMetodo->Execute()->getResult()):
    WSErro("Nenhum metodo cadastrado!", WS_INFOR);
else:
    ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Descrição</th>
                <th>Status</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($FeMetodo->Execute()->getResult() as $metodo):
                extract((array) $metodo);
                ?>    
                <tr>
                    <td><?= $met_descricao; ?></td>
                    <td><?= ($met_status ? "Ativo" : "Desativado"); ?></td>
                    <td><?= 'editar/desativar' ?></td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
<?php endif; ?>