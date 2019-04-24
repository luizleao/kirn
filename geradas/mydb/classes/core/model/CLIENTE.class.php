<?php
class CLIENTE {
	
	public $id;
	public $status;
	public $oPESSOA;
	public $oENDERECO;
	
	function __construct($id = NULL, $status = NULL, PESSOA $oPESSOA = NULL, ENDERECO $oENDERECO = NULL){
		$this->id = $id;
		$this->status = $status;
		$this->oPESSOA = ($oPESSOA == NULL) ? new PESSOA() : $oPESSOA;
		$this->oENDERECO = ($oENDERECO == NULL) ? new ENDERECO() : $oENDERECO;
	}

	function __toString(){
		return $this->id;
	}
}