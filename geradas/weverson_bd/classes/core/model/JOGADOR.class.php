<?php
class JOGADOR {
	
	public $cpf;
	public $nome;
	public $n_camisa;
	public $status;
	public $oTIME;
	
	function __construct($cpf = NULL, $nome = NULL, $n_camisa = NULL, $status = NULL, TIME $oTIME = NULL){
		$this->cpf = $cpf;
		$this->nome = $nome;
		$this->n_camisa = $n_camisa;
		$this->status = $status;
		$this->oTIME = ($oTIME == NULL) ? new TIME() : $oTIME;
	}

	function __toString(){
		return $this->nome;
	}
}