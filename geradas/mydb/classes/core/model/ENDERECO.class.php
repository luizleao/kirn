<?php
class ENDERECO {
	
	public $id;
	public $rua;
	public $bairro;
	public $cep;
	public $numero;
	public $complemento;
	public $oCIDADE;
	
	function __construct($id = NULL, $rua = NULL, $bairro = NULL, $cep = NULL, $numero = NULL, $complemento = NULL, CIDADE $oCIDADE = NULL){
		$this->id = $id;
		$this->rua = $rua;
		$this->bairro = $bairro;
		$this->cep = $cep;
		$this->numero = $numero;
		$this->complemento = $complemento;
		$this->oCIDADE = ($oCIDADE == NULL) ? new CIDADE() : $oCIDADE;
	}

	function __toString(){
		return $this->id;
	}
}