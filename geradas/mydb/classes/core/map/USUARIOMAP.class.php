<?php
class USUARIOMAP {
	static function getMetaData() {
		return ['USUARIO' => ['login', 
						'senha', 
						'PESSOA_id', 
						'PERFIL_id'], 
				'PESSOA' => [						'id', 
						'nome', 
						'cpf', 
						'nascimento', 
						'PERFIL_ACESSO_id'], 
				'PERFIL' => [						'id', 
						'nome']];
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

	static function objToRs($oUSUARIO){
		$reg['login'] = $oUSUARIO->login;
		$reg['senha'] = $oUSUARIO->senha;
		$oPESSOA = $oUSUARIO->oPESSOA;
		$reg['PESSOA_id'] = $oPESSOA->id;
		$oPERFIL = $oUSUARIO->oPERFIL;
		$reg['PERFIL_id'] = $oPERFIL->id;
		return $reg;		   
	}

	static function objToRsInsert($oUSUARIO){
		$reg['login'] = $oUSUARIO->login;
		$reg['senha'] = $oUSUARIO->senha;
		$oPESSOA = $oUSUARIO->oPESSOA;
		$reg['PESSOA_id'] = $oPESSOA->id;
		$oPERFIL = $oUSUARIO->oPERFIL;
		$reg['PERFIL_id'] = $oPERFIL->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oUSUARIO = new USUARIO();
		$oUSUARIO->login = $reg['USUARIO_login'];
		$oUSUARIO->senha = $reg['USUARIO_senha'];

		$oPESSOA = new PESSOA();
		$oPESSOA->id = $reg['PESSOA_id'];
		$oPESSOA->nome = $reg['PESSOA_nome'];
		$oPESSOA->cpf = $reg['PESSOA_cpf'];
		$oPESSOA->nascimento = $reg['PESSOA_nascimento'];
		$oUSUARIO->oPESSOA = $oPESSOA;

		$oPERFIL = new PERFIL();
		$oPERFIL->id = $reg['PERFIL_id'];
		$oPERFIL->nome = $reg['PERFIL_nome'];
		$oUSUARIO->oPERFIL = $oPERFIL;
		return $oUSUARIO;		   
	}
}
