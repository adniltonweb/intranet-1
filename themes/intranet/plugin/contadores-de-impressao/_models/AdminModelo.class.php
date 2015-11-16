<?php

/**
 * AdminModelo.class.php [ Models Admin ]
 * Responsavel por gerenciar os modelos de impressoras no sistema no Admin
 *
 * @copyright (c) 2015, Adriano Reis
 */
class AdminModelo {

    private $Read;
    private $Data;
    private $Result;

    public function __construct() {
        $this->Read = new AppModelo();
    }

    public function ExeCreate($Dados) {
        $this->Data = $Dados;
        $this->setDados();
        $this->Read->setThis((object) $this->Data);
        $insert = $this->Read->Execute()->insert();
        $this->Result = $this->Read->Execute()->MaxFild("modelo_id");
        return $insert;
    }
    
    public function ExeDelete(){
        //Esta função não deve ser executada visto que as impressoras não mudas de modelo.
    }
    
    public function ExeStatus($Modelo_id, $Modelo_status){
        return $this->Read->Execute()->update("modelo_id=$Modelo_id&modelo_status=$Modelo_status", "modelo_id");
    }
    
    public function ExeUpdate($Dados) {
        $this->Data = $Dados;
        $this->setDados();
        $this->Read->setThis((object) $this->Data);
        return $this->Read->Execute()->update(null, "modelo_id");
    }

    public function setDados() {
        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);
    }

    public function FindId($Id) {
        $this->Read->setModelo_id($Id);
        $this->Read->Execute()->Query("#modelo_id#");
        return (!empty($this->Read->Execute()->getResult()[0]) ? $this->Read->Execute()->getResult()[0] : null);
    }

    public function FindNome($Nome) {
        $this->Read->setModelo_descricao($Nome);
        $this->Read->Execute()->Query("#modelo_descricao#");
        return (!empty($this->Read->Execute()->getResult()[0]) ? $this->Read->Execute()->getResult()[0] : null);
    }

    public function getResult() {
        return $this->Result;
    }

}