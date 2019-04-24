<?php
class Acompanhamento {
	
	public $idAcompanhamento;
	public $oTicket;
	public $descricao;
	public $dataHora;
	public $usuario;
	public $status;
	
	function __construct($idAcompanhamento = NULL, Ticket $oTicket = NULL, $descricao = NULL, $dataHora = NULL, $usuario = NULL, $status = NULL){
		$this->idAcompanhamento = $idAcompanhamento;
		$this->oTicket = ($oTicket == NULL) ? new Ticket() : $oTicket;
		$this->descricao = $descricao;
		$this->dataHora = $dataHora;
		$this->usuario = $usuario;
		$this->status = $status;
	}

	function __toString(){
		return $this->descricao;
	}
}