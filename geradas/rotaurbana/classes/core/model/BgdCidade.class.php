<?php
class BgdCidade {
	
	public $id;
	public $nome;
	
	function __construct($id = NULL, $nome = NULL){
		$this->id = $id;
		$this->nome = $nome;
	}

	function __toString(){
		return $this->nome;
	}
}