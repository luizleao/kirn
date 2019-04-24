<?php
class BgdPontoTracadoTrajeto {
	
	public $id;
	public $latitude;
	public $longitude;
	public $posicao;
	public $tipo;
	public $oBgdLinha;
	
	function __construct($id = NULL, $latitude = NULL, $longitude = NULL, $posicao = NULL, $tipo = NULL, BgdLinha $oBgdLinha = NULL){
		$this->id = $id;
		$this->latitude = $latitude;
		$this->longitude = $longitude;
		$this->posicao = $posicao;
		$this->tipo = $tipo;
		$this->oBgdLinha = ($oBgdLinha == NULL) ? new BgdLinha() : $oBgdLinha;
	}

	function __toString(){
		return $this->id;
	}
}