<?php
class Cadastrodeparadas {
	
	public $cont;
	public $oIndicador;
	
	function __construct($cont = NULL, Indicador $oIndicador = NULL){
		$this->cont = $cont;
		$this->oIndicador = ($oIndicador == NULL) ? new Indicador() : $oIndicador;
	}

	function __toString(){
		return $this->id;
	}
}