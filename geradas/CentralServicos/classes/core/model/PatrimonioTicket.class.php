<?php
class PatrimonioTicket {
	
	public $idPatrimonioTicket;
	public $oTicket;
	public $tombamento;
	public $status;
	
	function __construct($idPatrimonioTicket = NULL, Ticket $oTicket = NULL, $tombamento = NULL, $status = NULL){
		$this->idPatrimonioTicket = $idPatrimonioTicket;
		$this->oTicket = ($oTicket == NULL) ? new Ticket() : $oTicket;
		$this->tombamento = $tombamento;
		$this->status = $status;
	}

	function __toString(){
		return $this->idPatrimonioTicket;
	}
}