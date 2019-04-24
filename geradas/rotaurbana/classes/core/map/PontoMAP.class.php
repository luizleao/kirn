<?php
class PontoMAP {
	static function getMetaData() {
		return ['ponto' => ['id', 
						'latitude', 
						'longitude', 
						'linha_id', 
						'codigoAndroid']];
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

	static function objToRs($oPonto){
		$reg['id'] = $oPonto->id;
		$reg['latitude'] = $oPonto->latitude;
		$reg['longitude'] = $oPonto->longitude;
		$reg['linha_id'] = $oPonto->linha_id;
		$reg['codigoAndroid'] = $oPonto->codigoAndroid;
		return $reg;		   
	}

	static function objToRsInsert($oPonto){
		$reg['latitude'] = $oPonto->latitude;
		$reg['longitude'] = $oPonto->longitude;
		$reg['linha_id'] = $oPonto->linha_id;
		$reg['codigoAndroid'] = $oPonto->codigoAndroid;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPonto = new Ponto();
		$oPonto->id = $reg['ponto_id'];
		$oPonto->latitude = $reg['ponto_latitude'];
		$oPonto->longitude = $reg['ponto_longitude'];
		$oPonto->linha_id = $reg['ponto_linha_id'];
		$oPonto->codigoAndroid = $reg['ponto_codigoAndroid'];
		return $oPonto;		   
	}
}
