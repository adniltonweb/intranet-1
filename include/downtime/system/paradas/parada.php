
<table class="table">

    <thead>
        <tr>
            <th>Equipamento</th>
            <th>Ultima Alteração</th>
            <th>Responsavel</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr ng-repeat="equip in equipamentos">
            <td>{{equip.equip_title| name}}</td>
            <td>{{equip.equip_lastupdate| timestampBr}}</td>
            <td>{{equip.equip_author| name}}</td>
            <td ng-if="equip.stoped">Em manutenção</td>
            <td ng-if="!equip.stoped">Em atividade</td>
            <td ng-if="equip.stoped"><button ng-disabled="!equip.author" class="btn btn-success" title="start"><span class="glyphicon glyphicon-ok" ng-click="update(equip)"></span></button></td>
            <td ng-if="!equip.stoped"><button ng-disabled="!equip.author" class="btn btn-danger" title="stop"><span class="glyphicon glyphicon-off" ng-click="update(equip)"></span></button></td>
            <td><input class="form-control" type="text" placeholder="Digite seu nome" ng-model="equip.author" ng-required="true" ng-minlength="3"/></td>
        </tr>
    </tbody>
    
</table>
