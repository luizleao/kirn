<?php
class EVENTOS INTERNOSMAP {
	static function getMetaData() {
		return [];
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

	static function objToRs($oEVENTOS INTERNOS){

		return $reg;		   
	}

	static function objToRsInsert($oEVENTOS INTERNOS){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oEVENTOS INTERNOS = new EVENTOS INTERNOS();

		return $oEVENTOS INTERNOS;		   
	}
}
