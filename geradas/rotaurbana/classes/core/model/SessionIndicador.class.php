<?php
class SessionIndicador {
	
	public $oSession;
	public $indicadores_id;
	
	function __construct(Session $oSession = NULL, $indicadores_id = NULL){
		$this->oSession = ($oSession == NULL) ? new Session() : $oSession;
		$this->indicadores_id = $indicadores_id;
	}

	function __toString(){
		return $this->indicadores_id;
	}
}