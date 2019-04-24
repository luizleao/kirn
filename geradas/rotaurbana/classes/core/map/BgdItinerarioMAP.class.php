<?php
class BgdItinerarioMAP {
	static function getMetaData() {
		return ['bgd_itinerario' => ['fk_bgd_itinerario_oficial_de_rota_id', 
						'fk_bgd_ponto_tracado_trajeto_id'], 
				'bgd_itinerario_oficial_de_rota' => [						'id', 
						'data_captura', 
						'fk_bgd_cidade', 
						'fk_bgd_cidade_prox_usuario', 
						'fk_bgd_linha', 
						'fk_bgd_usuario', 
						'lat_proxma_usuario', 
						'lng_proxma_usuario', 
						'fonte']];
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

	static function objToRs($oBgdItinerario){
		$oBgdItinerarioOficialDeRota = $oBgdItinerario->oBgdItinerarioOficialDeRota;
		$reg['fk_bgd_itinerario_oficial_de_rota_id'] = $oBgdItinerarioOficialDeRota->id;
		$reg['fk_bgd_ponto_tracado_trajeto_id'] = $oBgdItinerario->fk_bgd_ponto_tracado_trajeto_id;
		return $reg;		   
	}

	static function objToRsInsert($oBgdItinerario){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdItinerario = new BgdItinerario();

		$oBgdItinerarioOficialDeRota = new BgdItinerarioOficialDeRota();
		$oBgdItinerarioOficialDeRota->id = $reg['bgd_itinerario_oficial_de_rota_id'];
		$oBgdItinerarioOficialDeRota->data_captura = $reg['bgd_itinerario_oficial_de_rota_data_captura'];
		$oBgdItinerarioOficialDeRota->lat_proxma_usuario = $reg['bgd_itinerario_oficial_de_rota_lat_proxma_usuario'];
		$oBgdItinerarioOficialDeRota->lng_proxma_usuario = $reg['bgd_itinerario_oficial_de_rota_lng_proxma_usuario'];
		$oBgdItinerarioOficialDeRota->fonte = $reg['bgd_itinerario_oficial_de_rota_fonte'];
		$oBgdItinerario->oBgdItinerarioOficialDeRota = $oBgdItinerarioOficialDeRota;
		$oBgdItinerario->fk_bgd_ponto_tracado_trajeto_id = $reg['bgd_itinerario_fk_bgd_ponto_tracado_trajeto_id'];
		return $oBgdItinerario;		   
	}
}
