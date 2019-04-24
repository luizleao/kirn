<?php
class CAMPEONATOHasTIMEMAP {
	static function getMetaData() {
		return ['CAMPEONATO_has_TIME' => ['CAMPEONATO_id', 
						'TIME_id'], 
				'CAMPEONATO' => [						'id'], 
				'TIME' => [						'id', 
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

	static function objToRs($oCAMPEONATOHasTIME){
		$oCAMPEONATO = $oCAMPEONATOHasTIME->oCAMPEONATO;
		$reg['CAMPEONATO_id'] = $oCAMPEONATO->id;
		$oTIME = $oCAMPEONATOHasTIME->oTIME;
		$reg['TIME_id'] = $oTIME->id;
		return $reg;		   
	}

	static function objToRsInsert($oCAMPEONATOHasTIME){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCAMPEONATOHasTIME = new CAMPEONATOHasTIME();

		$oCAMPEONATO = new CAMPEONATO();
		$oCAMPEONATO->id = $reg['CAMPEONATO_id'];
		$oCAMPEONATOHasTIME->oCAMPEONATO = $oCAMPEONATO;

		$oTIME = new TIME();
		$oTIME->id = $reg['TIME_id'];
		$oTIME->pais = $reg['TIME_pais'];
		$oTIME->tecnico = $reg['TIME_tecnico'];
		$oCAMPEONATOHasTIME->oTIME = $oTIME;
		return $oCAMPEONATOHasTIME;		   
	}
}
