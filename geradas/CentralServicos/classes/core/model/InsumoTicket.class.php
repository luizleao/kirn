<?php
class InsumoTicket {
	
	public $oTicket;
	public $oInsumo;
	public $quantidade;
	
	function __construct(Ticket $oTicket = NULL, Insumo $oInsumo = NULL, $quantidade = NULL){
		$this->oTicket = ($oTicket == NULL) ? new Ticket() : $oTicket;
		$this->oInsumo = ($oInsumo == NULL) ? new Insumo() : $oInsumo;
		$this->quantidade = $quantidade;
	}

	function __toString(){
		return $this->idInsumo;
	}
}