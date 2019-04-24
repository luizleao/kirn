<?php
class BgdMapaDeConsultas {
	
	public $id;
	public $data_captura;
	public $latDestino;
	public $latOrigem;
	public $lngDestino;
	public $lngOrigem;
	public $oBgdCidade;
	public $oBgdCidade;
	public $lat_proxma_usuario;
	public $lng_proxma_usuario;
	public $fonte;
	
	function __construct($id = NULL, $data_captura = NULL, $latDestino = NULL, $latOrigem = NULL, $lngDestino = NULL, $lngOrigem = NULL, BgdCidade $oBgdCidade = NULL, BgdCidade $oBgdCidade = NULL, $lat_proxma_usuario = NULL, $lng_proxma_usuario = NULL, $fonte = NULL){
		$this->id = $id;
		$this->data_captura = $data_captura;
		$this->latDestino = $latDestino;
		$this->latOrigem = $latOrigem;
		$this->lngDestino = $lngDestino;
		$this->lngOrigem = $lngOrigem;
		$this->oBgdCidade = ($oBgdCidade == NULL) ? new BgdCidade() : $oBgdCidade;
		$this->oBgdCidade = ($oBgdCidade == NULL) ? new BgdCidade() : $oBgdCidade;
		$this->lat_proxma_usuario = $lat_proxma_usuario;
		$this->lng_proxma_usuario = $lng_proxma_usuario;
		$this->fonte = $fonte;
	}

	function __toString(){
		return $this->id;
	}
}