<?php
class ESTADO {
	
	public $id;
	public $nome;
	public $oPAIS;
	public $uf;
	
	function __construct($id = NULL, $nome = NULL, PAIS $oPAIS = NULL, $uf = NULL){
		$this->id = $id;
		$this->nome = $nome;
		$this->oPAIS = ($oPAIS == NULL) ? new PAIS() : $oPAIS;
		$this->uf = $uf;
	}

	function __toString(){
		return $this->nome;
	}
}