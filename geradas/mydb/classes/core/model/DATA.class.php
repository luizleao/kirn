<?php
class DATA {
	
	public $data_inicio;
	public $data_fim;
	public $oPERFILACESSO;
	
	function __construct($data_inicio = NULL, $data_fim = NULL, PERFILACESSO $oPERFILACESSO = NULL){
		$this->data_inicio = $data_inicio;
		$this->data_fim = $data_fim;
		$this->oPERFILACESSO = ($oPERFILACESSO == NULL) ? new PERFILACESSO() : $oPERFILACESSO;
	}

	function __toString(){
		return $this->;
	}
}