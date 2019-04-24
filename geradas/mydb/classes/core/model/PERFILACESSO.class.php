<?php
class PERFILACESSO {
	
	public $id;
	public $nome;
	public $se_semana;
	
	function __construct($id = NULL, $nome = NULL, $se_semana = NULL){
		$this->id = $id;
		$this->nome = $nome;
		$this->se_semana = $se_semana;
	}

	function __toString(){
		return $this->nome;
	}
}