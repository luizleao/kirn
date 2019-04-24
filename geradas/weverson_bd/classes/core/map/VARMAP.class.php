<?php
class VARMAP {
	static function getMetaData() {
		return ['VAR' => ['id', 
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

	static function objToRs($oVAR){
		$reg['id'] = $oVAR->id;
		$oPARTIDA = $oVAR->oPARTIDA;
		$reg['PARTIDA_id'] = $oPARTIDA->id;
		return $reg;		   
	}

	static function objToRsInsert($oVAR){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oVAR = new VAR();
		$oVAR->id = $reg['VAR_id'];

		$oPARTIDA = new PARTIDA();
		$oPARTIDA->id = $reg['PARTIDA_id'];
		$oVAR->oPARTIDA = $oPARTIDA;
		return $oVAR;		   
	}
}
