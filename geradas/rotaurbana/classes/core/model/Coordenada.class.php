<?php
class Coordenada {
	
	public $id;
	public $latitude;
	public $longitude;
	public $oTrechocomentario;
	
	function __construct($id = NULL, $latitude = NULL, $longitude = NULL, Trechocomentario $oTrechocomentario = NULL){
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->oTrechocomentario = ($oTrechocomentario == NULL) ? new Trechocomentario() : $oTrechocomentario;
	}

	function __toString(){
		return $this->id;
	}
}