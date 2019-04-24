<?php
class EdicaodeparadasMAP {
	static function getMetaData() {
		return ['edicaodeparadas' => ['cont', 
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

	static function objToRs($oEdicaodeparadas){
		$reg['cont'] = $oEdicaodeparadas->cont;
		$oIndicador = $oEdicaodeparadas->oIndicador;
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oEdicaodeparadas){
		$reg['cont'] = $oEdicaodeparadas->cont;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oEdicaodeparadas = new Edicaodeparadas();
		$oEdicaodeparadas->cont = $reg['edicaodeparadas_cont'];

		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		$oEdicaodeparadas->oIndicador = $oIndicador;
		return $oEdicaodeparadas;		   
	}
}
