<?php
class SEMANA {
	
	public $dia_semana;
	public $oPERFILACESSO;
	
	function __construct($dia_semana = NULL, PERFILACESSO $oPERFILACESSO = NULL){
		$this->dia_semana = $dia_semana;
		$this->oPERFILACESSO = ($oPERFILACESSO == NULL) ? new PERFILACESSO() : $oPERFILACESSO;
	}

	function __toString(){
		return $this->;
	}
}