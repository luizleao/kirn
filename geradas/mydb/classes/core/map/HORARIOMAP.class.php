<?php
class HORARIOMAP {
	static function getMetaData() {
		return ['HORARIO' => ['horario_inicio', 
						'horario_fim', 
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

	static function objToRs($oHORARIO){
		$reg['horario_inicio'] = $oHORARIO->horario_inicio;
		$reg['horario_fim'] = $oHORARIO->horario_fim;
		$oPERFILACESSO = $oHORARIO->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}

	static function objToRsInsert($oHORARIO){
		$reg['horario_inicio'] = $oHORARIO->horario_inicio;
		$reg['horario_fim'] = $oHORARIO->horario_fim;
		$oPERFILACESSO = $oHORARIO->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oHORARIO = new HORARIO();
		$oHORARIO->horario_inicio = $reg['HORARIO_horario_inicio'];
		$oHORARIO->horario_fim = $reg['HORARIO_horario_fim'];

		$oPERFILACESSO = new PERFILACESSO();
		$oPERFILACESSO->id = $reg['PERFIL_ACESSO_id'];
		$oPERFILACESSO->nome = $reg['PERFIL_ACESSO_nome'];
		$oPERFILACESSO->se_semana = $reg['PERFIL_ACESSO_se_semana'];
		$oHORARIO->oPERFILACESSO = $oPERFILACESSO;
		return $oHORARIO;		   
	}
}
