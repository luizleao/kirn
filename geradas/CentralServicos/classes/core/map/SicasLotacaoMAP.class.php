<?php
class SicasLotacaoMAP {
	static function getMetaData() {
		return ['Sicas_Lotacao' => ['cd_lotacao']];
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

	static function objToRs($oSicasLotacao){
		$reg['cd_lotacao'] = $oSicasLotacao->cd_lotacao;
		return $reg;		   
	}

	static function objToRsInsert($oSicasLotacao){

		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oSicasLotacao = new SicasLotacao();
		$oSicasLotacao->cd_lotacao = $reg['Sicas_Lotacao_cd_lotacao'];
		return $oSicasLotacao;		   
	}
}
