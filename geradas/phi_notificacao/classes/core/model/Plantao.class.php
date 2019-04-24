<?php
class Plantao {
	
	public $p_id;
	public $oUsuario;
	public $oSensor;
	public $datai;
	public $dataf;
	
	function __construct($p_id = NULL, Usuario $oUsuario = NULL, Sensor $oSensor = NULL, $datai = NULL, $dataf = NULL){
		$this->p_id = $p_id;
		$this->oUsuario = ($oUsuario == NULL) ? new Usuario() : $oUsuario;
		$this->oSensor = ($oSensor == NULL) ? new Sensor() : $oSensor;
		$this->datai = $datai;
		$this->dataf = $dataf;
	}

	function __toString(){
		return $this->p_id;
	}
}