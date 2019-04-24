<?php
class BgdUsuario {
	
	public $id;
	public $email;
	public $nome;
	
	function __construct($id = NULL, $email = NULL, $nome = NULL){
		$this->id = $id;
		$this->email = $email;
		$this->nome = $nome;
	}

	function __toString(){
		return $this->email;
	}
}