<?php
class TipoServico {
	
	public $idTipoServico;
	public $oNaturezaContratual;
	public $descricao;
	public $status;
	
	function __construct($idTipoServico = NULL, NaturezaContratual $oNaturezaContratual = NULL, $descricao = NULL, $status = NULL){
		$this->idTipoServico = $idTipoServico;
		$this->oNaturezaContratual = ($oNaturezaContratual == NULL) ? new NaturezaContratual() : $oNaturezaContratual;
		$this->descricao = $descricao;
		$this->status = $status;
	}

	function __toString(){
		return $this->descricao;
	}
}