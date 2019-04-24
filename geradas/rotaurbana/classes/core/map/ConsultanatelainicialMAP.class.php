<?php
class ConsultanatelainicialMAP {
	static function getMetaData() {
		return ['consultanatelainicial' => ['cont', 
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

	static function objToRs($oConsultanatelainicial){
		$reg['cont'] = $oConsultanatelainicial->cont;
		$oIndicador = $oConsultanatelainicial->oIndicador;
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oConsultanatelainicial){
		$reg['cont'] = $oConsultanatelainicial->cont;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oConsultanatelainicial = new Consultanatelainicial();
		$oConsultanatelainicial->cont = $reg['consultanatelainicial_cont'];

		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		$oConsultanatelainicial->oIndicador = $oIndicador;
		return $oConsultanatelainicial;		   
	}
}
