<?php
class Trechocomentario {
	
	public $id;
	public $comentario;
	public $oLinha;
	
	function __construct($id = NULL, $comentario = NULL, Linha $oLinha = NULL){
		$this->id = $id;
		$this->comentario = $comentario;
		$this->oLinha = ($oLinha == NULL) ? new Linha() : $oLinha;
	}

	function __toString(){
		return $this->id;
	}
}