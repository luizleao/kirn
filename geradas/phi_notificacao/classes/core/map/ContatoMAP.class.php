<?php
class ContatoMAP {
	static function getMetaData() {
		return ['contato' => ['id_tel', 
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

	static function objToRs($oContato){
		$reg['id_tel'] = $oContato->id_tel;
		$reg['numero'] = $oContato->numero;
		$reg['ddd'] = $oContato->ddd;
		$reg['email'] = $oContato->email;
		return $reg;		   
	}

	static function objToRsInsert($oContato){
		$reg['numero'] = $oContato->numero;
		$reg['ddd'] = $oContato->ddd;
		$reg['email'] = $oContato->email;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oContato = new Contato();
		$oContato->id_tel = $reg['contato_id_tel'];
		$oContato->numero = $reg['contato_numero'];
		$oContato->ddd = $reg['contato_ddd'];
		$oContato->email = $reg['contato_email'];
		return $oContato;		   
	}
}
