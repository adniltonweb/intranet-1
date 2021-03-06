<?php
if (!PRODUCAO):
    $dir = HOME . "/include/downtime/";
    Register::addRegister("<script src=\"{$dir}js/downtime.app.js\"></script>");
    Register::addRegister("<script src=\"{$dir}js/controller/user.ctrl.js\"></script>");
    Register::addRegister("<script src=\"{$dir}js/controller/equipamentos.ctrl.js\"></script>");
    Register::addRegister("<script src=\"{$dir}js/controller/dev/parada.ctrl.js\"></script>");
    Register::addRegister("<script src='" . HOME . "/js/angular/filter/timestampBr.filter.js'></script>");
    Register::addRegister("<script src='" . HOME . "/js/google-charts/columns.charts.js'></script>");
    Register::addRegister("<script src='" . HOME . "/js/google-charts/donut.charts.js'></script>");
endif;
?>

<header id="navtab">
    <nav>
        <h1><a href="#dashboard" title="Dashboard" data-toggle="tab" onclick="alterClass('#dashboard')">Dashboard</a></h1>

        <!--Query String-->
        <ul class="menu">

            <?php if (Check::UserLogin(2)): ?>
                <li id="equipamento" class="li"><a class="opensub" onclick="return false;" href="">Equipamento</a>
                    <ul class="sub">
                        <li><a href="#equip_create" onclick="alterClass('#equipamento')" data-toggle="tab">Criar Equipamento</a></li>
                        <li><a href="#equip_list" onclick="alterClass('#equipamento')" data-toggle="tab">Listar / Editar Equipamentos</a></li>
                    </ul>
                </li>
            <?php endif; ?>

            <li id="parada" class="li"><a class="opensub" onclick="return false;" href="">Parada</a>
                <ul class="sub">
                    <li><a href="#down_create" onclick="alterClass('#parada')" data-toggle="tab">Registrar Parada</a></li>
                </ul>
            </li>

            <!--<li class="li"><a href="../" target="_blank" class="opensub">Ver Site</a></li>-->
        </ul>
    </nav>
</header>

<div class="tab-content" ng-app="downtime">

    <div class="tab-pane active" id="dashboard"><?php require '/report/index.php'; ?></div>
    <!--Equipamento-->
    <div class="tab-content" ng-controller="equipamentos">
        <div class="tab-pane" id="equip_create"><?php require '/system/equipamentos/equipamento.php'; ?></div>
        <div class="tab-pane" id="equip_list"><?php require '/system/equipamentos/index.php'; ?></div>
    </div>

    <!--downtime-->
    <div class="tab-content" ng-controller="parada">
        <div class="tab-pane" id="down_create"><?php require '/system/paradas/parada.php'; ?></div>
    </div>
</div>