<?php
class PontotracadotrajetoMAP {
	static function getMetaData() {
		return ['pontotracadotrajeto' => ['id', 
						'latitude', 
						'longitude', 
						'posicao', 
						'linha_id', 
						'tipo']];
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

	static function objToRs($oPontotracadotrajeto){
		$reg['id'] = $oPontotracadotrajeto->id;
		$reg['latitude'] = $oPontotracadotrajeto->latitude;
		$reg['longitude'] = $oPontotracadotrajeto->longitude;
		$reg['posicao'] = $oPontotracadotrajeto->posicao;
		$reg['linha_id'] = $oPontotracadotrajeto->linha_id;
		$reg['tipo'] = $oPontotracadotrajeto->tipo;
		return $reg;		   
	}

	static function objToRsInsert($oPontotracadotrajeto){
		$reg['latitude'] = $oPontotracadotrajeto->latitude;
		$reg['longitude'] = $oPontotracadotrajeto->longitude;
		$reg['posicao'] = $oPontotracadotrajeto->posicao;
		$reg['linha_id'] = $oPontotracadotrajeto->linha_id;
		$reg['tipo'] = $oPontotracadotrajeto->tipo;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPontotracadotrajeto = new Pontotracadotrajeto();
		$oPontotracadotrajeto->id = $reg['pontotracadotrajeto_id'];
		$oPontotracadotrajeto->latitude = $reg['pontotracadotrajeto_latitude'];
		$oPontotracadotrajeto->longitude = $reg['pontotracadotrajeto_longitude'];
		$oPontotracadotrajeto->posicao = $reg['pontotracadotrajeto_posicao'];
		$oPontotracadotrajeto->linha_id = $reg['pontotracadotrajeto_linha_id'];
		$oPontotracadotrajeto->tipo = $reg['pontotracadotrajeto_tipo'];
		return $oPontotracadotrajeto;		   
	}
}
