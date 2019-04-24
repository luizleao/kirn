<?php
class SicasLotacao {
	
	public $cd_lotacao;
	
	function __construct($cd_lotacao = NULL){
		$this->cd_lotacao = $cd_lotacao;
	}

	function __toString(){
		return $this->cd_lotacao;
	}
}