<?php
class ValidadorFormulario {
	
	public $msg;
	
	function __construct($msg = NULL){
		$this->msg = $msg;
	}

	function validaFormCIDADE(&$post, $acao=''){
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
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($ESTADO_id == ''){
			$this->msg = "Estado inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormCLIENTE(&$post, $acao=''){
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
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		if($PESSOA_id == ''){
			$this->msg = "Pessoa inválido!";
			return false;
		}	
		if($ENDERECO_id == ''){
			$this->msg = "Endereco inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormCODIGOACESSO(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($codigo == ''){
			$this->msg = "Codigo inválido!";
			return false;
		}	
		if($PESSOA_id == ''){
			$this->msg = "Pessoa inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormDATA(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($data_inicio == ''){
			$this->msg = "Data_inicio inválido!";
			return false;
		}	
		if($data_fim == ''){
			$this->msg = "Data_fim inválido!";
			return false;
		}	
		if($PERFIL_ACESSO_id == ''){
			$this->msg = "Perfil_acesso inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormDIA(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($d == ''){
			$this->msg = "D inválido!";
			return false;
		}	
		if($PERFIL_ACESSO_id == ''){
			$this->msg = "Perfil_acesso inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormENDERECO(&$post, $acao=''){
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
		if($rua == ''){
			$this->msg = "Rua inválido!";
			return false;
		}	
		if($bairro == ''){
			$this->msg = "Bairro inválido!";
			return false;
		}	
		if($cep == ''){
			$this->msg = "Cep inválido!";
			return false;
		}	
		if($numero == ''){
			$this->msg = "Numero inválido!";
			return false;
		}	
		if($complemento == ''){
			$this->msg = "Complemento inválido!";
			return false;
		}	
		if($CIDADE_id == ''){
			$this->msg = "Cidade inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormESTADO(&$post, $acao=''){
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
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($PAIS_id == ''){
			$this->msg = "Pais inválido!";
			return false;
		}	
		if($uf == ''){
			$this->msg = "Uf inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormFATURA(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($valor == ''){
			$this->msg = "Valor inválido!";
			return false;
		}	
		if($vencimento == ''){
			$this->msg = "Vencimento inválido!";
			return false;
		}	
		if($pagamento == ''){
			$this->msg = "Pagamento inválido!";
			return false;
		}	
		if($CLIENTE_id == ''){
			$this->msg = "Cliente inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormHORARIO(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($horario_inicio == ''){
			$this->msg = "Horario_inicio inválido!";
			return false;
		}	
		if($horario_fim == ''){
			$this->msg = "Horario_fim inválido!";
			return false;
		}	
		if($PERFIL_ACESSO_id == ''){
			$this->msg = "Perfil_acesso inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPAIS(&$post, $acao=''){
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
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($sigla == ''){
			$this->msg = "Sigla inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPERFIL(&$post, $acao=''){
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
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPERFILACESSO(&$post, $acao=''){
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
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($se_semana == ''){
			$this->msg = "Se_semana inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPERMISSAO(&$post, $acao=''){
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
		if($alteracao == ''){
			$this->msg = "Alteracao inválido!";
			return false;
		}	
		if($insercao == ''){
			$this->msg = "Insercao inválido!";
			return false;
		}	
		if($exclusao == ''){
			$this->msg = "Exclusao inválido!";
			return false;
		}	
		if($visualizacao == ''){
			$this->msg = "Visualizacao inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPESSOA(&$post, $acao=''){
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
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($cpf == ''){
			$this->msg = "Cpf inválido!";
			return false;
		}	
		if($nascimento == ''){
			$this->msg = "Nascimento inválido!";
			return false;
		}	
		if($PERFIL_ACESSO_id == ''){
			$this->msg = "Perfil_acesso inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormREGISTROACESSO(&$post, $acao=''){
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
		if($data == ''){
			$this->msg = "Data inválido!";
			return false;
		}	
		if($hora == ''){
			$this->msg = "Hora inválido!";
			return false;
		}	
		if($sentido == ''){
			$this->msg = "Sentido inválido!";
			return false;
		}	
		if($permissao == ''){
			$this->msg = "Permissao inválido!";
			return false;
		}	
		if($PESSOA_id == ''){
			$this->msg = "Pessoa inválido!";
			return false;
		}	
		if($PERFIL_ACESSO_id == ''){
			$this->msg = "Perfil_acesso inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormSEMANA(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($dia_semana == ''){
			$this->msg = "Dia_semana inválido!";
			return false;
		}	
		if($PERFIL_ACESSO_id == ''){
			$this->msg = "Perfil_acesso inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormSEMANAATIVA(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($semana == ''){
			$this->msg = "Semana inválido!";
			return false;
		}	
		if($PERFIL_ACESSO_id == ''){
			$this->msg = "Perfil_acesso inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormTELA(&$post, $acao=''){
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
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormTELAPERMISSAO(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($TELA_id == ''){
			$this->msg = "Tela inválido!";
			return false;
		}	
		if($PERMISSAO_id == ''){
			$this->msg = "Permissao inválido!";
			return false;
		}	
		if($PERFIL_id == ''){
			$this->msg = "Perfil inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormUSUARIO(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($login == ''){
			$this->msg = "Login inválido!";
			return false;
		}	
		if($senha == ''){
			$this->msg = "Senha inválido!";
			return false;
		}	
		if($PESSOA_id == ''){
			$this->msg = "Pessoa inválido!";
			return false;
		}	
		if($PERFIL_id == ''){
			$this->msg = "Perfil inválido!";
			return false;
		}	
		*/
		return true;		
	}

}