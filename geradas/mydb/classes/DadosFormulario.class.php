<?php
class DadosFormulario {

	static function formCIDADE($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["ESTADO_id"] = strip_tags(addslashes(trim($post["ESTADO_id"])));
	
		return $post;		
	}

	static function formCLIENTE($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
		$post["PESSOA_id"] = strip_tags(addslashes(trim($post["PESSOA_id"])));
		$post["ENDERECO_id"] = strip_tags(addslashes(trim($post["ENDERECO_id"])));
	
		return $post;		
	}

	static function formCODIGOACESSO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["codigo"] = strip_tags(addslashes(trim($post["codigo"])));
		$post["PESSOA_id"] = strip_tags(addslashes(trim($post["PESSOA_id"])));
	
		return $post;		
	}

	static function formDATA($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["data_inicio"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["data_inicio"]))));
		$post["data_fim"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["data_fim"]))));
		$post["PERFIL_ACESSO_id"] = strip_tags(addslashes(trim($post["PERFIL_ACESSO_id"])));
	
		return $post;		
	}

	static function formDIA($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["d"] = strip_tags(addslashes(trim($post["d"])));
		$post["PERFIL_ACESSO_id"] = strip_tags(addslashes(trim($post["PERFIL_ACESSO_id"])));
	
		return $post;		
	}

	static function formENDERECO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["rua"] = strip_tags(addslashes(trim($post["rua"])));
		$post["bairro"] = strip_tags(addslashes(trim($post["bairro"])));
		$post["cep"] = strip_tags(addslashes(trim($post["cep"])));
		$post["numero"] = strip_tags(addslashes(trim($post["numero"])));
		$post["complemento"] = strip_tags(addslashes(trim($post["complemento"])));
		$post["CIDADE_id"] = strip_tags(addslashes(trim($post["CIDADE_id"])));
	
		return $post;		
	}

	static function formESTADO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["PAIS_id"] = strip_tags(addslashes(trim($post["PAIS_id"])));
		$post["uf"] = strip_tags(addslashes(trim($post["uf"])));
	
		return $post;		
	}

	static function formFATURA($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["valor"] = Util::formataMoedaBanco(strip_tags(addslashes(trim($post["valor"]))));
		$post["vencimento"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["vencimento"]))));
		$post["pagamento"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["pagamento"]))));
		$post["CLIENTE_id"] = strip_tags(addslashes(trim($post["CLIENTE_id"])));
	
		return $post;		
	}

	static function formHORARIO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["horario_inicio"] = strip_tags(addslashes(trim($post["horario_inicio"])));
		$post["horario_fim"] = strip_tags(addslashes(trim($post["horario_fim"])));
		$post["PERFIL_ACESSO_id"] = strip_tags(addslashes(trim($post["PERFIL_ACESSO_id"])));
	
		return $post;		
	}

	static function formPAIS($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["sigla"] = strip_tags(addslashes(trim($post["sigla"])));
	
		return $post;		
	}

	static function formPERFIL($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
	
		return $post;		
	}

	static function formPERFILACESSO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["se_semana"] = strip_tags(addslashes(trim($post["se_semana"])));
	
		return $post;		
	}

	static function formPERMISSAO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["alteracao"] = strip_tags(addslashes(trim($post["alteracao"])));
		$post["insercao"] = strip_tags(addslashes(trim($post["insercao"])));
		$post["exclusao"] = strip_tags(addslashes(trim($post["exclusao"])));
		$post["visualizacao"] = strip_tags(addslashes(trim($post["visualizacao"])));
	
		return $post;		
	}

	static function formPESSOA($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["cpf"] = strip_tags(addslashes(trim($post["cpf"])));
		$post["nascimento"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["nascimento"]))));
		$post["PERFIL_ACESSO_id"] = strip_tags(addslashes(trim($post["PERFIL_ACESSO_id"])));
	
		return $post;		
	}

	static function formREGISTROACESSO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["data"] = Util::formataDataFormBanco(strip_tags(addslashes(trim($post["data"]))));
		$post["hora"] = strip_tags(addslashes(trim($post["hora"])));
		$post["sentido"] = strip_tags(addslashes(trim($post["sentido"])));
		$post["permissao"] = strip_tags(addslashes(trim($post["permissao"])));
		$post["PESSOA_id"] = strip_tags(addslashes(trim($post["PESSOA_id"])));
		$post["PERFIL_ACESSO_id"] = strip_tags(addslashes(trim($post["PERFIL_ACESSO_id"])));
	
		return $post;		
	}

	static function formSEMANA($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["dia_semana"] = strip_tags(addslashes(trim($post["dia_semana"])));
		$post["PERFIL_ACESSO_id"] = strip_tags(addslashes(trim($post["PERFIL_ACESSO_id"])));
	
		return $post;		
	}

	static function formSEMANAATIVA($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["semana"] = strip_tags(addslashes(trim($post["semana"])));
		$post["PERFIL_ACESSO_id"] = strip_tags(addslashes(trim($post["PERFIL_ACESSO_id"])));
	
		return $post;		
	}

	static function formTELA($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
	
		return $post;		
	}

	static function formTELAPERMISSAO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["TELA_id"] = strip_tags(addslashes(trim($post["TELA_id"])));
		$post["PERMISSAO_id"] = strip_tags(addslashes(trim($post["PERMISSAO_id"])));
		$post["PERFIL_id"] = strip_tags(addslashes(trim($post["PERFIL_id"])));
	
		return $post;		
	}

	static function formUSUARIO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["login"] = strip_tags(addslashes(trim($post["login"])));
		$post["senha"] = strip_tags(addslashes(trim($post["senha"])));
		$post["PESSOA_id"] = strip_tags(addslashes(trim($post["PESSOA_id"])));
		$post["PERFIL_id"] = strip_tags(addslashes(trim($post["PERFIL_id"])));
	
		return $post;		
	}

}
