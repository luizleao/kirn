<?php
class ParadaLinhaBD extends ParadaLinhaBDBase{
    function __construct($conexao = NULL){
        if(!$conexao) 
            $conexao = new Conexao();
        if($conexao->msg != ""){
            $this->msg = $conexao->msg;
        } else {
            parent::__construct($conexao);
        }
    }
	
    
}