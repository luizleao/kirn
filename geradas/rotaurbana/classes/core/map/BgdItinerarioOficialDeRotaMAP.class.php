<?php
class BgdItinerarioOficialDeRotaMAP {
	static function getMetaData() {
		return ['bgd_itinerario_oficial_de_rota' => ['id', 
						'data_captura', 
						'fk_bgd_cidade', 
						'fk_bgd_cidade_prox_usuario', 
						'fk_bgd_linha', 
						'fk_bgd_usuario', 
						'lat_proxma_usuario', 
						'lng_proxma_usuario', 
						'fonte'], 
				'bgd_cidade' => [						'id', 
						'nome'], 
				'bgd_linha' => [						'id', 
						'codigo', 
						'comentario', 
						'nome'], 
				'bgd_usuario' => [						'id', 
						'email', 
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

	static function objToRs($oBgdItinerarioOficialDeRota){
		$reg['id'] = $oBgdItinerarioOficialDeRota->id;
		$reg['data_captura'] = $oBgdItinerarioOficialDeRota->data_captura;
		$oBgdCidade = $oBgdItinerarioOficialDeRota->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdItinerarioOficialDeRota->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdLinha = $oBgdItinerarioOficialDeRota->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		$oBgdUsuario = $oBgdItinerarioOficialDeRota->oBgdUsuario;
		$reg['fk_bgd_usuario'] = $oBgdUsuario->id;
		$reg['lat_proxma_usuario'] = $oBgdItinerarioOficialDeRota->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdItinerarioOficialDeRota->lng_proxma_usuario;
		$reg['fonte'] = $oBgdItinerarioOficialDeRota->fonte;
		return $reg;		   
	}

	static function objToRsInsert($oBgdItinerarioOficialDeRota){
		$reg['data_captura'] = $oBgdItinerarioOficialDeRota->data_captura;
		$oBgdCidade = $oBgdItinerarioOficialDeRota->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdItinerarioOficialDeRota->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdLinha = $oBgdItinerarioOficialDeRota->oBgdLinha;
		$reg['fk_bgd_linha'] = $oBgdLinha->id;
		$oBgdUsuario = $oBgdItinerarioOficialDeRota->oBgdUsuario;
		$reg['fk_bgd_usuario'] = $oBgdUsuario->id;
		$reg['lat_proxma_usuario'] = $oBgdItinerarioOficialDeRota->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdItinerarioOficialDeRota->lng_proxma_usuario;
		$reg['fonte'] = $oBgdItinerarioOficialDeRota->fonte;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdItinerarioOficialDeRota = new BgdItinerarioOficialDeRota();
		$oBgdItinerarioOficialDeRota->id = $reg['bgd_itinerario_oficial_de_rota_id'];
		$oBgdItinerarioOficialDeRota->data_captura = $reg['bgd_itinerario_oficial_de_rota_data_captura'];

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdItinerarioOficialDeRota->oBgdCidade = $oBgdCidade;

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdItinerarioOficialDeRota->oBgdCidade = $oBgdCidade;

		$oBgdLinha = new BgdLinha();
		$oBgdLinha->id = $reg['bgd_linha_id'];
		$oBgdLinha->codigo = $reg['bgd_linha_codigo'];
		$oBgdLinha->comentario = $reg['bgd_linha_comentario'];
		$oBgdLinha->nome = $reg['bgd_linha_nome'];
		$oBgdItinerarioOficialDeRota->oBgdLinha = $oBgdLinha;

		$oBgdUsuario = new BgdUsuario();
		$oBgdUsuario->id = $reg['bgd_usuario_id'];
		$oBgdUsuario->email = $reg['bgd_usuario_email'];
		$oBgdUsuario->nome = $reg['bgd_usuario_nome'];
		$oBgdItinerarioOficialDeRota->oBgdUsuario = $oBgdUsuario;
		$oBgdItinerarioOficialDeRota->lat_proxma_usuario = $reg['bgd_itinerario_oficial_de_rota_lat_proxma_usuario'];
		$oBgdItinerarioOficialDeRota->lng_proxma_usuario = $reg['bgd_itinerario_oficial_de_rota_lng_proxma_usuario'];
		$oBgdItinerarioOficialDeRota->fonte = $reg['bgd_itinerario_oficial_de_rota_fonte'];
		return $oBgdItinerarioOficialDeRota;		   
	}
}
