<?php
class PESSOAMAP {
	static function getMetaData() {
		return ['PESSOA' => ['id', 
						'nome', 
						'cpf', 
						'nascimento', 
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

	static function objToRs($oPESSOA){
		$reg['id'] = $oPESSOA->id;
		$reg['nome'] = $oPESSOA->nome;
		$reg['cpf'] = $oPESSOA->cpf;
		$reg['nascimento'] = $oPESSOA->nascimento;
		$oPERFILACESSO = $oPESSOA->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}

	static function objToRsInsert($oPESSOA){
		$reg['nome'] = $oPESSOA->nome;
		$reg['cpf'] = $oPESSOA->cpf;
		$reg['nascimento'] = $oPESSOA->nascimento;
		$oPERFILACESSO = $oPESSOA->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPESSOA = new PESSOA();
		$oPESSOA->id = $reg['PESSOA_id'];
		$oPESSOA->nome = $reg['PESSOA_nome'];
		$oPESSOA->cpf = $reg['PESSOA_cpf'];
		$oPESSOA->nascimento = $reg['PESSOA_nascimento'];

		$oPERFILACESSO = new PERFILACESSO();
		$oPERFILACESSO->id = $reg['PERFIL_ACESSO_id'];
		$oPERFILACESSO->nome = $reg['PERFIL_ACESSO_nome'];
		$oPERFILACESSO->se_semana = $reg['PERFIL_ACESSO_se_semana'];
		$oPESSOA->oPERFILACESSO = $oPERFILACESSO;
		return $oPESSOA;		   
	}
}
