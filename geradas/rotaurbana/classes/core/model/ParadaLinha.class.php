<?php
class ParadaLinha {
	
	public $paradas_id;
	public $linha_id;
	
	function __construct($paradas_id = NULL, $linha_id = NULL){
		$this->paradas_id = $paradas_id;
		$this->linha_id = $linha_id;
	}

	function __toString(){
		return $this->;
	}
}