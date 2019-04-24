<?php
class LogVoicer {
	
	public $id;
	public $compreendido;
	public $idUsuario;
	public $menuAtual;
	public $momento;
	public $resultado;
	
	function __construct($id = NULL, $compreendido = NULL, $idUsuario = NULL, $menuAtual = NULL, $momento = NULL, $resultado = NULL){
		$this->id = $id;
		$this->compreendido = $compreendido;
		$this->idUsuario = $idUsuario;
		$this->menuAtual = $menuAtual;
		$this->momento = $momento;
		$this->resultado = $resultado;
	}

	function __toString(){
		return $this->id;
	}
}