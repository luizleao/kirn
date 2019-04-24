<?php
class ClicknasparadasMAP {
	static function getMetaData() {
		return ['clicknasparadas' => ['cont', 
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

	static function objToRs($oClicknasparadas){
		$reg['cont'] = $oClicknasparadas->cont;
		$oIndicador = $oClicknasparadas->oIndicador;
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oClicknasparadas){
		$reg['cont'] = $oClicknasparadas->cont;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oClicknasparadas = new Clicknasparadas();
		$oClicknasparadas->cont = $reg['clicknasparadas_cont'];

		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		$oClicknasparadas->oIndicador = $oIndicador;
		return $oClicknasparadas;		   
	}
}
