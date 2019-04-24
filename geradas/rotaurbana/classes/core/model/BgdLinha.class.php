<?php
class BgdLinha {
	
	public $id;
	public $codigo;
	public $comentario;
	public $nome;
	
	function __construct($id = NULL, $codigo = NULL, $comentario = NULL, $nome = NULL){
		$this->id = $id;
		$this->codigo = $codigo;
		$this->comentario = $comentario;
		$this->nome = $nome;
	}

	function __toString(){
		return $this->nome;
	}
}