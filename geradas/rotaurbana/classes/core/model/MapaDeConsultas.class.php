<?php
class MapaDeConsultas {
	
	public $id;
	public $latDestino;
	public $latOrigem;
	public $lngDestino;
	public $lngOrigem;
	public $dataBusca;
	public $oCidade;
	
	function __construct($id = NULL, $latDestino = NULL, $latOrigem = NULL, $lngDestino = NULL, $lngOrigem = NULL, $dataBusca = NULL, Cidade $oCidade = NULL){
		$this->id = $id;
		$this->latDestino = $latDestino;
		$this->latOrigem = $latOrigem;
		$this->lngDestino = $lngDestino;
		$this->lngOrigem = $lngOrigem;
		$this->dataBusca = $dataBusca;
		$this->oCidade = ($oCidade == NULL) ? new Cidade() : $oCidade;
	}

	function __toString(){
		return $this->id;
	}
}