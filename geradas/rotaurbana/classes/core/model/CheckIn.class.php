<?php
class CheckIn {
	
	public $id;
	public $posicaoAtual;
	public $oLinha;
	public $latitude;
	public $longitude;
	
	function __construct($id = NULL, $posicaoAtual = NULL, Linha $oLinha = NULL, $latitude = NULL, $longitude = NULL){
		$this->id = $id;
		$this->posicaoAtual = $posicaoAtual;
		$this->oLinha = ($oLinha == NULL) ? new Linha() : $oLinha;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
	}

	function __toString(){
		return $this->id;
	}
}