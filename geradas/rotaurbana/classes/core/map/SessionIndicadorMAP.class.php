<?php
class SessionIndicadorMAP {
	static function getMetaData() {
		return ['session_indicador' => ['session_id', 
						'indicadores_id'], 
				'session' => [						'id', 
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

	static function objToRs($oSessionIndicador){
		$oSession = $oSessionIndicador->oSession;
		$reg['session_id'] = $oSession->id;
		$reg['indicadores_id'] = $oSessionIndicador->indicadores_id;
		return $reg;		   
	}

	static function objToRsInsert($oSessionIndicador){
		$oSession = $oSessionIndicador->oSession;
		$reg['session_id'] = $oSession->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oSessionIndicador = new SessionIndicador();

		$oSession = new Session();
		$oSession->id = $reg['session_id'];
		$oSession->ident = $reg['session_ident'];
		$oSessionIndicador->oSession = $oSession;
		$oSessionIndicador->indicadores_id = $reg['session_indicador_indicadores_id'];
		return $oSessionIndicador;		   
	}
}
