<?php
class TELAPERMISSAO {
	
	public $oTELA;
	public $oPERMISSAO;
	public $oPERFIL;
	
	function __construct(TELA $oTELA = NULL, PERMISSAO $oPERMISSAO = NULL, PERFIL $oPERFIL = NULL){
		$this->oTELA = ($oTELA == NULL) ? new TELA() : $oTELA;
		$this->oPERMISSAO = ($oPERMISSAO == NULL) ? new PERMISSAO() : $oPERMISSAO;
		$this->oPERFIL = ($oPERFIL == NULL) ? new PERFIL() : $oPERFIL;
	}

	function __toString(){
		return $this->;
	}
}