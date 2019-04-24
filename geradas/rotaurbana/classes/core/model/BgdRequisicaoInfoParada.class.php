<?php
class BgdRequisicaoInfoParada {
	
	public $id;
	public $commentsParada;
	public $data_captura;
	public $titleParada;
	public $oBgdCidade;
	public $oBgdCidade;
	public $oBgdParada;
	public $lat_proxma_usuario;
	public $lng_proxma_usuario;
	public $fonte;
	
	function __construct($id = NULL, $commentsParada = NULL, $data_captura = NULL, $titleParada = NULL, BgdCidade $oBgdCidade = NULL, BgdCidade $oBgdCidade = NULL, BgdParada $oBgdParada = NULL, $lat_proxma_usuario = NULL, $lng_proxma_usuario = NULL, $fonte = NULL){
		$this->id = $id;
		$this->commentsParada = $commentsParada;
		$this->data_captura = $data_captura;
		$this->titleParada = $titleParada;
		$this->oBgdCidade = ($oBgdCidade == NULL) ? new BgdCidade() : $oBgdCidade;
		$this->oBgdCidade = ($oBgdCidade == NULL) ? new BgdCidade() : $oBgdCidade;
		$this->oBgdParada = ($oBgdParada == NULL) ? new BgdParada() : $oBgdParada;
		$this->lat_proxma_usuario = $lat_proxma_usuario;
		$this->lng_proxma_usuario = $lng_proxma_usuario;
		$this->fonte = $fonte;
	}

	function __toString(){
		return $this->id;
	}
}