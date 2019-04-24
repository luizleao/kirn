<?php
class PERMISSAO {
	
	public $id;
	public $alteracao;
	public $insercao;
	public $exclusao;
	public $visualizacao;
	
	function __construct($id = NULL, $alteracao = NULL, $insercao = NULL, $exclusao = NULL, $visualizacao = NULL){
		$this->id = $id;
		$this->alteracao = $alteracao;
		$this->insercao = $insercao;
		$this->exclusao = $exclusao;
		$this->visualizacao = $visualizacao;
	}

	function __toString(){
		return $this->id;
	}
}