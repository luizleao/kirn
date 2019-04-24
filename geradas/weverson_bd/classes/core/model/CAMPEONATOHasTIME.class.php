<?php
class CAMPEONATOHasTIME {
	
	public $oCAMPEONATO;
	public $oTIME;
	
	function __construct(CAMPEONATO $oCAMPEONATO = NULL, TIME $oTIME = NULL){
		$this->oCAMPEONATO = ($oCAMPEONATO == NULL) ? new CAMPEONATO() : $oCAMPEONATO;
		$this->oTIME = ($oTIME == NULL) ? new TIME() : $oTIME;
	}

	function __toString(){
		return $this->TIME_id;
	}
}