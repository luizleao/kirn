<?php
class Pontotracadotrajeto {
	
	public $id;
	public $latitude;
	public $longitude;
	public $posicao;
	public $linha_id;
	public $tipo;
	
	function __construct($id = NULL, $latitude = NULL, $longitude = NULL, $posicao = NULL, $linha_id = NULL, $tipo = NULL){
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->posicao = $posicao;
		$this->linha_id = $linha_id;
		$this->tipo = $tipo;
	}

	function __toString(){
		return $this->id;
	}
}