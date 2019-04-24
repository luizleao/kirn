<?php
class PERFILACESSOMAP {
	static function getMetaData() {
		return ['PERFIL_ACESSO' => ['id', 
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

	static function objToRs($oPERFILACESSO){
		$reg['id'] = $oPERFILACESSO->id;
		$reg['nome'] = $oPERFILACESSO->nome;
		$reg['se_semana'] = $oPERFILACESSO->se_semana;
		return $reg;		   
	}

	static function objToRsInsert($oPERFILACESSO){
		$reg['nome'] = $oPERFILACESSO->nome;
		$reg['se_semana'] = $oPERFILACESSO->se_semana;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPERFILACESSO = new PERFILACESSO();
		$oPERFILACESSO->id = $reg['PERFIL_ACESSO_id'];
		$oPERFILACESSO->nome = $reg['PERFIL_ACESSO_nome'];
		$oPERFILACESSO->se_semana = $reg['PERFIL_ACESSO_se_semana'];
		return $oPERFILACESSO;		   
	}
}
