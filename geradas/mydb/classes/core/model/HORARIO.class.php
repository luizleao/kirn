<?php
class HORARIO {
	
	public $horario_inicio;
	public $horario_fim;
	public $oPERFILACESSO;
	
	function __construct($horario_inicio = NULL, $horario_fim = NULL, PERFILACESSO $oPERFILACESSO = NULL){
		$this->horario_inicio = $horario_inicio;
		$this->horario_fim = $horario_fim;
		$this->oPERFILACESSO = ($oPERFILACESSO == NULL) ? new PERFILACESSO() : $oPERFILACESSO;
	}

	function __toString(){
		return $this->;
	}
}