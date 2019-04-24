<?php
class SEMANAATIVA {
	
	public $semana;
	public $oPERFILACESSO;
	
	function __construct($semana = NULL, PERFILACESSO $oPERFILACESSO = NULL){
		$this->semana = $semana;
		$this->oPERFILACESSO = ($oPERFILACESSO == NULL) ? new PERFILACESSO() : $oPERFILACESSO;
	}

	function __toString(){
		return $this->;
	}
}