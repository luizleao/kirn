<?php
class CODIGOACESSOMAP {
	static function getMetaData() {
		return ['CODIGO_ACESSO' => ['codigo', 
						'PESSOA_id'], 
				'PESSOA' => [						'id', 
						'nome', 
						'cpf', 
						'nascimento', 
						'PERFIL_ACESSO_id']];
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

	static function objToRs($oCODIGOACESSO){
		$reg['codigo'] = $oCODIGOACESSO->codigo;
		$oPESSOA = $oCODIGOACESSO->oPESSOA;
		$reg['PESSOA_id'] = $oPESSOA->id;
		return $reg;		   
	}

	static function objToRsInsert($oCODIGOACESSO){
		$reg['codigo'] = $oCODIGOACESSO->codigo;
		$oPESSOA = $oCODIGOACESSO->oPESSOA;
		$reg['PESSOA_id'] = $oPESSOA->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCODIGOACESSO = new CODIGOACESSO();
		$oCODIGOACESSO->codigo = $reg['CODIGO_ACESSO_codigo'];

		$oPESSOA = new PESSOA();
		$oPESSOA->id = $reg['PESSOA_id'];
		$oPESSOA->nome = $reg['PESSOA_nome'];
		$oPESSOA->cpf = $reg['PESSOA_cpf'];
		$oPESSOA->nascimento = $reg['PESSOA_nascimento'];
		$oCODIGOACESSO->oPESSOA = $oPESSOA;
		return $oCODIGOACESSO;		   
	}
}
