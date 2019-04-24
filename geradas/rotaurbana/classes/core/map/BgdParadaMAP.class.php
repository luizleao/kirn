<?php
class BgdParadaMAP {
	static function getMetaData() {
		return ['bgd_parada' => ['id', 
						'comments', 
						'latitude', 
						'longitude', 
						'title']];
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

	static function objToRs($oBgdParada){
		$reg['id'] = $oBgdParada->id;
		$reg['comments'] = $oBgdParada->comments;
		$reg['latitude'] = $oBgdParada->latitude;
		$reg['longitude'] = $oBgdParada->longitude;
		$reg['title'] = $oBgdParada->title;
		return $reg;		   
	}

	static function objToRsInsert($oBgdParada){
		$reg['comments'] = $oBgdParada->comments;
		$reg['latitude'] = $oBgdParada->latitude;
		$reg['longitude'] = $oBgdParada->longitude;
		$reg['title'] = $oBgdParada->title;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdParada = new BgdParada();
		$oBgdParada->id = $reg['bgd_parada_id'];
		$oBgdParada->comments = $reg['bgd_parada_comments'];
		$oBgdParada->latitude = $reg['bgd_parada_latitude'];
		$oBgdParada->longitude = $reg['bgd_parada_longitude'];
		$oBgdParada->title = $reg['bgd_parada_title'];
		return $oBgdParada;		   
	}
}
