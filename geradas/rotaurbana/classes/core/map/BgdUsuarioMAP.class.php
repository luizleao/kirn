<?php
class BgdUsuarioMAP {
	static function getMetaData() {
		return ['bgd_usuario' => ['id', 
						'email', 
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

	static function objToRs($oBgdUsuario){
		$reg['id'] = $oBgdUsuario->id;
		$reg['email'] = $oBgdUsuario->email;
		$reg['nome'] = $oBgdUsuario->nome;
		return $reg;		   
	}

	static function objToRsInsert($oBgdUsuario){
		$reg['email'] = $oBgdUsuario->email;
		$reg['nome'] = $oBgdUsuario->nome;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdUsuario = new BgdUsuario();
		$oBgdUsuario->id = $reg['bgd_usuario_id'];
		$oBgdUsuario->email = $reg['bgd_usuario_email'];
		$oBgdUsuario->nome = $reg['bgd_usuario_nome'];
		return $oBgdUsuario;		   
	}
}
