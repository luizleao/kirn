<?php
class USUARIO {
	
	public $login;
	public $senha;
	public $oPESSOA;
	public $oPERFIL;
	
	function __construct($login = NULL, $senha = NULL, PESSOA $oPESSOA = NULL, PERFIL $oPERFIL = NULL){
		$this->login = $login;
		$this->senha = $senha;
		$this->oPESSOA = ($oPESSOA == NULL) ? new PESSOA() : $oPESSOA;
		$this->oPERFIL = ($oPERFIL == NULL) ? new PERFIL() : $oPERFIL;
	}

	function __toString(){
		return $this->login;
	}
}