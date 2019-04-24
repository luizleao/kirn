<?php
class CoordenadaMAP {
	static function getMetaData() {
		return ['coordenada' => ['id', 
						'latitude', 
						'longitude', 
						'trechoComentario_id'], 
				'trechocomentario' => [						'id', 
						'comentario', 
						'linha_id']];
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

	static function objToRs($oCoordenada){
		$reg['id'] = $oCoordenada->id;
		$reg['latitude'] = $oCoordenada->latitude;
		$reg['longitude'] = $oCoordenada->longitude;
		$oTrechocomentario = $oCoordenada->oTrechocomentario;
		$reg['trechoComentario_id'] = $oTrechocomentario->id;
		return $reg;		   
	}

	static function objToRsInsert($oCoordenada){
		$reg['latitude'] = $oCoordenada->latitude;
		$reg['longitude'] = $oCoordenada->longitude;
		$oTrechocomentario = $oCoordenada->oTrechocomentario;
		$reg['trechoComentario_id'] = $oTrechocomentario->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCoordenada = new Coordenada();
		$oCoordenada->id = $reg['coordenada_id'];
		$oCoordenada->latitude = $reg['coordenada_latitude'];
		$oCoordenada->longitude = $reg['coordenada_longitude'];

		$oTrechocomentario = new Trechocomentario();
		$oTrechocomentario->id = $reg['trechocomentario_id'];
		$oTrechocomentario->comentario = $reg['trechocomentario_comentario'];
		$oCoordenada->oTrechocomentario = $oTrechocomentario;
		return $oCoordenada;		   
	}
}
