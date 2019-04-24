<?php
class DIA {
	
	public $d;
	public $oPERFILACESSO;
	
	function __construct($d = NULL, PERFILACESSO $oPERFILACESSO = NULL){
		$this->d = $d;
		$this->oPERFILACESSO = ($oPERFILACESSO == NULL) ? new PERFILACESSO() : $oPERFILACESSO;
	}

	function __toString(){
		return $this->;
	}
}