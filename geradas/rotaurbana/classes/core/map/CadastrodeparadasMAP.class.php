<?php
class CadastrodeparadasMAP {
	static function getMetaData() {
		return ['cadastrodeparadas' => ['cont', 
						'id'], 
				'indicador' => [						'id']];
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

	static function objToRs($oCadastrodeparadas){
		$reg['cont'] = $oCadastrodeparadas->cont;
		$oIndicador = $oCadastrodeparadas->oIndicador;
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oCadastrodeparadas){
		$reg['cont'] = $oCadastrodeparadas->cont;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCadastrodeparadas = new Cadastrodeparadas();
		$oCadastrodeparadas->cont = $reg['cadastrodeparadas_cont'];

		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		$oCadastrodeparadas->oIndicador = $oIndicador;
		return $oCadastrodeparadas;		   
	}
}
