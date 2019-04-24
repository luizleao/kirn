<?php
class DadosFormulario {

	static function formAcesso($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["ip"] = strip_tags(addslashes(trim($post["ip"])));
		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formAcessoSession($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["acesso_id"] = strip_tags(addslashes(trim($post["acesso_id"])));
		$post["sessions_id"] = strip_tags(addslashes(trim($post["sessions_id"])));
	
		return $post;		
	}

	static function formBgdCidade($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["id"] = strip_tags(addslashes(trim($post["id"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
	
		return $post;		
	}

	static function formBgdDistanciaRotaConsulta($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["data_captura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data_captura"]))));
		$post["distancia"] = strip_tags(addslashes(trim($post["distancia"])));
		$post["fk_bgd_cidade"] = strip_tags(addslashes(trim($post["fk_bgd_cidade"])));
		$post["fk_bgd_linha"] = strip_tags(addslashes(trim($post["fk_bgd_linha"])));
		$post["fonte"] = strip_tags(addslashes(trim($post["fonte"])));
	
		return $post;		
	}

	static function formBgdDistanciaRotaSelecionada($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["data_captura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data_captura"]))));
		$post["distancia"] = strip_tags(addslashes(trim($post["distancia"])));
		$post["fk_bgd_cidade"] = strip_tags(addslashes(trim($post["fk_bgd_cidade"])));
		$post["fk_bgd_cidade_prox_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_cidade_prox_usuario"])));
		$post["fk_bgd_linha"] = strip_tags(addslashes(trim($post["fk_bgd_linha"])));
		$post["lat_proxma_usuario"] = strip_tags(addslashes(trim($post["lat_proxma_usuario"])));
		$post["lng_proxma_usuario"] = strip_tags(addslashes(trim($post["lng_proxma_usuario"])));
		$post["fonte"] = strip_tags(addslashes(trim($post["fonte"])));
	
		return $post;		
	}

	static function formBgdEdicaoParada($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["commentsParada"] = strip_tags(addslashes(trim($post["commentsParada"])));
		$post["data_captura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data_captura"]))));
		$post["titleParada"] = strip_tags(addslashes(trim($post["titleParada"])));
		$post["bgd_cidade"] = strip_tags(addslashes(trim($post["bgd_cidade"])));
		$post["fk_bgd_cidade_prox_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_cidade_prox_usuario"])));
		$post["fk_bgd_parada"] = strip_tags(addslashes(trim($post["fk_bgd_parada"])));
		$post["lat_proxma_usuario"] = strip_tags(addslashes(trim($post["lat_proxma_usuario"])));
		$post["lng_proxma_usuario"] = strip_tags(addslashes(trim($post["lng_proxma_usuario"])));
		$post["fonte"] = strip_tags(addslashes(trim($post["fonte"])));
	
		return $post;		
	}

	static function formBgdEdicaoRotas($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["codigoLinha"] = strip_tags(addslashes(trim($post["codigoLinha"])));
		$post["comentarioLinha"] = strip_tags(addslashes(trim($post["comentarioLinha"])));
		$post["data_captura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data_captura"]))));
		$post["nomeLinhas"] = strip_tags(addslashes(trim($post["nomeLinhas"])));
		$post["fk_bgd_cidade"] = strip_tags(addslashes(trim($post["fk_bgd_cidade"])));
		$post["fk_bgd_cidade_prox_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_cidade_prox_usuario"])));
		$post["fk_bgd_linha"] = strip_tags(addslashes(trim($post["fk_bgd_linha"])));
		$post["fk_bgd_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_usuario"])));
		$post["lat_proxma_usuario"] = strip_tags(addslashes(trim($post["lat_proxma_usuario"])));
		$post["lng_proxma_usuario"] = strip_tags(addslashes(trim($post["lng_proxma_usuario"])));
		$post["fonte"] = strip_tags(addslashes(trim($post["fonte"])));
	
		return $post;		
	}

	static function formBgdItinerario($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["fk_bgd_itinerario_oficial_de_rota_id"] = strip_tags(addslashes(trim($post["fk_bgd_itinerario_oficial_de_rota_id"])));
		$post["fk_bgd_ponto_tracado_trajeto_id"] = strip_tags(addslashes(trim($post["fk_bgd_ponto_tracado_trajeto_id"])));
	
		return $post;		
	}

	static function formBgdItinerarioOficialDeRota($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["data_captura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data_captura"]))));
		$post["fk_bgd_cidade"] = strip_tags(addslashes(trim($post["fk_bgd_cidade"])));
		$post["fk_bgd_cidade_prox_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_cidade_prox_usuario"])));
		$post["fk_bgd_linha"] = strip_tags(addslashes(trim($post["fk_bgd_linha"])));
		$post["fk_bgd_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_usuario"])));
		$post["lat_proxma_usuario"] = strip_tags(addslashes(trim($post["lat_proxma_usuario"])));
		$post["lng_proxma_usuario"] = strip_tags(addslashes(trim($post["lng_proxma_usuario"])));
		$post["fonte"] = strip_tags(addslashes(trim($post["fonte"])));
	
		return $post;		
	}

	static function formBgdLinha($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["id"] = strip_tags(addslashes(trim($post["id"])));
		$post["codigo"] = strip_tags(addslashes(trim($post["codigo"])));
		$post["comentario"] = strip_tags(addslashes(trim($post["comentario"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
	
		return $post;		
	}

	static function formBgdMapaDeConsultas($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["data_captura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data_captura"]))));
		$post["latDestino"] = strip_tags(addslashes(trim($post["latDestino"])));
		$post["latOrigem"] = strip_tags(addslashes(trim($post["latOrigem"])));
		$post["lngDestino"] = strip_tags(addslashes(trim($post["lngDestino"])));
		$post["lngOrigem"] = strip_tags(addslashes(trim($post["lngOrigem"])));
		$post["fk_bgd_cidade"] = strip_tags(addslashes(trim($post["fk_bgd_cidade"])));
		$post["fk_bgd_cidade_prox_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_cidade_prox_usuario"])));
		$post["lat_proxma_usuario"] = strip_tags(addslashes(trim($post["lat_proxma_usuario"])));
		$post["lng_proxma_usuario"] = strip_tags(addslashes(trim($post["lng_proxma_usuario"])));
		$post["fonte"] = strip_tags(addslashes(trim($post["fonte"])));
	
		return $post;		
	}

	static function formBgdOrigemAcesso($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["data_captura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data_captura"]))));
		$post["lat_proxma_usuario"] = strip_tags(addslashes(trim($post["lat_proxma_usuario"])));
		$post["lng_proxma_usuario"] = strip_tags(addslashes(trim($post["lng_proxma_usuario"])));
		$post["origem_acesso"] = strip_tags(addslashes(trim($post["origem_acesso"])));
		$post["fk_bgd_cidade_prox_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_cidade_prox_usuario"])));
		$post["fonte"] = strip_tags(addslashes(trim($post["fonte"])));
	
		return $post;		
	}

	static function formBgdParada($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["id"] = strip_tags(addslashes(trim($post["id"])));
		$post["comments"] = strip_tags(addslashes(trim($post["comments"])));
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
		$post["title"] = strip_tags(addslashes(trim($post["title"])));
	
		return $post;		
	}

	static function formBgdPontoTracadoTrajeto($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
		$post["posicao"] = strip_tags(addslashes(trim($post["posicao"])));
		$post["tipo"] = strip_tags(addslashes(trim($post["tipo"])));
		$post["fk_bgd_linha"] = strip_tags(addslashes(trim($post["fk_bgd_linha"])));
	
		return $post;		
	}

	static function formBgdRequisicaoInfoParada($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["commentsParada"] = strip_tags(addslashes(trim($post["commentsParada"])));
		$post["data_captura"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data_captura"]))));
		$post["titleParada"] = strip_tags(addslashes(trim($post["titleParada"])));
		$post["fk_bgd_cidade"] = strip_tags(addslashes(trim($post["fk_bgd_cidade"])));
		$post["fk_bgd_cidade_prox_usuario"] = strip_tags(addslashes(trim($post["fk_bgd_cidade_prox_usuario"])));
		$post["fk_bgd_parada"] = strip_tags(addslashes(trim($post["fk_bgd_parada"])));
		$post["lat_proxma_usuario"] = strip_tags(addslashes(trim($post["lat_proxma_usuario"])));
		$post["lng_proxma_usuario"] = strip_tags(addslashes(trim($post["lng_proxma_usuario"])));
		$post["fonte"] = strip_tags(addslashes(trim($post["fonte"])));
	
		return $post;		
	}

	static function formBgdUsuario($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["id"] = strip_tags(addslashes(trim($post["id"])));
		$post["email"] = strip_tags(addslashes(trim($post["email"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
	
		return $post;		
	}

	static function formCadastrodeparadas($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cont"] = strip_tags(addslashes(trim($post["cont"])));
		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formCheckIn($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["posicaoAtual"] = strip_tags(addslashes(trim($post["posicaoAtual"])));
		$post["linha_id"] = strip_tags(addslashes(trim($post["linha_id"])));
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
	
		return $post;		
	}

	static function formCidade($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["estado_id"] = strip_tags(addslashes(trim($post["estado_id"])));
		$post["belongsTo_id"] = strip_tags(addslashes(trim($post["belongsTo_id"])));
		$post["sameAs"] = strip_tags(addslashes(trim($post["sameAs"])));
		$post["latitudeDouble"] = strip_tags(addslashes(trim($post["latitudeDouble"])));
		$post["longitudeDouble"] = strip_tags(addslashes(trim($post["longitudeDouble"])));
	
		return $post;		
	}

	static function formClicknasparadas($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cont"] = strip_tags(addslashes(trim($post["cont"])));
		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formCompartilhamento($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cont"] = strip_tags(addslashes(trim($post["cont"])));
		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formConsultanatelainicial($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cont"] = strip_tags(addslashes(trim($post["cont"])));
		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formConsultanatelaveropeso($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cont"] = strip_tags(addslashes(trim($post["cont"])));
		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formConsultanatelavisualizarrota($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cont"] = strip_tags(addslashes(trim($post["cont"])));
		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formConsultasnatelainicialandroid($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["contador"] = strip_tags(addslashes(trim($post["contador"])));
		$post["idAndroid"] = strip_tags(addslashes(trim($post["idAndroid"])));
	
		return $post;		
	}

	static function formConsultasnatelavisualizarrotaandroid($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["contador"] = strip_tags(addslashes(trim($post["contador"])));
		$post["idAndroid"] = strip_tags(addslashes(trim($post["idAndroid"])));
	
		return $post;		
	}

	static function formCoordenada($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
		$post["trechoComentario_id"] = strip_tags(addslashes(trim($post["trechoComentario_id"])));
	
		return $post;		
	}

	static function formEdicaodeparadas($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cont"] = strip_tags(addslashes(trim($post["cont"])));
		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formEstado($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["uf"] = strip_tags(addslashes(trim($post["uf"])));
		$post["pais_id"] = strip_tags(addslashes(trim($post["pais_id"])));
	
		return $post;		
	}

	static function formHibernateSequence($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["next_val"] = strip_tags(addslashes(trim($post["next_val"])));
	
		return $post;		
	}

	static function formIndicador($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
	
		return $post;		
	}

	static function formLinha($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["codigo"] = strip_tags(addslashes(trim($post["codigo"])));
		$post["emAvaliacao"] = strip_tags(addslashes(trim($post["emAvaliacao"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["usuario_id"] = strip_tags(addslashes(trim($post["usuario_id"])));
		$post["sincronizacaoCodigo"] = strip_tags(addslashes(trim($post["sincronizacaoCodigo"])));
		$post["tipo"] = strip_tags(addslashes(trim($post["tipo"])));
		$post["comentario"] = strip_tags(addslashes(trim($post["comentario"])));
		$post["completa"] = strip_tags(addslashes(trim($post["completa"])));
		$post["faltaCadastrarPontosPesquisa"] = strip_tags(addslashes(trim($post["faltaCadastrarPontosPesquisa"])));
		$post["url"] = strip_tags(addslashes(trim($post["url"])));
		$post["cidade_id"] = strip_tags(addslashes(trim($post["cidade_id"])));
		$post["tipoDeRota"] = strip_tags(addslashes(trim($post["tipoDeRota"])));
		$post["itinerarioTotalEncoding"] = strip_tags(addslashes(trim($post["itinerarioTotalEncoding"])));
		$post["lastUpdate"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["lastUpdate"]))));
		$post["semob"] = strip_tags(addslashes(trim($post["semob"])));
		$post["root"] = strip_tags(addslashes(trim($post["root"])));
	
		return $post;		
	}

	static function formLogVoicer($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["compreendido"] = strip_tags(addslashes(trim($post["compreendido"])));
		$post["idUsuario"] = strip_tags(addslashes(trim($post["idUsuario"])));
		$post["menuAtual"] = strip_tags(addslashes(trim($post["menuAtual"])));
		$post["momento"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["momento"]))));
		$post["resultado"] = strip_tags(addslashes(trim($post["resultado"])));
	
		return $post;		
	}

	static function formMapaDeConsultas($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["latDestino"] = strip_tags(addslashes(trim($post["latDestino"])));
		$post["latOrigem"] = strip_tags(addslashes(trim($post["latOrigem"])));
		$post["lngDestino"] = strip_tags(addslashes(trim($post["lngDestino"])));
		$post["lngOrigem"] = strip_tags(addslashes(trim($post["lngOrigem"])));
		$post["dataBusca"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataBusca"]))));
		$post["cidade_id"] = strip_tags(addslashes(trim($post["cidade_id"])));
	
		return $post;		
	}

	static function formPais($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["sigla"] = strip_tags(addslashes(trim($post["sigla"])));
	
		return $post;		
	}

	static function formParada($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
		$post["comments"] = strip_tags(addslashes(trim($post["comments"])));
		$post["title"] = strip_tags(addslashes(trim($post["title"])));
		$post["tipoDeRotaDaParada"] = strip_tags(addslashes(trim($post["tipoDeRotaDaParada"])));
	
		return $post;		
	}

	static function formParadaLinha($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["paradas_id"] = strip_tags(addslashes(trim($post["paradas_id"])));
		$post["linha_id"] = strip_tags(addslashes(trim($post["linha_id"])));
	
		return $post;		
	}

	static function formPonto($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
		$post["linha_id"] = strip_tags(addslashes(trim($post["linha_id"])));
		$post["codigoAndroid"] = strip_tags(addslashes(trim($post["codigoAndroid"])));
	
		return $post;		
	}

	static function formPontopesquisa($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
		$post["posicao"] = strip_tags(addslashes(trim($post["posicao"])));
		$post["tipo"] = strip_tags(addslashes(trim($post["tipo"])));
		$post["linha_id"] = strip_tags(addslashes(trim($post["linha_id"])));
	
		return $post;		
	}

	static function formPontotracadotrajeto($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["latitude"] = strip_tags(addslashes(trim($post["latitude"])));
		$post["longitude"] = strip_tags(addslashes(trim($post["longitude"])));
		$post["posicao"] = strip_tags(addslashes(trim($post["posicao"])));
		$post["linha_id"] = strip_tags(addslashes(trim($post["linha_id"])));
		$post["tipo"] = strip_tags(addslashes(trim($post["tipo"])));
	
		return $post;		
	}

	static function formSession($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["ident"] = strip_tags(addslashes(trim($post["ident"])));
	
		return $post;		
	}

	static function formSessionIndicador($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["session_id"] = strip_tags(addslashes(trim($post["session_id"])));
		$post["indicadores_id"] = strip_tags(addslashes(trim($post["indicadores_id"])));
	
		return $post;		
	}

	static function formTrechocomentario($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["comentario"] = strip_tags(addslashes(trim($post["comentario"])));
		$post["linha_id"] = strip_tags(addslashes(trim($post["linha_id"])));
	
		return $post;		
	}

	static function formUsuario($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["email"] = strip_tags(addslashes(trim($post["email"])));
		$post["login"] = strip_tags(addslashes(trim($post["login"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["roles"] = strip_tags(addslashes(trim($post["roles"])));
		$post["senha"] = strip_tags(addslashes(trim($post["senha"])));
		$post["tos"] = strip_tags(addslashes(trim($post["tos"])));
		$post["numlogins"] = strip_tags(addslashes(trim($post["numlogins"])));
		$post["numrotasvisu"] = strip_tags(addslashes(trim($post["numrotasvisu"])));
		$post["paradascriadas"] = strip_tags(addslashes(trim($post["paradascriadas"])));
		$post["paradaseditadas"] = strip_tags(addslashes(trim($post["paradaseditadas"])));
		$post["rotascriadas"] = strip_tags(addslashes(trim($post["rotascriadas"])));
		$post["rotaseditadas"] = strip_tags(addslashes(trim($post["rotaseditadas"])));
		$post["totalpontos"] = strip_tags(addslashes(trim($post["totalpontos"])));
		$post["nivel"] = strip_tags(addslashes(trim($post["nivel"])));
		$post["insig1"] = strip_tags(addslashes(trim($post["insig1"])));
		$post["insig2"] = strip_tags(addslashes(trim($post["insig2"])));
		$post["insig3"] = strip_tags(addslashes(trim($post["insig3"])));
		$post["insig4"] = strip_tags(addslashes(trim($post["insig4"])));
	
		return $post;		
	}

}
