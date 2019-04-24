<?php
class Servico {
	
	public $idServico;
	public $oSla;
	public $oTipoServico;
	public $descricao;
	public $valor;
	public $status;
	
	function __construct($idServico = NULL, Sla $oSla = NULL, TipoServico $oTipoServico = NULL, $descricao = NULL, $valor = NULL, $status = NULL){
		$this->idServico = $idServico;
		$this->oSla = ($oSla == NULL) ? new Sla() : $oSla;
		$this->oTipoServico = ($oTipoServico == NULL) ? new TipoServico() : $oTipoServico;
		$this->descricao = $descricao;
		$this->valor = $valor;
		$this->status = $status;
	}

	function __toString(){
		return $this->descricao;
	}
}