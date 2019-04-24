<?php
class Ponto {
	
	public $id;
	public $latitude;
	public $longitude;
	public $linha_id;
	public $codigoAndroid;
	
	function __construct($id = NULL, $latitude = NULL, $longitude = NULL, $linha_id = NULL, $codigoAndroid = NULL){
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->linha_id = $linha_id;
		$this->codigoAndroid = $codigoAndroid;
	}

	function __toString(){
		return $this->id;
	}
}