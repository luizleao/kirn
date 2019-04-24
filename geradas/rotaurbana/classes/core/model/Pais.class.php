<?php
class Pais {
	
	public $id;
	public $nome;
	public $sigla;
	
	function __construct($id = NULL, $nome = NULL, $sigla = NULL){
		$this->id = $id;
		$this->nome = $nome;
		$this->sigla = $sigla;
	}

	function __toString(){
		return $this->nome;
	}
}