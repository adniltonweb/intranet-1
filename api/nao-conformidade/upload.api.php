<?php

include '../../_app/Config.inc.php';

//Adiciona arquivo a pasta temporaria
if (!empty($_FILES['files'])):
    $gbFiles = Check::ListFiles($_FILES['files']);

    $Upload = new Upload();

    $RESP = array();

    $i = 0;
    foreach ($gbFiles as $File) :
        $imgName = 'temp' . substr(md5(time() + $i), 0, 5);
        $Upload->File($File, $imgName, 'temp', 50);

        if ($Upload->getError() && stripos($Upload->getError(), 'image')):
            $Upload->Image($File, $imgName, null, 'temp');
        endif;
        
        $File['tmp_name'] = BASEDIR . '/uploads/' . $Upload->getResult();
        $RESP[$i]['RESULT'] = HOME . '/uploads/' . $Upload->getResult();
        $RESP[$i]['TYNY'] = HOME . "/tim.php?src=" . $RESP[$i]['RESULT'] . "&w=202&h=105";
        $RESP[$i]['URL'] = $Upload->getResult();
        $RESP[$i]['ERROS'] = $Upload->getError();
        $RESP[$i]['FILE'] = $File;
        $i++;
    endforeach;

    echo json_encode($RESP);
endif;
