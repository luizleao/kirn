<?php
class Cidade {
	
	public $id;
	public $latitude;
	public $longitude;
	public $nome;
	public $oEstado;
	public $oCidade;
	public $sameAs;
	public $latitudeDouble;
	public $longitudeDouble;
	
	function __construct($id = NULL, $latitude = NULL, $longitude = NULL, $nome = NULL, Estado $oEstado = NULL, Cidade $oCidade = NULL, $sameAs = NULL, $latitudeDouble = NULL, $longitudeDouble = NULL){
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->nome = $nome;
		$this->oEstado = ($oEstado == NULL) ? new Estado() : $oEstado;
		$this->oCidade = ($oCidade == NULL) ? new Cidade() : $oCidade;
		$this->sameAs = $sameAs;
		$this->latitudeDouble = $latitudeDouble;
		$this->longitudeDouble = $longitudeDouble;
	}

	function __toString(){
		return $this->nome;
	}
}