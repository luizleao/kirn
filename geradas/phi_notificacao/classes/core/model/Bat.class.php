<?php
class Bat {
	
	public $id_bat;
	public $oSensor;
	public $oUsuario;
	public $descricao;
	public $data;
	public $raiva;
	
	function __construct($id_bat = NULL, Sensor $oSensor = NULL, Usuario $oUsuario = NULL, $descricao = NULL, $data = NULL, $raiva = NULL){
		$this->id_bat = $id_bat;
		$this->oSensor = ($oSensor == NULL) ? new Sensor() : $oSensor;
		$this->oUsuario = ($oUsuario == NULL) ? new Usuario() : $oUsuario;
		$this->descricao = $descricao;
		$this->data = $data;
		$this->raiva = $raiva;
	}

	function __toString(){
		return $this->id_bat;
	}
}