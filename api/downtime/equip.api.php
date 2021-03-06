<?php

include "../../_app/Config.inc.php";
$Read = new DtEquipamentos();

$request = json_decode(file_get_contents("php://input"));
$Session = new Session;

if (!empty($request)):

    $userlogin = $_SESSION['userlogin'];

    if (!empty($request) && is_array($request)):
        //excluir
        foreach ($request as $data):
            $Read->setEquip_id($data->equip_id);
            $Read->Execute()->delete();
        endforeach;
        echo "excluido com sucesso!";

    elseif (!empty($request->equip_id)):
        $request->equip_lastupdate = date("Y-m-d H:i:s");
        $status = ($request->equip_status ? '1' : '0');

        //editar
        $Read->setThis($request);
        $Read->Execute()->update(NULL, "equip_id");
        if ($Read->Execute()->update("equip_id={$request->equip_id}&equip_status={$status}", "equip_id")):
            echo "Status Atualizado | ";
        endif;
        echo "Editado com sucesso!";
    else:
        //adicionar
        $request->equip_author = $userlogin['user_id'];
        $request->equip_date = date("Y-m-d H:i:s");
        $Read->setThis($request);
        $Read->Execute()->insert();
        echo "Adicionado com sucesso!";
    endif;
else:
    $Read->Execute()->FullRead("SELECT e.*, s.setor_content FROM dt_equipamentos e JOIN ws_setor s ON(s.setor_id = e.setor_id)");
    echo json_encode($Read->Execute()->getResult());
endif;
