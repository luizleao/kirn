<?php
class BgdOrigemAcesso {
	
	public $id;
	public $data_captura;
	public $lat_proxma_usuario;
	public $lng_proxma_usuario;
	public $origem_acesso;
	public $oBgdCidade;
	public $fonte;
	
	function __construct($id = NULL, $data_captura = NULL, $lat_proxma_usuario = NULL, $lng_proxma_usuario = NULL, $origem_acesso = NULL, BgdCidade $oBgdCidade = NULL, $fonte = NULL){
		$this->id = $id;
		$this->data_captura = $data_captura;
		$this->lat_proxma_usuario = $lat_proxma_usuario;
		$this->lng_proxma_usuario = $lng_proxma_usuario;
		$this->origem_acesso = $origem_acesso;
		$this->oBgdCidade = ($oBgdCidade == NULL) ? new BgdCidade() : $oBgdCidade;
		$this->fonte = $fonte;
	}

	function __toString(){
		return $this->id;
	}
}