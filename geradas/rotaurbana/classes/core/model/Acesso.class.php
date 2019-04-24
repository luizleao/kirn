<?php
class Acesso {
	
	public $ip;
	public $oIndicador;
	
	function __construct($ip = NULL, Indicador $oIndicador = NULL){
		$this->ip = $ip;
		$this->oIndicador = ($oIndicador == NULL) ? new Indicador() : $oIndicador;
	}

	function __toString(){
		return $this->id;
	}
}