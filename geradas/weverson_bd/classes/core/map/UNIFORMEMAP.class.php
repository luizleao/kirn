<?php
class UNIFORMEMAP {
	static function getMetaData() {
		return ['UNIFORME' => ['idUNIFORME', 
						'camisa', 
						'shot', 
						'meia', 
						'UNIFORMEcol', 
						'TIME_id'], 
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

	static function objToRs($oUNIFORME){
		$reg['idUNIFORME'] = $oUNIFORME->idUNIFORME;
		$reg['camisa'] = $oUNIFORME->camisa;
		$reg['shot'] = $oUNIFORME->shot;
		$reg['meia'] = $oUNIFORME->meia;
		$reg['UNIFORMEcol'] = $oUNIFORME->UNIFORMEcol;
		$oTIME = $oUNIFORME->oTIME;
		$reg['TIME_id'] = $oTIME->id;
		return $reg;		   
	}

	static function objToRsInsert($oUNIFORME){
		$reg['camisa'] = $oUNIFORME->camisa;
		$reg['shot'] = $oUNIFORME->shot;
		$reg['meia'] = $oUNIFORME->meia;
		$reg['UNIFORMEcol'] = $oUNIFORME->UNIFORMEcol;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oUNIFORME = new UNIFORME();
		$oUNIFORME->idUNIFORME = $reg['UNIFORME_idUNIFORME'];
		$oUNIFORME->camisa = $reg['UNIFORME_camisa'];
		$oUNIFORME->shot = $reg['UNIFORME_shot'];
		$oUNIFORME->meia = $reg['UNIFORME_meia'];
		$oUNIFORME->UNIFORMEcol = $reg['UNIFORME_UNIFORMEcol'];

		$oTIME = new TIME();
		$oTIME->id = $reg['TIME_id'];
		$oTIME->pais = $reg['TIME_pais'];
		$oTIME->tecnico = $reg['TIME_tecnico'];
		$oUNIFORME->oTIME = $oTIME;
		return $oUNIFORME;		   
	}
}
