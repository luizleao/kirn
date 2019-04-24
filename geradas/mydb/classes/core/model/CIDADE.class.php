<?php
class CIDADE {
	
	public $id;
	public $nome;
	public $oESTADO;
	
	function __construct($id = NULL, $nome = NULL, ESTADO $oESTADO = NULL){
		$this->id = $id;
		$this->nome = $nome;
		$this->oESTADO = ($oESTADO == NULL) ? new ESTADO() : $oESTADO;
	}

	function __toString(){
		return $this->nome;
	}
}