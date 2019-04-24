<?php
class Sensor {
	
	public $id_sensor;
	public $localizacao;
	public $descricao;
	
	function __construct($id_sensor = NULL, $localizacao = NULL, $descricao = NULL){
		$this->id_sensor = $id_sensor;
		$this->localizacao = $localizacao;
		$this->descricao = $descricao;
	}

	function __toString(){
		return $this->id_sensor;
	}
}