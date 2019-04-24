<?php
class FATURA {
	
	public $valor;
	public $vencimento;
	public $pagamento;
	public $oCLIENTE;
	
	function __construct($valor = NULL, $vencimento = NULL, $pagamento = NULL, CLIENTE $oCLIENTE = NULL){
		$this->valor = $valor;
		$this->vencimento = $vencimento;
		$this->pagamento = $pagamento;
		$this->oCLIENTE = ($oCLIENTE == NULL) ? new CLIENTE() : $oCLIENTE;
	}

	function __toString(){
		return $this->;
	}
}