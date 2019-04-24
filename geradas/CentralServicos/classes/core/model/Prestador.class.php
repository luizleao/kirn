<?php
class Prestador {
	
	public $idPrestador;
	public $oNaturezaContratual;
	public $nome;
	public $numeroContrato;
	public $nomePreposto;
	public $contatoPreposto;
	public $usuario;
	public $senha;
	public $email;
	public $status;
	
	function __construct($idPrestador = NULL, NaturezaContratual $oNaturezaContratual = NULL, $nome = NULL, $numeroContrato = NULL, $nomePreposto = NULL, $contatoPreposto = NULL, $usuario = NULL, $senha = NULL, $email = NULL, $status = NULL){
		$this->idPrestador = $idPrestador;
		$this->oNaturezaContratual = ($oNaturezaContratual == NULL) ? new NaturezaContratual() : $oNaturezaContratual;
		$this->nome = $nome;
		$this->numeroContrato = $numeroContrato;
		$this->nomePreposto = $nomePreposto;
		$this->contatoPreposto = $contatoPreposto;
		$this->usuario = $usuario;
		$this->senha = $senha;
		$this->email = $email;
		$this->status = $status;
	}

	function __toString(){
		return $this->nome;
	}
}