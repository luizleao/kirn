<?php
class NaturezaContratual {
	
	public $idNaturezaContratual;
	public $descricao;
	public $status;
	
	function __construct($idNaturezaContratual = NULL, $descricao = NULL, $status = NULL){
		$this->idNaturezaContratual = $idNaturezaContratual;
		$this->descricao = $descricao;
		$this->status = $status;
	}

	function __toString(){
		return $this->descricao;
	}
}