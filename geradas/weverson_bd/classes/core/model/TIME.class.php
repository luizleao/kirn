<?php
class TIME {
	
	public $id;
	public $pais;
	public $tecnico;
	
	function __construct($id = NULL, $pais = NULL, $tecnico = NULL){
		$this->id = $id;
		$this->pais = $pais;
		$this->tecnico = $tecnico;
	}

	function __toString(){
		return $this->id;
	}
}