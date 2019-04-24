<?php
class SessionMAP {
	static function getMetaData() {
		return ['session' => ['id', 
						'ident']];
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

	static function objToRs($oSession){
		$reg['id'] = $oSession->id;
		$reg['ident'] = $oSession->ident;
		return $reg;		   
	}

	static function objToRsInsert($oSession){
		$reg['ident'] = $oSession->ident;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oSession = new Session();
		$oSession->id = $reg['session_id'];
		$oSession->ident = $reg['session_ident'];
		return $oSession;		   
	}
}
