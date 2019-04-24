<?php
class REGISTROACESSO {
	
	public $id;
	public $data;
	public $hora;
	public $sentido;
	public $permissao;
	public $oPESSOA;
	public $oPERFILACESSO;
	
	function __construct($id = NULL, $data = NULL, $hora = NULL, $sentido = NULL, $permissao = NULL, PESSOA $oPESSOA = NULL, PERFILACESSO $oPERFILACESSO = NULL){
		$this->id = $id;
		$this->data = $data;
		$this->hora = $hora;
		$this->sentido = $sentido;
		$this->permissao = $permissao;
		$this->oPESSOA = ($oPESSOA == NULL) ? new PESSOA() : $oPESSOA;
		$this->oPERFILACESSO = ($oPERFILACESSO == NULL) ? new PERFILACESSO() : $oPERFILACESSO;
	}

	function __toString(){
		return $this->id;
	}
}