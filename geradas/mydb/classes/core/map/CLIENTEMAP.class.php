<?php
class CLIENTEMAP {
	static function getMetaData() {
		return ['CLIENTE' => ['id', 
						'status', 
						'PESSOA_id', 
						'ENDERECO_id'], 
				'PESSOA' => [						'id', 
						'nome', 
						'cpf', 
						'nascimento', 
						'PERFIL_ACESSO_id'], 
				'ENDERECO' => [						'id', 
						'rua', 
						'bairro', 
						'cep', 
						'numero', 
						'complemento', 
						'CIDADE_id']];
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

	static function objToRs($oCLIENTE){
		$reg['id'] = $oCLIENTE->id;
		$reg['status'] = $oCLIENTE->status;
		$oPESSOA = $oCLIENTE->oPESSOA;
		$reg['PESSOA_id'] = $oPESSOA->id;
		$oENDERECO = $oCLIENTE->oENDERECO;
		$reg['ENDERECO_id'] = $oENDERECO->id;
		return $reg;		   
	}

	static function objToRsInsert($oCLIENTE){
		$reg['status'] = $oCLIENTE->status;
		$oPESSOA = $oCLIENTE->oPESSOA;
		$reg['PESSOA_id'] = $oPESSOA->id;
		$oENDERECO = $oCLIENTE->oENDERECO;
		$reg['ENDERECO_id'] = $oENDERECO->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCLIENTE = new CLIENTE();
		$oCLIENTE->id = $reg['CLIENTE_id'];
		$oCLIENTE->status = $reg['CLIENTE_status'];

		$oPESSOA = new PESSOA();
		$oPESSOA->id = $reg['PESSOA_id'];
		$oPESSOA->nome = $reg['PESSOA_nome'];
		$oPESSOA->cpf = $reg['PESSOA_cpf'];
		$oPESSOA->nascimento = $reg['PESSOA_nascimento'];
		$oCLIENTE->oPESSOA = $oPESSOA;

		$oENDERECO = new ENDERECO();
		$oENDERECO->id = $reg['ENDERECO_id'];
		$oENDERECO->rua = $reg['ENDERECO_rua'];
		$oENDERECO->bairro = $reg['ENDERECO_bairro'];
		$oENDERECO->cep = $reg['ENDERECO_cep'];
		$oENDERECO->numero = $reg['ENDERECO_numero'];
		$oENDERECO->complemento = $reg['ENDERECO_complemento'];
		$oCLIENTE->oENDERECO = $oENDERECO;
		return $oCLIENTE;		   
	}
}
