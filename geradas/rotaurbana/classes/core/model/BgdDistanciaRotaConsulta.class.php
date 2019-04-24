<?php
class BgdDistanciaRotaConsulta {
	
	public $id;
	public $data_captura;
	public $distancia;
	public $oBgdCidade;
	public $oBgdLinha;
	public $fonte;
	
	function __construct($id = NULL, $data_captura = NULL, $distancia = NULL, BgdCidade $oBgdCidade = NULL, BgdLinha $oBgdLinha = NULL, $fonte = NULL){
		$this->id = $id;
		$this->data_captura = $data_captura;
		$this->distancia = $distancia;
		$this->oBgdCidade = ($oBgdCidade == NULL) ? new BgdCidade() : $oBgdCidade;
		$this->oBgdLinha = ($oBgdLinha == NULL) ? new BgdLinha() : $oBgdLinha;
		$this->fonte = $fonte;
	}

	function __toString(){
		return $this->id;
	}
}