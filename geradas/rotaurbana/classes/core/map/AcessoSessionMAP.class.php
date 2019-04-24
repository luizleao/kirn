<?php
class AcessoSessionMAP {
	static function getMetaData() {
		return ['acesso_session' => ['acesso_id', 
						'sessions_id'], 
				'acesso' => [						'ip', 
						'id']];
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

	static function objToRs($oAcessoSession){
		$oAcesso = $oAcessoSession->oAcesso;
		$reg['acesso_id'] = $oAcesso->id;
		$reg['sessions_id'] = $oAcessoSession->sessions_id;
		return $reg;		   
	}

	static function objToRsInsert($oAcessoSession){
		$oAcesso = $oAcessoSession->oAcesso;
		$reg['acesso_id'] = $oAcesso->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oAcessoSession = new AcessoSession();

		$oAcesso = new Acesso();
		$oAcesso->ip = $reg['acesso_ip'];
		$oAcessoSession->oAcesso = $oAcesso;
		$oAcessoSession->sessions_id = $reg['acesso_session_sessions_id'];
		return $oAcessoSession;		   
	}
}
