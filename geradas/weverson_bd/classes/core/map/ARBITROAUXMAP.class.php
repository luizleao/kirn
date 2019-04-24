<?php
class ARBITROAUXMAP {
	static function getMetaData() {
		return ['ARBITRO_AUX' => ['id', 
						'PARTIDA_id'], 
				'PARTIDA' => [						'id', 
						'idmadante', 
						'idvisitante']];
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

	static function objToRs($oARBITROAUX){
		$reg['id'] = $oARBITROAUX->id;
		$oPARTIDA = $oARBITROAUX->oPARTIDA;
		$reg['PARTIDA_id'] = $oPARTIDA->id;
		return $reg;		   
	}

	static function objToRsInsert($oARBITROAUX){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oARBITROAUX = new ARBITROAUX();
		$oARBITROAUX->id = $reg['ARBITRO_AUX_id'];

		$oPARTIDA = new PARTIDA();
		$oPARTIDA->id = $reg['PARTIDA_id'];
		$oARBITROAUX->oPARTIDA = $oPARTIDA;
		return $oARBITROAUX;		   
	}
}
