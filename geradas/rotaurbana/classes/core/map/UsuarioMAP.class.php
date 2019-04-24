<?php
class UsuarioMAP {
	static function getMetaData() {
		return ['usuario' => ['id', 
						'email', 
						'login', 
						'nome', 
						'roles', 
						'senha', 
						'tos', 
						'numlogins', 
						'numrotasvisu', 
						'paradascriadas', 
						'paradaseditadas', 
						'rotascriadas', 
						'rotaseditadas', 
						'totalpontos', 
						'nivel', 
						'insig1', 
						'insig2', 
						'insig3', 
						'insig4']];
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

	static function objToRs($oUsuario){
		$reg['id'] = $oUsuario->id;
		$reg['email'] = $oUsuario->email;
		$reg['login'] = $oUsuario->login;
		$reg['nome'] = $oUsuario->nome;
		$reg['roles'] = $oUsuario->roles;
		$reg['senha'] = $oUsuario->senha;
		$reg['tos'] = $oUsuario->tos;
		$reg['numlogins'] = $oUsuario->numlogins;
		$reg['numrotasvisu'] = $oUsuario->numrotasvisu;
		$reg['paradascriadas'] = $oUsuario->paradascriadas;
		$reg['paradaseditadas'] = $oUsuario->paradaseditadas;
		$reg['rotascriadas'] = $oUsuario->rotascriadas;
		$reg['rotaseditadas'] = $oUsuario->rotaseditadas;
		$reg['totalpontos'] = $oUsuario->totalpontos;
		$reg['nivel'] = $oUsuario->nivel;
		$reg['insig1'] = $oUsuario->insig1;
		$reg['insig2'] = $oUsuario->insig2;
		$reg['insig3'] = $oUsuario->insig3;
		$reg['insig4'] = $oUsuario->insig4;
		return $reg;		   
	}

	static function objToRsInsert($oUsuario){
		$reg['email'] = $oUsuario->email;
		$reg['login'] = $oUsuario->login;
		$reg['nome'] = $oUsuario->nome;
		$reg['roles'] = $oUsuario->roles;
		$reg['senha'] = $oUsuario->senha;
		$reg['tos'] = $oUsuario->tos;
		$reg['numlogins'] = $oUsuario->numlogins;
		$reg['numrotasvisu'] = $oUsuario->numrotasvisu;
		$reg['paradascriadas'] = $oUsuario->paradascriadas;
		$reg['paradaseditadas'] = $oUsuario->paradaseditadas;
		$reg['rotascriadas'] = $oUsuario->rotascriadas;
		$reg['rotaseditadas'] = $oUsuario->rotaseditadas;
		$reg['totalpontos'] = $oUsuario->totalpontos;
		$reg['nivel'] = $oUsuario->nivel;
		$reg['insig1'] = $oUsuario->insig1;
		$reg['insig2'] = $oUsuario->insig2;
		$reg['insig3'] = $oUsuario->insig3;
		$reg['insig4'] = $oUsuario->insig4;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oUsuario = new Usuario();
		$oUsuario->id = $reg['usuario_id'];
		$oUsuario->email = $reg['usuario_email'];
		$oUsuario->login = $reg['usuario_login'];
		$oUsuario->nome = $reg['usuario_nome'];
		$oUsuario->roles = $reg['usuario_roles'];
		$oUsuario->senha = $reg['usuario_senha'];
		$oUsuario->tos = $reg['usuario_tos'];
		$oUsuario->numlogins = $reg['usuario_numlogins'];
		$oUsuario->numrotasvisu = $reg['usuario_numrotasvisu'];
		$oUsuario->paradascriadas = $reg['usuario_paradascriadas'];
		$oUsuario->paradaseditadas = $reg['usuario_paradaseditadas'];
		$oUsuario->rotascriadas = $reg['usuario_rotascriadas'];
		$oUsuario->rotaseditadas = $reg['usuario_rotaseditadas'];
		$oUsuario->totalpontos = $reg['usuario_totalpontos'];
		$oUsuario->nivel = $reg['usuario_nivel'];
		$oUsuario->insig1 = $reg['usuario_insig1'];
		$oUsuario->insig2 = $reg['usuario_insig2'];
		$oUsuario->insig3 = $reg['usuario_insig3'];
		$oUsuario->insig4 = $reg['usuario_insig4'];
		return $oUsuario;		   
	}
}
