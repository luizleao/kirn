<?php
class BgdPontoTracadoTrajetoMAP {
	static function getMetaData() {
		return ['bgd_ponto_tracado_trajeto' => ['id', 
						'latitude', 
						'longitude', 
						'posicao', 
						'tipo', 
						'fk_bgd_linha'], 
				'bgd_linha' => [						'id', 
						'codigo', 
						'comentario', 
						'nome']];
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

	static function objToRs($oBgdPontoTracadoTrajeto){
		$reg['id'] = $oBgdPontoTracadoTrajeto->id;
		$reg['latitude'] = $oBgdPontoTracadoTrajeto->latitude;
		$reg['longitude'] = $oBgdPontoTracadoTrajeto->longitude;
		$reg['posicao'] = $oBgdPontoTracadoTrajeto->posicao;
		$reg['tipo'] = $oBgdPontoTracadoTrajeto->tipo;
		$oBgdLinha = $oBgdPontoTracadoTrajeto->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		return $reg;		   
	}

	static function objToRsInsert($oBgdPontoTracadoTrajeto){
		$reg['latitude'] = $oBgdPontoTracadoTrajeto->latitude;
		$reg['longitude'] = $oBgdPontoTracadoTrajeto->longitude;
		$reg['posicao'] = $oBgdPontoTracadoTrajeto->posicao;
		$reg['tipo'] = $oBgdPontoTracadoTrajeto->tipo;
		$oBgdLinha = $oBgdPontoTracadoTrajeto->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdPontoTracadoTrajeto = new BgdPontoTracadoTrajeto();
		$oBgdPontoTracadoTrajeto->id = $reg['bgd_ponto_tracado_trajeto_id'];
		$oBgdPontoTracadoTrajeto->latitude = $reg['bgd_ponto_tracado_trajeto_latitude'];
		$oBgdPontoTracadoTrajeto->longitude = $reg['bgd_ponto_tracado_trajeto_longitude'];
		$oBgdPontoTracadoTrajeto->posicao = $reg['bgd_ponto_tracado_trajeto_posicao'];
		$oBgdPontoTracadoTrajeto->tipo = $reg['bgd_ponto_tracado_trajeto_tipo'];

		$oBgdLinha = new BgdLinha();
		$oBgdLinha->id = $reg['bgd_linha_id'];
		$oBgdLinha->codigo = $reg['bgd_linha_codigo'];
		$oBgdLinha->comentario = $reg['bgd_linha_comentario'];
		$oBgdLinha->nome = $reg['bgd_linha_nome'];
		$oBgdPontoTracadoTrajeto->oBgdLinha = $oBgdLinha;
		return $oBgdPontoTracadoTrajeto;		   
	}
}
