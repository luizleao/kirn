<?php
class BgdMapaDeConsultasMAP {
	static function getMetaData() {
		return ['bgd_mapa_de_consultas' => ['id', 
						'data_captura', 
						'latDestino', 
						'latOrigem', 
						'lngDestino', 
						'lngOrigem', 
						'fk_bgd_cidade', 
						'fk_bgd_cidade_prox_usuario', 
						'lat_proxma_usuario', 
						'lng_proxma_usuario', 
						'fonte'], 
				'bgd_cidade' => [						'id', 
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

	static function objToRs($oBgdMapaDeConsultas){
		$reg['id'] = $oBgdMapaDeConsultas->id;
		$reg['data_captura'] = $oBgdMapaDeConsultas->data_captura;
		$reg['latDestino'] = $oBgdMapaDeConsultas->latDestino;
		$reg['latOrigem'] = $oBgdMapaDeConsultas->latOrigem;
		$reg['lngDestino'] = $oBgdMapaDeConsultas->lngDestino;
		$reg['lngOrigem'] = $oBgdMapaDeConsultas->lngOrigem;
		$oBgdCidade = $oBgdMapaDeConsultas->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdMapaDeConsultas->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$reg['lat_proxma_usuario'] = $oBgdMapaDeConsultas->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdMapaDeConsultas->lng_proxma_usuario;
		$reg['fonte'] = $oBgdMapaDeConsultas->fonte;
		return $reg;		   
	}

	static function objToRsInsert($oBgdMapaDeConsultas){
		$reg['data_captura'] = $oBgdMapaDeConsultas->data_captura;
		$reg['latDestino'] = $oBgdMapaDeConsultas->latDestino;
		$reg['latOrigem'] = $oBgdMapaDeConsultas->latOrigem;
		$reg['lngDestino'] = $oBgdMapaDeConsultas->lngDestino;
		$reg['lngOrigem'] = $oBgdMapaDeConsultas->lngOrigem;
		$oBgdCidade = $oBgdMapaDeConsultas->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdMapaDeConsultas->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$reg['lat_proxma_usuario'] = $oBgdMapaDeConsultas->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdMapaDeConsultas->lng_proxma_usuario;
		$reg['fonte'] = $oBgdMapaDeConsultas->fonte;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdMapaDeConsultas = new BgdMapaDeConsultas();
		$oBgdMapaDeConsultas->id = $reg['bgd_mapa_de_consultas_id'];
		$oBgdMapaDeConsultas->data_captura = $reg['bgd_mapa_de_consultas_data_captura'];
		$oBgdMapaDeConsultas->latDestino = $reg['bgd_mapa_de_consultas_latDestino'];
		$oBgdMapaDeConsultas->latOrigem = $reg['bgd_mapa_de_consultas_latOrigem'];
		$oBgdMapaDeConsultas->lngDestino = $reg['bgd_mapa_de_consultas_lngDestino'];
		$oBgdMapaDeConsultas->lngOrigem = $reg['bgd_mapa_de_consultas_lngOrigem'];

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdMapaDeConsultas->oBgdCidade = $oBgdCidade;

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdMapaDeConsultas->oBgdCidade = $oBgdCidade;
		$oBgdMapaDeConsultas->lat_proxma_usuario = $reg['bgd_mapa_de_consultas_lat_proxma_usuario'];
		$oBgdMapaDeConsultas->lng_proxma_usuario = $reg['bgd_mapa_de_consultas_lng_proxma_usuario'];
		$oBgdMapaDeConsultas->fonte = $reg['bgd_mapa_de_consultas_fonte'];
		return $oBgdMapaDeConsultas;		   
	}
}
