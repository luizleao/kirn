<?php
class ValidadorFormulario {
	
	public $msg;
	
	function __construct($msg = NULL){
		$this->msg = $msg;
	}

	function validaFormARBITROAUX(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($acao == 2){
			if($PARTIDA_id == ''){
				$this->msg = "Partida inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormCAMPEONATO(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormCAMPEONATOHasTIME(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($CAMPEONATO_id == ''){
				$this->msg = "Campeonato inválido!";
				return false;
			}
		}
		if($acao == 2){
			if($TIME_id == ''){
				$this->msg = "Time inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormEVENTO SUSPEITO(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		
		*/
		return true;		
	}

	function validaFormEVENTOS INTERNOS(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		
		*/
		return true;		
	}

	function validaFormJOGADOR(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($cpf == ''){
				$this->msg = "Cpf inválido!";
				return false;
			}
		}
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($n_camisa == ''){
			$this->msg = "N_camisa inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		if($TIME_id == ''){
			$this->msg = "Time inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPARTIDA(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($acao == 2){
			if($idmadante == ''){
				$this->msg = "Time inválido!";
				return false;
			}
		}
		if($acao == 2){
			if($idvisitante == ''){
				$this->msg = "Time inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormTIME(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($pais == ''){
			$this->msg = "Pais inválido!";
			return false;
		}	
		if($tecnico == ''){
			$this->msg = "Tecnico inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormUNIFORME(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idUNIFORME == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($camisa == ''){
			$this->msg = "Camisa inválido!";
			return false;
		}	
		if($shot == ''){
			$this->msg = "Shot inválido!";
			return false;
		}	
		if($meia == ''){
			$this->msg = "Meia inválido!";
			return false;
		}	
		if($UNIFORMEcol == ''){
			$this->msg = "Col inválido!";
			return false;
		}	
		if($acao == 2){
			if($TIME_id == ''){
				$this->msg = "Time inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormVAR(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($acao == 2){
			if($PARTIDA_id == ''){
				$this->msg = "Partida inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

}