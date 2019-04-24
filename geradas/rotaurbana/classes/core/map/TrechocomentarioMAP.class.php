<?php
class TrechocomentarioMAP {
	static function getMetaData() {
		return ['trechocomentario' => ['id', 
						'comentario', 
						'linha_id'], 
				'linha' => [						'id', 
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
						'root']];
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

	static function objToRs($oTrechocomentario){
		$reg['id'] = $oTrechocomentario->id;
		$reg['comentario'] = $oTrechocomentario->comentario;
		$oLinha = $oTrechocomentario->oLinha;
		$reg['linha_id'] = $oLinha->id;
		return $reg;		   
	}

	static function objToRsInsert($oTrechocomentario){
		$reg['comentario'] = $oTrechocomentario->comentario;
		$oLinha = $oTrechocomentario->oLinha;
		$reg['linha_id'] = $oLinha->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oTrechocomentario = new Trechocomentario();
		$oTrechocomentario->id = $reg['trechocomentario_id'];
		$oTrechocomentario->comentario = $reg['trechocomentario_comentario'];

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
		$oTrechocomentario->oLinha = $oLinha;
		return $oTrechocomentario;		   
	}
}
