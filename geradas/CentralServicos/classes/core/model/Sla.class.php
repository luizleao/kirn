<?php
class Sla {
	
	public $idSla;
	public $descricao;
	public $status;
	
	function __construct($idSla = NULL, $descricao = NULL, $status = NULL){
		$this->idSla = $idSla;
		$this->descricao = $descricao;
		$this->status = $status;
	}

	function __toString(){
		return $this->descricao;
	}
}