<?php
class CidadeMAP {
	static function getMetaData() {
		return ['cidade' => ['id', 
						'latitude', 
						'longitude', 
						'nome', 
						'estado_id', 
						'belongsTo_id', 
						'sameAs', 
						'latitudeDouble', 
						'longitudeDouble'], 
				'estado' => [						'id', 
						'nome', 
						'uf', 
						'pais_id']];
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

	static function objToRs($oCidade){
		$reg['id'] = $oCidade->id;
		$reg['latitude'] = $oCidade->latitude;
		$reg['longitude'] = $oCidade->longitude;
		$reg['nome'] = $oCidade->nome;
		$oEstado = $oCidade->oEstado;
		$reg['estado_id'] = $oEstado->id;
		$oCidade = $oCidade->oCidade;
		$reg['belongsTo_id'] = $oCidade->id;
		$reg['sameAs'] = $oCidade->sameAs;
		$reg['latitudeDouble'] = $oCidade->latitudeDouble;
		$reg['longitudeDouble'] = $oCidade->longitudeDouble;
		return $reg;		   
	}

	static function objToRsInsert($oCidade){
		$reg['latitude'] = $oCidade->latitude;
		$reg['longitude'] = $oCidade->longitude;
		$reg['nome'] = $oCidade->nome;
		$oEstado = $oCidade->oEstado;
		$reg['estado_id'] = $oEstado->id;
		$oCidade = $oCidade->oCidade;
		$reg['belongsTo_id'] = $oCidade->id;
		$reg['sameAs'] = $oCidade->sameAs;
		$reg['latitudeDouble'] = $oCidade->latitudeDouble;
		$reg['longitudeDouble'] = $oCidade->longitudeDouble;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCidade = new Cidade();
		$oCidade->id = $reg['cidade_id'];
		$oCidade->latitude = $reg['cidade_latitude'];
		$oCidade->longitude = $reg['cidade_longitude'];
		$oCidade->nome = $reg['cidade_nome'];

		$oEstado = new Estado();
		$oEstado->id = $reg['estado_id'];
		$oEstado->nome = $reg['estado_nome'];
		$oEstado->uf = $reg['estado_uf'];
		$oCidade->oEstado = $oEstado;

		$oCidade = new Cidade();
		$oCidade->id = $reg['cidade_id'];
		$oCidade->latitude = $reg['cidade_latitude'];
		$oCidade->longitude = $reg['cidade_longitude'];
		$oCidade->nome = $reg['cidade_nome'];
		$oCidade->sameAs = $reg['cidade_sameAs'];
		$oCidade->latitudeDouble = $reg['cidade_latitudeDouble'];
		$oCidade->longitudeDouble = $reg['cidade_longitudeDouble'];
		$oCidade->oCidade = $oCidade;
		$oCidade->sameAs = $reg['cidade_sameAs'];
		$oCidade->latitudeDouble = $reg['cidade_latitudeDouble'];
		$oCidade->longitudeDouble = $reg['cidade_longitudeDouble'];
		return $oCidade;		   
	}
}
