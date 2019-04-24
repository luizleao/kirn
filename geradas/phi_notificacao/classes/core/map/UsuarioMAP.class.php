<?php
class UsuarioMAP {
	static function getMetaData() {
		return ['usuario' => ['id', 
						'nome', 
						'status', 
						'id_contato'], 
				'contato' => [						'id_tel', 
						'numero', 
						'ddd', 
						'email']];
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
		$reg['nome'] = $oUsuario->nome;
		$reg['status'] = $oUsuario->status;
		$oContato = $oUsuario->oContato;
		$reg['id_contato'] = $oContato->id_tel;
		return $reg;		   
	}

	static function objToRsInsert($oUsuario){
		$reg['nome'] = $oUsuario->nome;
		$reg['status'] = $oUsuario->status;
		$oContato = $oUsuario->oContato;
		$reg['id_contato'] = $oContato->id_tel;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oUsuario = new Usuario();
		$oUsuario->id = $reg['usuario_id'];
		$oUsuario->nome = $reg['usuario_nome'];
		$oUsuario->status = $reg['usuario_status'];

		$oContato = new Contato();
		$oContato->id_tel = $reg['contato_id_tel'];
		$oContato->numero = $reg['contato_numero'];
		$oContato->ddd = $reg['contato_ddd'];
		$oContato->email = $reg['contato_email'];
		$oUsuario->oContato = $oContato;
		return $oUsuario;		   
	}
}
