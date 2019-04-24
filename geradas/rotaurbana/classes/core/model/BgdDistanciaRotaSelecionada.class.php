<?php
class BgdDistanciaRotaSelecionada {
	
	public $id;
	public $data_captura;
	public $distancia;
	public $oBgdCidade;
	public $oBgdCidade;
	public $oBgdLinha;
	public $lat_proxma_usuario;
	public $lng_proxma_usuario;
	public $fonte;
	
	function __construct($id = NULL, $data_captura = NULL, $distancia = NULL, BgdCidade $oBgdCidade = NULL, BgdCidade $oBgdCidade = NULL, BgdLinha $oBgdLinha = NULL, $lat_proxma_usuario = NULL, $lng_proxma_usuario = NULL, $fonte = NULL){
		$this->id = $id;
		$this->data_captura = $data_captura;
		$this->distancia = $distancia;
		$this->oBgdCidade = ($oBgdCidade == NULL) ? new BgdCidade() : $oBgdCidade;
		$this->oBgdCidade = ($oBgdCidade == NULL) ? new BgdCidade() : $oBgdCidade;
		$this->oBgdLinha = ($oBgdLinha == NULL) ? new BgdLinha() : $oBgdLinha;
		$this->lat_proxma_usuario = $lat_proxma_usuario;
		$this->lng_proxma_usuario = $lng_proxma_usuario;
		$this->fonte = $fonte;
	}

	function __toString(){
		return $this->id;
	}
}