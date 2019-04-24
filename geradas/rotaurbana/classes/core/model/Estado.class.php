<?php
class Estado {
	
	public $id;
	public $nome;
	public $uf;
	public $oPais;
	
	function __construct($id = NULL, $nome = NULL, $uf = NULL, Pais $oPais = NULL){
		$this->id = $id;
		$this->nome = $nome;
		$this->uf = $uf;
		$this->oPais = ($oPais == NULL) ? new Pais() : $oPais;
	}

	function __toString(){
		return $this->nome;
	}
}