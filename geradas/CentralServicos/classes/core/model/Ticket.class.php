<?php
class Ticket {
	
	public $idTicket;
	public $oServico;
	public $cd_servidor_solicitante;
	public $cd_servidor_recebimento;
	public $numero;
	public $descricao;
	public $dataHoraAbertura;
	public $flagAprovado;
	public $flagAtendido;
	public $flagExecutado;
	public $status;
	
	function __construct($idTicket = NULL, Servico $oServico = NULL, $cd_servidor_solicitante = NULL, $cd_servidor_recebimento = NULL, $numero = NULL, $descricao = NULL, $dataHoraAbertura = NULL, $flagAprovado = NULL, $flagAtendido = NULL, $flagExecutado = NULL, $status = NULL){
		$this->idTicket = $idTicket;
		$this->oServico = ($oServico == NULL) ? new Servico() : $oServico;
		$this->cd_servidor_solicitante = $cd_servidor_solicitante;
		$this->cd_servidor_recebimento = $cd_servidor_recebimento;
		$this->numero = $numero;
		$this->descricao = $descricao;
		$this->dataHoraAbertura = $dataHoraAbertura;
		$this->flagAprovado = $flagAprovado;
		$this->flagAtendido = $flagAtendido;
		$this->flagExecutado = $flagExecutado;
		$this->status = $status;
	}

	function __toString(){
		return $this->idTicket;
	}
}