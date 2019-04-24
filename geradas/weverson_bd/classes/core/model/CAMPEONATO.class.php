<?php
class CAMPEONATO {
	
	public $id;
	
	function __construct($id = NULL){
		$this->id = $id;
	}

	function __toString(){
		return $this->id;
	}
}