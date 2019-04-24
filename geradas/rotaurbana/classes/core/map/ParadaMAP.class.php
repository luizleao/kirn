<?php
class ParadaMAP {
	static function getMetaData() {
		return ['parada' => ['id', 
						'latitude', 
						'longitude', 
						'status', 
						'comments', 
						'title', 
						'tipoDeRotaDaParada']];
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

	static function objToRs($oParada){
		$reg['id'] = $oParada->id;
		$reg['latitude'] = $oParada->latitude;
		$reg['longitude'] = $oParada->longitude;
		$reg['status'] = $oParada->status;
		$reg['comments'] = $oParada->comments;
		$reg['title'] = $oParada->title;
		$reg['tipoDeRotaDaParada'] = $oParada->tipoDeRotaDaParada;
		return $reg;		   
	}

	static function objToRsInsert($oParada){
		$reg['latitude'] = $oParada->latitude;
		$reg['longitude'] = $oParada->longitude;
		$reg['status'] = $oParada->status;
		$reg['comments'] = $oParada->comments;
		$reg['title'] = $oParada->title;
		$reg['tipoDeRotaDaParada'] = $oParada->tipoDeRotaDaParada;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oParada = new Parada();
		$oParada->id = $reg['parada_id'];
		$oParada->latitude = $reg['parada_latitude'];
		$oParada->longitude = $reg['parada_longitude'];
		$oParada->status = $reg['parada_status'];
		$oParada->comments = $reg['parada_comments'];
		$oParada->title = $reg['parada_title'];
		$oParada->tipoDeRotaDaParada = $reg['parada_tipoDeRotaDaParada'];
		return $oParada;		   
	}
}
