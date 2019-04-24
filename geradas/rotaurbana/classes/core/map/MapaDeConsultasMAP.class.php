<?php
class MapaDeConsultasMAP {
	static function getMetaData() {
		return ['mapa_de_consultas' => ['id', 
						'latDestino', 
						'latOrigem', 
						'lngDestino', 
						'lngOrigem', 
						'dataBusca', 
						'cidade_id'], 
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

	static function objToRs($oMapaDeConsultas){
		$reg['id'] = $oMapaDeConsultas->id;
		$reg['latDestino'] = $oMapaDeConsultas->latDestino;
		$reg['latOrigem'] = $oMapaDeConsultas->latOrigem;
		$reg['lngDestino'] = $oMapaDeConsultas->lngDestino;
		$reg['lngOrigem'] = $oMapaDeConsultas->lngOrigem;
		$reg['dataBusca'] = $oMapaDeConsultas->dataBusca;
		$oCidade = $oMapaDeConsultas->oCidade;
		$reg['cidade_id'] = $oCidade->id;
		return $reg;		   
	}

	static function objToRsInsert($oMapaDeConsultas){
		$reg['latDestino'] = $oMapaDeConsultas->latDestino;
		$reg['latOrigem'] = $oMapaDeConsultas->latOrigem;
		$reg['lngDestino'] = $oMapaDeConsultas->lngDestino;
		$reg['lngOrigem'] = $oMapaDeConsultas->lngOrigem;
		$reg['dataBusca'] = $oMapaDeConsultas->dataBusca;
		$oCidade = $oMapaDeConsultas->oCidade;
		$reg['cidade_id'] = $oCidade->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oMapaDeConsultas = new MapaDeConsultas();
		$oMapaDeConsultas->id = $reg['mapa_de_consultas_id'];
		$oMapaDeConsultas->latDestino = $reg['mapa_de_consultas_latDestino'];
		$oMapaDeConsultas->latOrigem = $reg['mapa_de_consultas_latOrigem'];
		$oMapaDeConsultas->lngDestino = $reg['mapa_de_consultas_lngDestino'];
		$oMapaDeConsultas->lngOrigem = $reg['mapa_de_consultas_lngOrigem'];
		$oMapaDeConsultas->dataBusca = $reg['mapa_de_consultas_dataBusca'];

		$oCidade = new Cidade();
		$oCidade->id = $reg['cidade_id'];
		$oCidade->latitude = $reg['cidade_latitude'];
		$oCidade->longitude = $reg['cidade_longitude'];
		$oCidade->nome = $reg['cidade_nome'];
		$oCidade->sameAs = $reg['cidade_sameAs'];
		$oCidade->latitudeDouble = $reg['cidade_latitudeDouble'];
		$oCidade->longitudeDouble = $reg['cidade_longitudeDouble'];
		$oMapaDeConsultas->oCidade = $oCidade;
		return $oMapaDeConsultas;		   
	}
}
