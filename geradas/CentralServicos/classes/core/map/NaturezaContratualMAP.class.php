<?php
class NaturezaContratualMAP {
	static function getMetaData() {
		return ['NaturezaContratual' => ['idNaturezaContratual', 
						'descricao', 
						'status']];
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

	static function objToRs($oNaturezaContratual){
		$reg['idNaturezaContratual'] = $oNaturezaContratual->idNaturezaContratual;
		$reg['descricao'] = $oNaturezaContratual->descricao;
		$reg['status'] = $oNaturezaContratual->status;
		return $reg;		   
	}

	static function objToRsInsert($oNaturezaContratual){
		$reg['descricao'] = $oNaturezaContratual->descricao;
		$reg['status'] = $oNaturezaContratual->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oNaturezaContratual = new NaturezaContratual();
		$oNaturezaContratual->idNaturezaContratual = $reg['NaturezaContratual_idNaturezaContratual'];
		$oNaturezaContratual->descricao = $reg['NaturezaContratual_descricao'];
		$oNaturezaContratual->status = $reg['NaturezaContratual_status'];
		return $oNaturezaContratual;		   
	}
}
