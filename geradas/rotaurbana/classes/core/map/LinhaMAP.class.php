<?php
class LinhaMAP {
	static function getMetaData() {
		return ['linha' => ['id', 
						'codigo', 
						'emAvaliacao', 
						'nome', 
						'usuario_id', 
						'sincronizacaoCodigo', 
						'tipo', 
						'comentario', 
						'completa', 
						'faltaCadastrarPontosPesquisa', 
						'url', 
						'cidade_id', 
						'tipoDeRota', 
						'itinerarioTotalEncoding', 
						'lastUpdate', 
						'semob', 
						'root'], 
				'usuario' => [						'id', 
						'email', 
						'login', 
						'nome', 
						'roles', 
						'senha', 
						'tos', 
						'numlogins', 
						'numrotasvisu', 
						'paradascriadas', 
						'paradaseditadas', 
						'rotascriadas', 
						'rotaseditadas', 
						'totalpontos', 
						'nivel', 
						'insig1', 
						'insig2', 
						'insig3', 
						'insig4'], 
				'cidade' => [						'id', 
						'latitude', 
						'longitude', 
						'nome', 
						'estado_id', 
						'belongsTo_id', 
						'sameAs', 
						'latitudeDouble', 
						'longitudeDouble']];
	}

	static function dataToSelect() {
        foreach(self::getMetaData() as $tabela => $aCampo){
            foreach($aCampo as $sCampo){
                $aux[] = "$tabela.$sCampo as $tabela"."_$sCampo";
            }
        }
        
        return implode(",\n", $aux);
    }
    
    static function filterLike($valor) {
        foreach(self::getMetaData() as $tabela => $aCampo){
            foreach($aCampo as $sCampo){
                $aux[] = "$tabela.$sCampo like '$valor'";
            }
        }
        
        return implode("\nor ", $aux);
    }

	static function objToRs($oLinha){
		$reg['id'] = $oLinha->id;
		$reg['codigo'] = $oLinha->codigo;
		$reg['emAvaliacao'] = $oLinha->emAvaliacao;
		$reg['nome'] = $oLinha->nome;
		$oUsuario = $oLinha->oUsuario;
		$reg['usuario_id'] = $oUsuario->id;
		$reg['sincronizacaoCodigo'] = $oLinha->sincronizacaoCodigo;
		$reg['tipo'] = $oLinha->tipo;
		$reg['comentario'] = $oLinha->comentario;
		$reg['completa'] = $oLinha->completa;
		$reg['faltaCadastrarPontosPesquisa'] = $oLinha->faltaCadastrarPontosPesquisa;
		$reg['url'] = $oLinha->url;
		$oCidade = $oLinha->oCidade;
		$reg['cidade_id'] = $oCidade->id;
		$reg['tipoDeRota'] = $oLinha->tipoDeRota;
		$reg['itinerarioTotalEncoding'] = $oLinha->itinerarioTotalEncoding;
		$reg['lastUpdate'] = $oLinha->lastUpdate;
		$reg['semob'] = $oLinha->semob;
		$oLinha = $oLinha->oLinha;
		$reg['root'] = $oLinha->id;
		return $reg;		   
	}

