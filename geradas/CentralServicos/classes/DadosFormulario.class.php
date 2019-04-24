<?php
class DadosFormulario {

	static function formAcompanhamento($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idAcompanhamento"] = strip_tags(addslashes(trim($post["idAcompanhamento"])));
		}
		$post["idTicket"] = strip_tags(addslashes(trim($post["idTicket"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["dataHora"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHora"]))));
		$post["usuario"] = strip_tags(addslashes(trim($post["usuario"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

	static function formInsumo($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idInsumo"] = strip_tags(addslashes(trim($post["idInsumo"])));
		}
		$post["idNaturezaContratual"] = strip_tags(addslashes(trim($post["idNaturezaContratual"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["estoque"] = strip_tags(addslashes(trim($post["estoque"])));
		$post["valor"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["valor"]))));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

	static function formInsumoTicket($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["idTicket"] = strip_tags(addslashes(trim($post["idTicket"])));
		$post["idInsumo"] = strip_tags(addslashes(trim($post["idInsumo"])));
		$post["quantidade"] = strip_tags(addslashes(trim($post["quantidade"])));
	
		return $post;		
	}

	static function formNaturezaContratual($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idNaturezaContratual"] = strip_tags(addslashes(trim($post["idNaturezaContratual"])));
		}
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

	static function formPatrimonioTicket($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idPatrimonioTicket"] = strip_tags(addslashes(trim($post["idPatrimonioTicket"])));
		}
		$post["idTicket"] = strip_tags(addslashes(trim($post["idTicket"])));
		$post["tombamento"] = strip_tags(addslashes(trim($post["tombamento"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

	static function formPrestador($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idPrestador"] = strip_tags(addslashes(trim($post["idPrestador"])));
		}
		$post["idNaturezaContratual"] = strip_tags(addslashes(trim($post["idNaturezaContratual"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["numeroContrato"] = strip_tags(addslashes(trim($post["numeroContrato"])));
		$post["nomePreposto"] = strip_tags(addslashes(trim($post["nomePreposto"])));
		$post["contatoPreposto"] = strip_tags(addslashes(trim($post["contatoPreposto"])));
		$post["usuario"] = strip_tags(addslashes(trim($post["usuario"])));
		$post["senha"] = strip_tags(addslashes(trim($post["senha"])));
		$post["email"] = strip_tags(addslashes(trim($post["email"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

	static function formServico($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idServico"] = strip_tags(addslashes(trim($post["idServico"])));
		}
		$post["idSla"] = strip_tags(addslashes(trim($post["idSla"])));
		$post["idTipoServico"] = strip_tags(addslashes(trim($post["idTipoServico"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["valor"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["valor"]))));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

	static function formSicasLotacao($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cd_lotacao"] = strip_tags(addslashes(trim($post["cd_lotacao"])));
	
		return $post;		
	}

	static function formSla($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idSla"] = strip_tags(addslashes(trim($post["idSla"])));
		}
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

	static function formTicket($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idTicket"] = strip_tags(addslashes(trim($post["idTicket"])));
		}
		$post["idServico"] = strip_tags(addslashes(trim($post["idServico"])));
		$post["cd_servidor_solicitante"] = strip_tags(addslashes(trim($post["cd_servidor_solicitante"])));
		$post["cd_servidor_recebimento"] = strip_tags(addslashes(trim($post["cd_servidor_recebimento"])));
		$post["numero"] = strip_tags(addslashes(trim($post["numero"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["dataHoraAbertura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataHoraAbertura"]))));
		$post["flagAprovado"] = strip_tags(addslashes(trim($post["flagAprovado"])));
		$post["flagAtendido"] = strip_tags(addslashes(trim($post["flagAtendido"])));
		$post["flagExecutado"] = strip_tags(addslashes(trim($post["flagExecutado"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

	static function formTipoServico($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["idTipoServico"] = strip_tags(addslashes(trim($post["idTipoServico"])));
		}
		$post["idNaturezaContratual"] = strip_tags(addslashes(trim($post["idNaturezaContratual"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
	
		return $post;		
	}

}
