<?php
class PARTIDAMAP {
	static function getMetaData() {
		return ['PARTIDA' => ['id', 
						'idmadante', 
						'idvisitante'], 
				'TIME' => [						'id', 
						'pais', 
						'tecnico']];
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

	static function objToRs($oPARTIDA){
		$reg['id'] = $oPARTIDA->id;
		$oTIME = $oPARTIDA->oTIME;
		$reg['idmadante'] = $oTIME->id;
		$oTIME = $oPARTIDA->oTIME;
		$reg['idvisitante'] = $oTIME->id;
		return $reg;		   
	}

	static function objToRsInsert($oPARTIDA){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPARTIDA = new PARTIDA();
		$oPARTIDA->id = $reg['PARTIDA_id'];

		$oTIME = new TIME();
		$oTIME->id = $reg['TIME_id'];
		$oTIME->pais = $reg['TIME_pais'];
		$oTIME->tecnico = $reg['TIME_tecnico'];
		$oPARTIDA->oTIME = $oTIME;

		$oTIME = new TIME();
		$oTIME->id = $reg['TIME_id'];
		$oTIME->pais = $reg['TIME_pais'];
		$oTIME->tecnico = $reg['TIME_tecnico'];
		$oPARTIDA->oTIME = $oTIME;
		return $oPARTIDA;		   
	}
}
