<?php
class CheckInMAP {
	static function getMetaData() {
		return ['check_in' => ['id', 
						'posicaoAtual', 
						'linha_id', 
						'latitude', 
						'longitude'], 
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

	static function objToRs($oCheckIn){
		$reg['id'] = $oCheckIn->id;
		$reg['posicaoAtual'] = $oCheckIn->posicaoAtual;
		$oLinha = $oCheckIn->oLinha;
		$reg['linha_id'] = $oLinha->id;
		$reg['latitude'] = $oCheckIn->latitude;
		$reg['longitude'] = $oCheckIn->longitude;
		return $reg;		   
	}

	static function objToRsInsert($oCheckIn){
		$reg['posicaoAtual'] = $oCheckIn->posicaoAtual;
		$oLinha = $oCheckIn->oLinha;
		$reg['linha_id'] = $oLinha->id;
		$reg['latitude'] = $oCheckIn->latitude;
		$reg['longitude'] = $oCheckIn->longitude;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCheckIn = new CheckIn();
		$oCheckIn->id = $reg['check_in_id'];
		$oCheckIn->posicaoAtual = $reg['check_in_posicaoAtual'];

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
		$oCheckIn->oLinha = $oLinha;
		$oCheckIn->latitude = $reg['check_in_latitude'];
		$oCheckIn->longitude = $reg['check_in_longitude'];
		return $oCheckIn;		   
	}
}
