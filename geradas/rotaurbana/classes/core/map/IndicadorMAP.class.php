<?php
class IndicadorMAP {
	static function getMetaData() {
		return ['indicador' => ['id']];
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

	static function objToRs($oIndicador){
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oIndicador){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		return $oIndicador;		   
	}
}
