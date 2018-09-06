<?php

class Produto {

    const INATIVO = 0;
    const ATIVO = 1;

    public $idproduto;
    public $nomeproduto;
    public $preco;
    private $status;
    public $idcategoria;
    public $saldo;


    public function getStatus(){
        return $this->status;
    }

    public function setStatus($status){
        $this->status = $status;
    }

}