<?php
class ConsultanatelaveropesoMAP {
	static function getMetaData() {
		return ['consultanatelaveropeso' => ['cont', 
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

	static function objToRs($oConsultanatelaveropeso){
		$reg['cont'] = $oConsultanatelaveropeso->cont;
		$oIndicador = $oConsultanatelaveropeso->oIndicador;
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oConsultanatelaveropeso){
		$reg['cont'] = $oConsultanatelaveropeso->cont;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oConsultanatelaveropeso = new Consultanatelaveropeso();
		$oConsultanatelaveropeso->cont = $reg['consultanatelaveropeso_cont'];

		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		$oConsultanatelaveropeso->oIndicador = $oIndicador;
		return $oConsultanatelaveropeso;		   
	}
}
