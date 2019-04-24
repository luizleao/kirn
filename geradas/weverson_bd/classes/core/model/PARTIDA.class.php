<?php
class PARTIDA {
	
	public $id;
	public $oTIME;
	public $oTIME;
	
	function __construct($id = NULL, TIME $oTIME = NULL, TIME $oTIME = NULL){
		$this->id = $id;
		$this->oTIME = ($oTIME == NULL) ? new TIME() : $oTIME;
		$this->oTIME = ($oTIME == NULL) ? new TIME() : $oTIME;
	}

	function __toString(){
		return $this->idvisitante;
	}
}