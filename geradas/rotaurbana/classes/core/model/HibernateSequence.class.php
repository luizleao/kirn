<?php
class HibernateSequence {
	
	public $next_val;
	
	function __construct($next_val = NULL){
		$this->next_val = $next_val;
	}

	function __toString(){
		return $this->;
	}
}