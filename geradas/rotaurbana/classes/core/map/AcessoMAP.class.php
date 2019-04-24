<?php
class AcessoMAP {
	static function getMetaData() {
		return ['acesso' => ['ip', 
						'id'], 
				'indicador' => [						'id']];
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

	static function objToRs($oAcesso){
		$reg['ip'] = $oAcesso->ip;
		$oIndicador = $oAcesso->oIndicador;
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oAcesso){
		$reg['ip'] = $oAcesso->ip;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oAcesso = new Acesso();
		$oAcesso->ip = $reg['acesso_ip'];

		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		$oAcesso->oIndicador = $oIndicador;
		return $oAcesso;		   
	}
}
