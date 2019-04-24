<?php
class Consultasnatelavisualizarrotaandroid {
	
	public $id;
	public $contador;
	public $idAndroid;
	
	function __construct($id = NULL, $contador = NULL, $idAndroid = NULL){
		$this->id = $id;
		$this->contador = $contador;
		$this->idAndroid = $idAndroid;
	}

	function __toString(){
		return $this->id;
	}
}