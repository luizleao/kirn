<?php
class ValidadorFormulario {
	
	public $msg;
	
	function __construct($msg = NULL){
		$this->msg = $msg;
	}

	function validaFormAcompanhamento(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idAcompanhamento == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idTicket == ''){
			$this->msg = "Ticket inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($dataHora == ''){
			$this->msg = "DataHora inválido!";
			return false;
		}	
		if($usuario == ''){
			$this->msg = "Usuario inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormInsumo(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idInsumo == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idNaturezaContratual == ''){
			$this->msg = "Naturezacontratual inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($estoque == ''){
			$this->msg = "Estoque inválido!";
			return false;
		}	
		if($valor == ''){
			$this->msg = "Valor inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormInsumoTicket(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idTicket == ''){
				$this->msg = "Ticket inválido!";
				return false;
			}
		}
		if($acao == 2){
			if($idInsumo == ''){
				$this->msg = "Insumo inválido!";
				return false;
			}
		}
		if($quantidade == ''){
			$this->msg = "Quantidade inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormNaturezaContratual(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idNaturezaContratual == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPatrimonioTicket(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idPatrimonioTicket == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idTicket == ''){
			$this->msg = "Ticket inválido!";
			return false;
		}	
		if($tombamento == ''){
			$this->msg = "Tombamento inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPrestador(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idPrestador == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idNaturezaContratual == ''){
			$this->msg = "Naturezacontratual inválido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($numeroContrato == ''){
			$this->msg = "NumeroContrato inválido!";
			return false;
		}	
		if($nomePreposto == ''){
			$this->msg = "NomePreposto inválido!";
			return false;
		}	
		if($contatoPreposto == ''){
			$this->msg = "ContatoPreposto inválido!";
			return false;
		}	
		if($usuario == ''){
			$this->msg = "Usuario inválido!";
			return false;
		}	
		if($senha == ''){
			$this->msg = "Senha inválido!";
			return false;
		}	
		if($email == ''){
			$this->msg = "Email inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormServico(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idServico == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idSla == ''){
			$this->msg = "Sla inválido!";
			return false;
		}	
		if($idTipoServico == ''){
			$this->msg = "Tiposervico inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($valor == ''){
			$this->msg = "Valor inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormSicasLotacao(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($cd_lotacao == ''){
				$this->msg = "Cd_lotacao inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormSla(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idSla == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormTicket(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idTicket == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idServico == ''){
			$this->msg = "Servico inválido!";
			return false;
		}	
		if($cd_servidor_solicitante == ''){
			$this->msg = "Cd_servidor_solicitante inválido!";
			return false;
		}	
		if($cd_servidor_recebimento == ''){
			$this->msg = "Cd_servidor_recebimento inválido!";
			return false;
		}	
		if($numero == ''){
			$this->msg = "Numero inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($dataHoraAbertura == ''){
			$this->msg = "DataHoraAbertura inválido!";
			return false;
		}	
		if($flagAprovado == ''){
			$this->msg = "FlagAprovado inválido!";
			return false;
		}	
		if($flagAtendido == ''){
			$this->msg = "FlagAtendido inválido!";
			return false;
		}	
		if($flagExecutado == ''){
			$this->msg = "FlagExecutado inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormTipoServico(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($idTipoServico == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($idNaturezaContratual == ''){
			$this->msg = "Naturezacontratual inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		*/
		return true;		
	}

}