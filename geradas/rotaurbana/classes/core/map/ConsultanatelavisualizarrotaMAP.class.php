<?php
class ConsultanatelavisualizarrotaMAP {
	static function getMetaData() {
		return ['consultanatelavisualizarrota' => ['cont', 
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

	static function objToRs($oConsultanatelavisualizarrota){
		$reg['cont'] = $oConsultanatelavisualizarrota->cont;
		$oIndicador = $oConsultanatelavisualizarrota->oIndicador;
		$reg['id'] = $oIndicador->id;
		return $reg;		   
	}

	static function objToRsInsert($oConsultanatelavisualizarrota){
		$reg['cont'] = $oConsultanatelavisualizarrota->cont;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oConsultanatelavisualizarrota = new Consultanatelavisualizarrota();
		$oConsultanatelavisualizarrota->cont = $reg['consultanatelavisualizarrota_cont'];

		$oIndicador = new Indicador();
		$oIndicador->id = $reg['indicador_id'];
		$oConsultanatelavisualizarrota->oIndicador = $oIndicador;
		return $oConsultanatelavisualizarrota;		   
	}
}
