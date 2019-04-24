<?php
class Session {
	
	public $id;
	public $ident;
	
	function __construct($id = NULL, $ident = NULL){
		$this->id = $id;
		$this->ident = $ident;
	}

	function __toString(){
		return $this->id;
	}
}