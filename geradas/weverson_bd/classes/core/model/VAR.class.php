<?php
class VAR {
	
	public $id;
	public $oPARTIDA;
	
	function __construct($id = NULL, PARTIDA $oPARTIDA = NULL){
		$this->id = $id;
		$this->oPARTIDA = ($oPARTIDA == NULL) ? new PARTIDA() : $oPARTIDA;
	}

	function __toString(){
		return $this->PARTIDA_id;
	}
}