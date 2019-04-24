<?php
class PESSOA {
	
	public $id;
	public $nome;
	public $cpf;
	public $nascimento;
	public $oPERFILACESSO;
	
	function __construct($id = NULL, $nome = NULL, $cpf = NULL, $nascimento = NULL, PERFILACESSO $oPERFILACESSO = NULL){
		$this->id = $id;
		$this->nome = $nome;
		$this->cpf = $cpf;
		$this->nascimento = $nascimento;
		$this->oPERFILACESSO = ($oPERFILACESSO == NULL) ? new PERFILACESSO() : $oPERFILACESSO;
	}

	function __toString(){
		return $this->nome;
	}
}