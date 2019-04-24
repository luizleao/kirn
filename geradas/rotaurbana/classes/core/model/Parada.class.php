<?php
class Parada {
	
	public $id;
	public $latitude;
	public $longitude;
	public $status;
	public $comments;
	public $title;
	public $tipoDeRotaDaParada;
	
	function __construct($id = NULL, $latitude = NULL, $longitude = NULL, $status = NULL, $comments = NULL, $title = NULL, $tipoDeRotaDaParada = NULL){
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->status = $status;
		$this->comments = $comments;
		$this->title = $title;
		$this->tipoDeRotaDaParada = $tipoDeRotaDaParada;
	}

	function __toString(){
		return $this->id;
	}
}