<?php
class Usuario {
	
	public $id;
	public $nome;
	public $status;
	public $oContato;
	
	function __construct($id = NULL, $nome = NULL, $status = NULL, Contato $oContato = NULL){
		$this->id = $id;
		$this->nome = $nome;
		$this->status = $status;
		$this->oContato = ($oContato == NULL) ? new Contato() : $oContato;
	}

	function __toString(){
		return $this->nome;
	}
}