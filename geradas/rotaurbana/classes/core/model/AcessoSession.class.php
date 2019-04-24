<?php
class AcessoSession {
	
	public $oAcesso;
	public $sessions_id;
	
	function __construct(Acesso $oAcesso = NULL, $sessions_id = NULL){
		$this->oAcesso = ($oAcesso == NULL) ? new Acesso() : $oAcesso;
		$this->sessions_id = $sessions_id;
	}

	function __toString(){
		return $this->sessions_id;
	}
}