<?php
class ValidadorFormulario {
	
	public $msg;
	
	function __construct($msg = NULL){
		$this->msg = $msg;
	}

	function validaFormAcesso(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($ip == ''){
			$this->msg = "Ip inválido!";
			return false;
		}	
		if($acao == 2){
			if($id == ''){
				$this->msg = "Indicador inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormAcessoSession(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acesso_id == ''){
			$this->msg = "Acesso inválido!";
			return false;
		}	
		if($acao == 2){
			if($sessions_id == ''){
				$this->msg = "Sessions_id inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormBgdCidade(&$post, $acao=''){
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

	function validaFormBgdDistanciaRotaConsulta(&$post, $acao=''){
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
		if($data_captura == ''){
			$this->msg = "Data_captura inválido!";
			return false;
		}	
		if($distancia == ''){
			$this->msg = "Distancia inválido!";
			return false;
		}	
		if($fk_bgd_cidade == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_linha == ''){
			$this->msg = "Bgd_linha inválido!";
			return false;
		}	
		if($fonte == ''){
			$this->msg = "Fonte inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdDistanciaRotaSelecionada(&$post, $acao=''){
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
		if($data_captura == ''){
			$this->msg = "Data_captura inválido!";
			return false;
		}	
		if($distancia == ''){
			$this->msg = "Distancia inválido!";
			return false;
		}	
		if($fk_bgd_cidade == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_cidade_prox_usuario == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_linha == ''){
			$this->msg = "Bgd_linha inválido!";
			return false;
		}	
		if($lat_proxma_usuario == ''){
			$this->msg = "Lat_proxma_usuario inválido!";
			return false;
		}	
		if($lng_proxma_usuario == ''){
			$this->msg = "Lng_proxma_usuario inválido!";
			return false;
		}	
		if($fonte == ''){
			$this->msg = "Fonte inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdEdicaoParada(&$post, $acao=''){
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
		if($commentsParada == ''){
			$this->msg = "CommentsParada inválido!";
			return false;
		}	
		if($data_captura == ''){
			$this->msg = "Data_captura inválido!";
			return false;
		}	
		if($titleParada == ''){
			$this->msg = "TitleParada inválido!";
			return false;
		}	
		if($bgd_cidade == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_cidade_prox_usuario == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_parada == ''){
			$this->msg = "Bgd_parada inválido!";
			return false;
		}	
		if($lat_proxma_usuario == ''){
			$this->msg = "Lat_proxma_usuario inválido!";
			return false;
		}	
		if($lng_proxma_usuario == ''){
			$this->msg = "Lng_proxma_usuario inválido!";
			return false;
		}	
		if($fonte == ''){
			$this->msg = "Fonte inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdEdicaoRotas(&$post, $acao=''){
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
		if($codigoLinha == ''){
			$this->msg = "CodigoLinha inválido!";
			return false;
		}	
		if($comentarioLinha == ''){
			$this->msg = "ComentarioLinha inválido!";
			return false;
		}	
		if($data_captura == ''){
			$this->msg = "Data_captura inválido!";
			return false;
		}	
		if($nomeLinhas == ''){
			$this->msg = "NomeLinhas inválido!";
			return false;
		}	
		if($fk_bgd_cidade == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_cidade_prox_usuario == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_linha == ''){
			$this->msg = "Bgd_linha inválido!";
			return false;
		}	
		if($fk_bgd_usuario == ''){
			$this->msg = "Bgd_usuario inválido!";
			return false;
		}	
		if($lat_proxma_usuario == ''){
			$this->msg = "Lat_proxma_usuario inválido!";
			return false;
		}	
		if($lng_proxma_usuario == ''){
			$this->msg = "Lng_proxma_usuario inválido!";
			return false;
		}	
		if($fonte == ''){
			$this->msg = "Fonte inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdItinerario(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($fk_bgd_itinerario_oficial_de_rota_id == ''){
				$this->msg = "Bgd_itinerario_oficial_de_rota inválido!";
				return false;
			}
		}
		if($acao == 2){
			if($fk_bgd_ponto_tracado_trajeto_id == ''){
				$this->msg = "Fk_bgd_ponto_tracado_trajeto_id inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormBgdItinerarioOficialDeRota(&$post, $acao=''){
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
		if($data_captura == ''){
			$this->msg = "Data_captura inválido!";
			return false;
		}	
		if($fk_bgd_cidade == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_cidade_prox_usuario == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_linha == ''){
			$this->msg = "Bgd_linha inválido!";
			return false;
		}	
		if($fk_bgd_usuario == ''){
			$this->msg = "Bgd_usuario inválido!";
			return false;
		}	
		if($lat_proxma_usuario == ''){
			$this->msg = "Lat_proxma_usuario inválido!";
			return false;
		}	
		if($lng_proxma_usuario == ''){
			$this->msg = "Lng_proxma_usuario inválido!";
			return false;
		}	
		if($fonte == ''){
			$this->msg = "Fonte inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdLinha(&$post, $acao=''){
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
		if($codigo == ''){
			$this->msg = "Codigo inválido!";
			return false;
		}	
		if($comentario == ''){
			$this->msg = "Comentario inválido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdMapaDeConsultas(&$post, $acao=''){
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
		if($data_captura == ''){
			$this->msg = "Data_captura inválido!";
			return false;
		}	
		if($latDestino == ''){
			$this->msg = "LatDestino inválido!";
			return false;
		}	
		if($latOrigem == ''){
			$this->msg = "LatOrigem inválido!";
			return false;
		}	
		if($lngDestino == ''){
			$this->msg = "LngDestino inválido!";
			return false;
		}	
		if($lngOrigem == ''){
			$this->msg = "LngOrigem inválido!";
			return false;
		}	
		if($fk_bgd_cidade == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_cidade_prox_usuario == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($lat_proxma_usuario == ''){
			$this->msg = "Lat_proxma_usuario inválido!";
			return false;
		}	
		if($lng_proxma_usuario == ''){
			$this->msg = "Lng_proxma_usuario inválido!";
			return false;
		}	
		if($fonte == ''){
			$this->msg = "Fonte inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdOrigemAcesso(&$post, $acao=''){
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
		if($data_captura == ''){
			$this->msg = "Data_captura inválido!";
			return false;
		}	
		if($lat_proxma_usuario == ''){
			$this->msg = "Lat_proxma_usuario inválido!";
			return false;
		}	
		if($lng_proxma_usuario == ''){
			$this->msg = "Lng_proxma_usuario inválido!";
			return false;
		}	
		if($origem_acesso == ''){
			$this->msg = "Origem_acesso inválido!";
			return false;
		}	
		if($fk_bgd_cidade_prox_usuario == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fonte == ''){
			$this->msg = "Fonte inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdParada(&$post, $acao=''){
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
		if($comments == ''){
			$this->msg = "Comments inválido!";
			return false;
		}	
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		if($title == ''){
			$this->msg = "Title inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdPontoTracadoTrajeto(&$post, $acao=''){
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
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		if($posicao == ''){
			$this->msg = "Posicao inválido!";
			return false;
		}	
		if($tipo == ''){
			$this->msg = "Tipo inválido!";
			return false;
		}	
		if($fk_bgd_linha == ''){
			$this->msg = "Bgd_linha inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdRequisicaoInfoParada(&$post, $acao=''){
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
		if($commentsParada == ''){
			$this->msg = "CommentsParada inválido!";
			return false;
		}	
		if($data_captura == ''){
			$this->msg = "Data_captura inválido!";
			return false;
		}	
		if($titleParada == ''){
			$this->msg = "TitleParada inválido!";
			return false;
		}	
		if($fk_bgd_cidade == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_cidade_prox_usuario == ''){
			$this->msg = "Bgd_cidade inválido!";
			return false;
		}	
		if($fk_bgd_parada == ''){
			$this->msg = "Bgd_parada inválido!";
			return false;
		}	
		if($lat_proxma_usuario == ''){
			$this->msg = "Lat_proxma_usuario inválido!";
			return false;
		}	
		if($lng_proxma_usuario == ''){
			$this->msg = "Lng_proxma_usuario inválido!";
			return false;
		}	
		if($fonte == ''){
			$this->msg = "Fonte inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormBgdUsuario(&$post, $acao=''){
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
		if($email == ''){
			$this->msg = "Email inválido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormCadastrodeparadas(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($cont == ''){
			$this->msg = "Cont inválido!";
			return false;
		}	
		if($acao == 2){
			if($id == ''){
				$this->msg = "Indicador inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormCheckIn(&$post, $acao=''){
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
		if($posicaoAtual == ''){
			$this->msg = "PosicaoAtual inválido!";
			return false;
		}	
		if($linha_id == ''){
			$this->msg = "Linha inválido!";
			return false;
		}	
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormCidade(&$post, $acao=''){
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
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($estado_id == ''){
			$this->msg = "Estado inválido!";
			return false;
		}	
		if($belongsTo_id == ''){
			$this->msg = "Cidade inválido!";
			return false;
		}	
		if($sameAs == ''){
			$this->msg = "SameAs inválido!";
			return false;
		}	
		if($latitudeDouble == ''){
			$this->msg = "LatitudeDouble inválido!";
			return false;
		}	
		if($longitudeDouble == ''){
			$this->msg = "LongitudeDouble inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormClicknasparadas(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($cont == ''){
			$this->msg = "Cont inválido!";
			return false;
		}	
		if($acao == 2){
			if($id == ''){
				$this->msg = "Indicador inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormCompartilhamento(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($cont == ''){
			$this->msg = "Cont inválido!";
			return false;
		}	
		if($acao == 2){
			if($id == ''){
				$this->msg = "Indicador inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormConsultanatelainicial(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($cont == ''){
			$this->msg = "Cont inválido!";
			return false;
		}	
		if($acao == 2){
			if($id == ''){
				$this->msg = "Indicador inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormConsultanatelaveropeso(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($cont == ''){
			$this->msg = "Cont inválido!";
			return false;
		}	
		if($acao == 2){
			if($id == ''){
				$this->msg = "Indicador inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormConsultanatelavisualizarrota(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($cont == ''){
			$this->msg = "Cont inválido!";
			return false;
		}	
		if($acao == 2){
			if($id == ''){
				$this->msg = "Indicador inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormConsultasnatelainicialandroid(&$post, $acao=''){
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
		if($contador == ''){
			$this->msg = "Contador inválido!";
			return false;
		}	
		if($idAndroid == ''){
			$this->msg = "IdAndroid inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormConsultasnatelavisualizarrotaandroid(&$post, $acao=''){
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
		if($contador == ''){
			$this->msg = "Contador inválido!";
			return false;
		}	
		if($idAndroid == ''){
			$this->msg = "IdAndroid inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormCoordenada(&$post, $acao=''){
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
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		if($trechoComentario_id == ''){
			$this->msg = "Trechocomentario inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormEdicaodeparadas(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($cont == ''){
			$this->msg = "Cont inválido!";
			return false;
		}	
		if($acao == 2){
			if($id == ''){
				$this->msg = "Indicador inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormEstado(&$post, $acao=''){
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
		if($uf == ''){
			$this->msg = "Uf inválido!";
			return false;
		}	
		if($pais_id == ''){
			$this->msg = "Pais inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormHibernateSequence(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($next_val == ''){
			$this->msg = "Next_val inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormIndicador(&$post, $acao=''){
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

	function validaFormLinha(&$post, $acao=''){
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
		if($codigo == ''){
			$this->msg = "Codigo inválido!";
			return false;
		}	
		if($emAvaliacao == ''){
			$this->msg = "EmAvaliacao inválido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($usuario_id == ''){
			$this->msg = "Usuario inválido!";
			return false;
		}	
		if($sincronizacaoCodigo == ''){
			$this->msg = "SincronizacaoCodigo inválido!";
			return false;
		}	
		if($tipo == ''){
			$this->msg = "Tipo inválido!";
			return false;
		}	
		if($comentario == ''){
			$this->msg = "Comentario inválido!";
			return false;
		}	
		if($completa == ''){
			$this->msg = "Completa inválido!";
			return false;
		}	
		if($faltaCadastrarPontosPesquisa == ''){
			$this->msg = "FaltaCadastrarPontosPesquisa inválido!";
			return false;
		}	
		if($url == ''){
			$this->msg = "Url inválido!";
			return false;
		}	
		if($cidade_id == ''){
			$this->msg = "Cidade inválido!";
			return false;
		}	
		if($tipoDeRota == ''){
			$this->msg = "TipoDeRota inválido!";
			return false;
		}	
		if($itinerarioTotalEncoding == ''){
			$this->msg = "ItinerarioTotalEncoding inválido!";
			return false;
		}	
		if($lastUpdate == ''){
			$this->msg = "LastUpdate inválido!";
			return false;
		}	
		if($semob == ''){
			$this->msg = "Semob inválido!";
			return false;
		}	
		if($root == ''){
			$this->msg = "Linha inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormLogVoicer(&$post, $acao=''){
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
		if($compreendido == ''){
			$this->msg = "Compreendido inválido!";
			return false;
		}	
		if($idUsuario == ''){
			$this->msg = "IdUsuario inválido!";
			return false;
		}	
		if($menuAtual == ''){
			$this->msg = "MenuAtual inválido!";
			return false;
		}	
		if($momento == ''){
			$this->msg = "Momento inválido!";
			return false;
		}	
		if($resultado == ''){
			$this->msg = "Resultado inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormMapaDeConsultas(&$post, $acao=''){
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
		if($latDestino == ''){
			$this->msg = "LatDestino inválido!";
			return false;
		}	
		if($latOrigem == ''){
			$this->msg = "LatOrigem inválido!";
			return false;
		}	
		if($lngDestino == ''){
			$this->msg = "LngDestino inválido!";
			return false;
		}	
		if($lngOrigem == ''){
			$this->msg = "LngOrigem inválido!";
			return false;
		}	
		if($dataBusca == ''){
			$this->msg = "DataBusca inválido!";
			return false;
		}	
		if($cidade_id == ''){
			$this->msg = "Cidade inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPais(&$post, $acao=''){
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

	function validaFormParada(&$post, $acao=''){
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
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		if($comments == ''){
			$this->msg = "Comments inválido!";
			return false;
		}	
		if($title == ''){
			$this->msg = "Title inválido!";
			return false;
		}	
		if($tipoDeRotaDaParada == ''){
			$this->msg = "TipoDeRotaDa inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormParadaLinha(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($paradas_id == ''){
			$this->msg = "Paradas_id inválido!";
			return false;
		}	
		if($linha_id == ''){
			$this->msg = "Linha_id inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPonto(&$post, $acao=''){
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
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		if($linha_id == ''){
			$this->msg = "Linha_id inválido!";
			return false;
		}	
		if($codigoAndroid == ''){
			$this->msg = "CodigoAndroid inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPontopesquisa(&$post, $acao=''){
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
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		if($posicao == ''){
			$this->msg = "Posicao inválido!";
			return false;
		}	
		if($tipo == ''){
			$this->msg = "Tipo inválido!";
			return false;
		}	
		if($linha_id == ''){
			$this->msg = "Linha inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPontotracadotrajeto(&$post, $acao=''){
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
		if($latitude == ''){
			$this->msg = "Latitude inválido!";
			return false;
		}	
		if($longitude == ''){
			$this->msg = "Longitude inválido!";
			return false;
		}	
		if($posicao == ''){
			$this->msg = "Posicao inválido!";
			return false;
		}	
		if($linha_id == ''){
			$this->msg = "Linha_id inválido!";
			return false;
		}	
		if($tipo == ''){
			$this->msg = "Tipo inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormSession(&$post, $acao=''){
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
		if($ident == ''){
			$this->msg = "Ident inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormSessionIndicador(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($session_id == ''){
			$this->msg = "Session inválido!";
			return false;
		}	
		if($acao == 2){
			if($indicadores_id == ''){
				$this->msg = "Indicadores_id inválido!";
				return false;
			}
		}
		*/
		return true;		
	}

	function validaFormTrechocomentario(&$post, $acao=''){
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
		if($comentario == ''){
			$this->msg = "Comentario inválido!";
			return false;
		}	
		if($linha_id == ''){
			$this->msg = "Linha inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormUsuario(&$post, $acao=''){
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
		if($email == ''){
			$this->msg = "Email inválido!";
			return false;
		}	
		if($login == ''){
			$this->msg = "Login inválido!";
			return false;
		}	
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($roles == ''){
			$this->msg = "Roles inválido!";
			return false;
		}	
		if($senha == ''){
			$this->msg = "Senha inválido!";
			return false;
		}	
		if($tos == ''){
			$this->msg = "Tos inválido!";
			return false;
		}	
		if($numlogins == ''){
			$this->msg = "Numlogins inválido!";
			return false;
		}	
		if($numrotasvisu == ''){
			$this->msg = "Numrotasvisu inválido!";
			return false;
		}	
		if($paradascriadas == ''){
			$this->msg = "Paradascriadas inválido!";
			return false;
		}	
		if($paradaseditadas == ''){
			$this->msg = "Paradaseditadas inválido!";
			return false;
		}	
		if($rotascriadas == ''){
			$this->msg = "Rotascriadas inválido!";
			return false;
		}	
		if($rotaseditadas == ''){
			$this->msg = "Rotaseditadas inválido!";
			return false;
		}	
		if($totalpontos == ''){
			$this->msg = "Totalpontos inválido!";
			return false;
		}	
		if($nivel == ''){
			$this->msg = "Nivel inválido!";
			return false;
		}	
		if($insig1 == ''){
			$this->msg = "Insig1 inválido!";
			return false;
		}	
		if($insig2 == ''){
			$this->msg = "Insig2 inválido!";
			return false;
		}	
		if($insig3 == ''){
			$this->msg = "Insig3 inválido!";
			return false;
		}	
		if($insig4 == ''){
			$this->msg = "Insig4 inválido!";
			return false;
		}	
		*/
		return true;		
	}

}