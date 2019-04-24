<?php
class Pontopesquisa {
	
	public $id;
	public $latitude;
	public $longitude;
	public $posicao;
	public $tipo;
	public $oLinha;
	
	function __construct($id = NULL, $latitude = NULL, $longitude = NULL, $posicao = NULL, $tipo = NULL, Linha $oLinha = NULL){
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->posicao = $posicao;
		$this->tipo = $tipo;
		$this->oLinha = ($oLinha == NULL) ? new Linha() : $oLinha;
	}

	function __toString(){
		return $this->id;
	}
}