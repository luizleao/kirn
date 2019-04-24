<?php
class Linha {
	
	public $id;
	public $codigo;
	public $emAvaliacao;
	public $nome;
	public $oUsuario;
	public $sincronizacaoCodigo;
	public $tipo;
	public $comentario;
	public $completa;
	public $faltaCadastrarPontosPesquisa;
	public $url;
	public $oCidade;
	public $tipoDeRota;
	public $itinerarioTotalEncoding;
	public $lastUpdate;
	public $semob;
	public $oLinha;
	
	function __construct($id = NULL, $codigo = NULL, $emAvaliacao = NULL, $nome = NULL, Usuario $oUsuario = NULL, $sincronizacaoCodigo = NULL, $tipo = NULL, $comentario = NULL, $completa = NULL, $faltaCadastrarPontosPesquisa = NULL, $url = NULL, Cidade $oCidade = NULL, $tipoDeRota = NULL, $itinerarioTotalEncoding = NULL, $lastUpdate = NULL, $semob = NULL, Linha $oLinha = NULL){
		$this->id = $id;
		$this->codigo = $codigo;
		$this->emAvaliacao = $emAvaliacao;
		$this->nome = $nome;
		$this->oUsuario = ($oUsuario == NULL) ? new Usuario() : $oUsuario;
		$this->sincronizacaoCodigo = $sincronizacaoCodigo;
		$this->tipo = $tipo;
		$this->comentario = $comentario;
		$this->completa = $completa;
		$this->faltaCadastrarPontosPesquisa = $faltaCadastrarPontosPesquisa;
		$this->url = $url;
		$this->oCidade = ($oCidade == NULL) ? new Cidade() : $oCidade;
		$this->tipoDeRota = $tipoDeRota;
		$this->itinerarioTotalEncoding = $itinerarioTotalEncoding;
		$this->lastUpdate = $lastUpdate;
		$this->semob = $semob;
		$this->oLinha = ($oLinha == NULL) ? new Linha() : $oLinha;
	}

	function __toString(){
		return $this->nome;
	}
}