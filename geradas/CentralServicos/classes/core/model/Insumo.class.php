<?php
class Insumo {
	
	public $idInsumo;
	public $oNaturezaContratual;
	public $descricao;
	public $estoque;
	public $valor;
	public $status;
	
	function __construct($idInsumo = NULL, NaturezaContratual $oNaturezaContratual = NULL, $descricao = NULL, $estoque = NULL, $valor = NULL, $status = NULL){
		$this->idInsumo = $idInsumo;
		$this->oNaturezaContratual = ($oNaturezaContratual == NULL) ? new NaturezaContratual() : $oNaturezaContratual;
		$this->descricao = $descricao;
		$this->estoque = $estoque;
		$this->valor = $valor;
		$this->status = $status;
	}

	function __toString(){
		return $this->descricao;
	}
}