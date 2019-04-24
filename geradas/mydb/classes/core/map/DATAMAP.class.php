<?php
class DATAMAP {
	static function getMetaData() {
		return ['DATA' => ['data_inicio', 
						'data_fim', 
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

	static function objToRs($oDATA){
		$reg['data_inicio'] = $oDATA->data_inicio;
		$reg['data_fim'] = $oDATA->data_fim;
		$oPERFILACESSO = $oDATA->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}

	static function objToRsInsert($oDATA){
		$reg['data_inicio'] = $oDATA->data_inicio;
		$reg['data_fim'] = $oDATA->data_fim;
		$oPERFILACESSO = $oDATA->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oDATA = new DATA();
		$oDATA->data_inicio = $reg['DATA_data_inicio'];
		$oDATA->data_fim = $reg['DATA_data_fim'];

		$oPERFILACESSO = new PERFILACESSO();
		$oPERFILACESSO->id = $reg['PERFIL_ACESSO_id'];
		$oPERFILACESSO->nome = $reg['PERFIL_ACESSO_nome'];
		$oPERFILACESSO->se_semana = $reg['PERFIL_ACESSO_se_semana'];
		$oDATA->oPERFILACESSO = $oPERFILACESSO;
		return $oDATA;		   
	}
}
