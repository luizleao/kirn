<?php
class CAMPEONATOMAP {
	static function getMetaData() {
		return ['CAMPEONATO' => ['id']];
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

	static function objToRs($oCAMPEONATO){
		$reg['id'] = $oCAMPEONATO->id;
		return $reg;		   
	}

	static function objToRsInsert($oCAMPEONATO){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCAMPEONATO = new CAMPEONATO();
		$oCAMPEONATO->id = $reg['CAMPEONATO_id'];
		return $oCAMPEONATO;		   
	}
}
