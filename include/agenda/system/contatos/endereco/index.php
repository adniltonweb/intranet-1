<!--endereço-->
<div class="panel panel-default">

    {{message}}
    <hr>
    <div class="row">

        <?php include HOME . '/include/agenda/system/contatos/inc/novoContato.php'; ?>

        <?php include HOME . '/include/agenda/system/contatos/inc/novoEndereco.php'; ?>

        <label>Lista de Endereços dos sistema:</label>

        <div class="col-md-4">
            <input class="form-control" type="text" name="criterioDeBusca" ng-model="criterioDeBusca" placeholder="Criterio de Busca"/> 
            <table class="table" ng-if="enderecos.length > 0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th colspan="2"><a href="" ng-click="ordernarPor('endereco.endereco_lagradouro')">Lagradouro</a></th>
                        <th><a href="" ng-click="ordernarPor('endereco.endereco_bairro')">Bairro</a></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="endereco in enderecos| filter:criterioDeBusca | orderBy:criterioDeOrdenacao:direcaoDaOrdenacao">
                        <td><input class="form-control" type="checkbox" ng-model="endereco.selecionado"></td>
                        <td><a href="" ng-click="isEnderecoEdited(endereco)">{{endereco.endereco_lagradouro}}</a></td>
                        <td>{{endereco.endereco_numero}}</td>
                        <td>{{endereco.endereco_bairro}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="row" ng-if="enderecos.length <= 0">
                <?php WSErro("Nenhum endereço foi encontrado!", WS_INFOR); ?>
            </div>
        </div>

    </div>
</div>