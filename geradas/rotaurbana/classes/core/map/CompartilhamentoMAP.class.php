<?php
class CompartilhamentoMAP {
	static function getMetaData() {
		return ['compartilhamento' => ['cont', 
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

	static function objToRs($oCompartilhamento){
		$reg['cont'] = $oCompartilhamento->cont;
		$oIndicador = $oCompartilhamento->oIndicador;
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oCompartilhamento){
		$reg['cont'] = $oCompartilhamento->cont;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCompartilhamento = new Compartilhamento();
		$oCompartilhamento->cont = $reg['compartilhamento_cont'];

		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		$oCompartilhamento->oIndicador = $oIndicador;
		return $oCompartilhamento;		   
	}
}
