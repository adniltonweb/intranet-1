<?php
ob_start();

$Login = new Login(2);
$getexe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
Check::UserOnline();

if (!$Login->CheckLogin()):
    unset($_SESSION['userlogin']);
    header('Location: ' . HOME . '/admin/index.php?exe=restrito');
else:
    $userlogin = $_SESSION['userlogin'];
endif;
?>

<header id="navtab">
    <nav>
        <h1><a href="<?= FAST_INCLUDE ?>admin" title="Dasboard">Dasboard</a></h1>

        <?php
        //ATIVA MENU
        if (isset($getexe)):
            $linkto = explode('/', $getexe);
        else:
            $linkto = array();
        endif;
        ?>
        <ul>
            <li class="li<?php if (in_array('exames', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Exames</a>
                <ul class="sub">
                    <li><a href="<?= FAST_INCLUDE ?>admin/exames/&exe=exames/create">Criar Exames</a></li>
                    <li><a href="<?= FAST_INCLUDE ?>admin/exames/&exe=exames/index">Listar / Editar Exames</a></li>
                </ul>
            </li>

            <li class="li<?php if (in_array('materiais', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Materiais</a>
                <ul class="sub">
                    <li><a href="<?= FAST_INCLUDE ?>admin/&exe=materiais/create">Criar Materiais</a></li>
                    <li><a href="<?= FAST_INCLUDE ?>admin/&exe=materiais/index">Listar / Editar Materiais</a></li>
                </ul>
            </li>

            <li class="li<?php if (in_array('metodos', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Metodos</a>
                <ul class="sub">
                    <li><a href="<?= FAST_INCLUDE ?>admin/&exe=metodos/create">Criar Metodos</a></li>
                    <li><a href="<?= FAST_INCLUDE ?>admin/&exe=metodos/index">Listar / Editar Metodos</a></li>
                </ul>
            </li>

            <li class="li<?php if (in_array('setores', $linkto)) echo ' active'; ?>"><a class="opensub" onclick="return false;" href="#">Setores</a>
                <ul class="sub">
                    <li><a href="<?= FAST_INCLUDE ?>admin/&exe=setores/create">Criar Setores</a></li>
                    <li><a href="<?= FAST_INCLUDE ?>admin/&exe=setores/index">Listar / Editar Setores</a></li>
                </ul>
            </li>

            <!-- adicionar novas categorias aqui-->

            <li class="li"><a href="<?= FAST_INCLUDE ?>" class="opensub">Ver Site</a></li>
        </ul>
    </nav>
</header>

<div class="panel">
    <?php
    //QUERY STRING
    if (!empty($getexe)):
        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . strip_tags(trim($getexe) . '.php');
    else:
        $includepatch = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . 'home.php';
    endif;

    if (file_exists($includepatch)):
        require_once($includepatch);
    else:
        echo "<div class=\"content notfound\">";
        WSErro("<b>Erro ao incluir tela:</b> Erro ao incluir o controller /{$getexe}.php!", WS_ERROR);
        echo "</div>";
    endif;
    ?>
</div>