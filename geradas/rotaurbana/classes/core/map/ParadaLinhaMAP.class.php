<?php
class ParadaLinhaMAP {
	static function getMetaData() {
		return ['parada_linha' => ['paradas_id', 
						'linha_id']];
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

	static function objToRs($oParadaLinha){
		$reg['paradas_id'] = $oParadaLinha->paradas_id;
		$reg['linha_id'] = $oParadaLinha->linha_id;
		return $reg;		   
	}

	static function objToRsInsert($oParadaLinha){
		$reg['paradas_id'] = $oParadaLinha->paradas_id;
		$reg['linha_id'] = $oParadaLinha->linha_id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oParadaLinha = new ParadaLinha();
		$oParadaLinha->paradas_id = $reg['parada_linha_paradas_id'];
		$oParadaLinha->linha_id = $reg['parada_linha_linha_id'];
		return $oParadaLinha;		   
	}
}
