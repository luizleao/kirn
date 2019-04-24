<?php
class Usuario {
	
	public $id;
	public $email;
	public $login;
	public $nome;
	public $roles;
	public $senha;
	public $tos;
	public $numlogins;
	public $numrotasvisu;
	public $paradascriadas;
	public $paradaseditadas;
	public $rotascriadas;
	public $rotaseditadas;
	public $totalpontos;
	public $nivel;
	public $insig1;
	public $insig2;
	public $insig3;
	public $insig4;
	
	function __construct($id = NULL, $email = NULL, $login = NULL, $nome = NULL, $roles = NULL, $senha = NULL, $tos = NULL, $numlogins = NULL, $numrotasvisu = NULL, $paradascriadas = NULL, $paradaseditadas = NULL, $rotascriadas = NULL, $rotaseditadas = NULL, $totalpontos = NULL, $nivel = NULL, $insig1 = NULL, $insig2 = NULL, $insig3 = NULL, $insig4 = NULL){
		$this->id = $id;
		$this->email = $email;
		$this->login = $login;
		$this->nome = $nome;
		$this->roles = $roles;
		$this->senha = $senha;
		$this->tos = $tos;
		$this->numlogins = $numlogins;
		$this->numrotasvisu = $numrotasvisu;
		$this->paradascriadas = $paradascriadas;
		$this->paradaseditadas = $paradaseditadas;
		$this->rotascriadas = $rotascriadas;
		$this->rotaseditadas = $rotaseditadas;
		$this->totalpontos = $totalpontos;
		$this->nivel = $nivel;
		$this->insig1 = $insig1;
		$this->insig2 = $insig2;
		$this->insig3 = $insig3;
		$this->insig4 = $insig4;
	}

	function __toString(){
		return $this->email;
	}
}