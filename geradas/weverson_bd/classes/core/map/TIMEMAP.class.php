<?php
class TIMEMAP {
	static function getMetaData() {
		return ['TIME' => ['id', 
						'pais', 
						'tecnico']];
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

	static function objToRs($oTIME){
		$reg['id'] = $oTIME->id;
		$reg['pais'] = $oTIME->pais;
		$reg['tecnico'] = $oTIME->tecnico;
		return $reg;		   
	}

	static function objToRsInsert($oTIME){
		$reg['pais'] = $oTIME->pais;
		$reg['tecnico'] = $oTIME->tecnico;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oTIME = new TIME();
		$oTIME->id = $reg['TIME_id'];
		$oTIME->pais = $reg['TIME_pais'];
		$oTIME->tecnico = $reg['TIME_tecnico'];
		return $oTIME;		   
	}
}
