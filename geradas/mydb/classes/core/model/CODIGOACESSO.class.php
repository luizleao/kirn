<?php
class CODIGOACESSO {
	
	public $codigo;
	public $oPESSOA;
	
	function __construct($codigo = NULL, PESSOA $oPESSOA = NULL){
		$this->codigo = $codigo;
		$this->oPESSOA = ($oPESSOA == NULL) ? new PESSOA() : $oPESSOA;
	}

	function __toString(){
		return $this->;
	}
}