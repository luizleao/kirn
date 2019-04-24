<?php
class UNIFORME {
	
	public $idUNIFORME;
	public $camisa;
	public $shot;
	public $meia;
	public $UNIFORMEcol;
	public $oTIME;
	
	function __construct($idUNIFORME = NULL, $camisa = NULL, $shot = NULL, $meia = NULL, $UNIFORMEcol = NULL, TIME $oTIME = NULL){
		$this->idUNIFORME = $idUNIFORME;
		$this->camisa = $camisa;
		$this->shot = $shot;
		$this->meia = $meia;
		$this->UNIFORMEcol = $UNIFORMEcol;
		$this->oTIME = ($oTIME == NULL) ? new TIME() : $oTIME;
	}

	function __toString(){
		return $this->TIME_id;
	}
}