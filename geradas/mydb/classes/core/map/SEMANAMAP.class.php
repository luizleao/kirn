<?php
class SEMANAMAP {
	static function getMetaData() {
		return ['SEMANA' => ['dia_semana', 
						'PERFIL_ACESSO_id'], 
				'PERFIL_ACESSO' => [						'id', 
						'nome', 
						'se_semana']];
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

	static function objToRs($oSEMANA){
		$reg['dia_semana'] = $oSEMANA->dia_semana;
		$oPERFILACESSO = $oSEMANA->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}

	static function objToRsInsert($oSEMANA){
		$reg['dia_semana'] = $oSEMANA->dia_semana;
		$oPERFILACESSO = $oSEMANA->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oSEMANA = new SEMANA();
		$oSEMANA->dia_semana = $reg['SEMANA_dia_semana'];

		$oPERFILACESSO = new PERFILACESSO();
		$oPERFILACESSO->id = $reg['PERFIL_ACESSO_id'];
		$oPERFILACESSO->nome = $reg['PERFIL_ACESSO_nome'];
		$oPERFILACESSO->se_semana = $reg['PERFIL_ACESSO_se_semana'];
		$oSEMANA->oPERFILACESSO = $oPERFILACESSO;
		return $oSEMANA;		   
	}
}