	static function objToRsInsert($oLinha){
		$reg['codigo'] = $oLinha->codigo;
		$reg['emAvaliacao'] = $oLinha->emAvaliacao;
		$reg['nome'] = $oLinha->nome;
		$oUsuario = $oLinha->oUsuario;
		$reg['usuario_id'] = $oUsuario->id;
		$reg['sincronizacaoCodigo'] = $oLinha->sincronizacaoCodigo;
		$reg['tipo'] = $oLinha->tipo;
		$reg['comentario'] = $oLinha->comentario;
		$reg['completa'] = $oLinha->completa;
		$reg['faltaCadastrarPontosPesquisa'] = $oLinha->faltaCadastrarPontosPesquisa;
		$reg['url'] = $oLinha->url;
		$oCidade = $oLinha->oCidade;
		$reg['cidade_id'] = $oCidade->id;
		$reg['tipoDeRota'] = $oLinha->tipoDeRota;
		$reg['itinerarioTotalEncoding'] = $oLinha->itinerarioTotalEncoding;
		$reg['lastUpdate'] = $oLinha->lastUpdate;
		$reg['semob'] = $oLinha->semob;
		$oLinha = $oLinha->oLinha;
		$reg['root'] = $oLinha->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oLinha = new Linha();
		$oLinha->id = $reg['linha_id'];
		$oLinha->codigo = $reg['linha_codigo'];
		$oLinha->emAvaliacao = $reg['linha_emAvaliacao'];
		$oLinha->nome = $reg['linha_nome'];

		$oUsuario = new Usuario();
		$oUsuario->id = $reg['usuario_id'];
		$oUsuario->email = $reg['usuario_email'];
		$oUsuario->login = $reg['usuario_login'];
		$oUsuario->nome = $reg['usuario_nome'];
		$oUsuario->roles = $reg['usuario_roles'];
		$oUsuario->senha = $reg['usuario_senha'];
		$oUsuario->tos = $reg['usuario_tos'];
		$oUsuario->numlogins = $reg['usuario_numlogins'];
		$oUsuario->numrotasvisu = $reg['usuario_numrotasvisu'];
		$oUsuario->paradascriadas = $reg['usuario_paradascriadas'];
		$oUsuario->paradaseditadas = $reg['usuario_paradaseditadas'];
		$oUsuario->rotascriadas = $reg['usuario_rotascriadas'];
		$oUsuario->rotaseditadas = $reg['usuario_rotaseditadas'];
		$oUsuario->totalpontos = $reg['usuario_totalpontos'];
		$oUsuario->nivel = $reg['usuario_nivel'];
		$oUsuario->insig1 = $reg['usuario_insig1'];
		$oUsuario->insig2 = $reg['usuario_insig2'];
		$oUsuario->insig3 = $reg['usuario_insig3'];
		$oUsuario->insig4 = $reg['usuario_insig4'];
		$oLinha->oUsuario = $oUsuario;
		$oLinha->sincronizacaoCodigo = $reg['linha_sincronizacaoCodigo'];
		$oLinha->tipo = $reg['linha_tipo'];
		$oLinha->comentario = $reg['linha_comentario'];
		$oLinha->completa = $reg['linha_completa'];
		$oLinha->faltaCadastrarPontosPesquisa = $reg['linha_faltaCadastrarPontosPesquisa'];
		$oLinha->url = $reg['linha_url'];

		$oCidade = new Cidade();
		$oCidade->id = $reg['cidade_id'];
		$oCidade->latitude = $reg['cidade_latitude'];
		$oCidade->longitude = $reg['cidade_longitude'];
		$oCidade->nome = $reg['cidade_nome'];
		$oCidade->sameAs = $reg['cidade_sameAs'];
		$oCidade->latitudeDouble = $reg['cidade_latitudeDouble'];
		$oCidade->longitudeDouble = $reg['cidade_longitudeDouble'];
		$oLinha->oCidade = $oCidade;
		$oLinha->tipoDeRota = $reg['linha_tipoDeRota'];
		$oLinha->itinerarioTotalEncoding = $reg['linha_itinerarioTotalEncoding'];
		$oLinha->lastUpdate = $reg['linha_lastUpdate'];
		$oLinha->semob = $reg['linha_semob'];

		$oLinha = new Linha();
		$oLinha->id = $reg['linha_id'];
		$oLinha->codigo = $reg['linha_codigo'];
		$oLinha->emAvaliacao = $reg['linha_emAvaliacao'];
		$oLinha->nome = $reg['linha_nome'];
		$oLinha->sincronizacaoCodigo = $reg['linha_sincronizacaoCodigo'];
		$oLinha->tipo = $reg['linha_tipo'];
		$oLinha->comentario = $reg['linha_comentario'];
		$oLinha->completa = $reg['linha_completa'];
		$oLinha->faltaCadastrarPontosPesquisa = $reg['linha_faltaCadastrarPontosPesquisa'];
		$oLinha->url = $reg['linha_url'];
		$oLinha->tipoDeRota = $reg['linha_tipoDeRota'];
		$oLinha->itinerarioTotalEncoding = $reg['linha_itinerarioTotalEncoding'];
		$oLinha->lastUpdate = $reg['linha_lastUpdate'];
		$oLinha->semob = $reg['linha_semob'];
		$oLinha->oLinha = $oLinha;
		return $oLinha;		   
	}
}
