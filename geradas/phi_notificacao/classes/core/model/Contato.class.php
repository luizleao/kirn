<?php
class Contato {
	
	public $id_tel;
	public $numero;
	public $ddd;
	public $email;
	
	function __construct($id_tel = NULL, $numero = NULL, $ddd = NULL, $email = NULL){
		$this->id_tel = $id_tel;
		$this->numero = $numero;
		$this->ddd = $ddd;
		$this->email = $email;
	}

	function __toString(){
		return $this->email;
	}
}