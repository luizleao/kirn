<?php
class REGISTROACESSOMAP {
	static function getMetaData() {
		return ['REGISTRO_ACESSO' => ['id', 
						'data', 
						'hora', 
						'sentido', 
						'permissao', 
						'PESSOA_id', 
						'PERFIL_ACESSO_id'], 
				'PESSOA' => [						'id', 
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

	static function objToRs($oREGISTROACESSO){
		$reg['id'] = $oREGISTROACESSO->id;
		$reg['data'] = $oREGISTROACESSO->data;
		$reg['hora'] = $oREGISTROACESSO->hora;
		$reg['sentido'] = $oREGISTROACESSO->sentido;
		$reg['permissao'] = $oREGISTROACESSO->permissao;
		$oPESSOA = $oREGISTROACESSO->oPESSOA;
		$reg['PESSOA_id'] = $oPESSOA->id;
		$oPERFILACESSO = $oREGISTROACESSO->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}

	static function objToRsInsert($oREGISTROACESSO){
		$reg['data'] = $oREGISTROACESSO->data;
		$reg['hora'] = $oREGISTROACESSO->hora;
		$reg['sentido'] = $oREGISTROACESSO->sentido;
		$reg['permissao'] = $oREGISTROACESSO->permissao;
		$oPESSOA = $oREGISTROACESSO->oPESSOA;
		$reg['PESSOA_id'] = $oPESSOA->id;
		$oPERFILACESSO = $oREGISTROACESSO->oPERFILACESSO;
		$reg['PERFIL_ACESSO_id'] = $oPERFILACESSO->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oREGISTROACESSO = new REGISTROACESSO();
		$oREGISTROACESSO->id = $reg['REGISTRO_ACESSO_id'];
		$oREGISTROACESSO->data = $reg['REGISTRO_ACESSO_data'];
		$oREGISTROACESSO->hora = $reg['REGISTRO_ACESSO_hora'];
		$oREGISTROACESSO->sentido = $reg['REGISTRO_ACESSO_sentido'];
		$oREGISTROACESSO->permissao = $reg['REGISTRO_ACESSO_permissao'];

		$oPESSOA = new PESSOA();
		$oPESSOA->id = $reg['PESSOA_id'];
		$oPESSOA->nome = $reg['PESSOA_nome'];
		$oPESSOA->cpf = $reg['PESSOA_cpf'];
		$oPESSOA->nascimento = $reg['PESSOA_nascimento'];
		$oREGISTROACESSO->oPESSOA = $oPESSOA;

		$oPERFILACESSO = new PERFILACESSO();
		$oPERFILACESSO->id = $reg['PERFIL_ACESSO_id'];
		$oPERFILACESSO->nome = $reg['PERFIL_ACESSO_nome'];
		$oPERFILACESSO->se_semana = $reg['PERFIL_ACESSO_se_semana'];
		$oREGISTROACESSO->oPERFILACESSO = $oPERFILACESSO;
		return $oREGISTROACESSO;		   
	}
}
