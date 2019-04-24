<?php
class SlaMAP {
	static function getMetaData() {
		return ['Sla' => ['idSla', 
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

	static function objToRs($oSla){
		$reg['idSla'] = $oSla->idSla;
		$reg['descricao'] = $oSla->descricao;
		$reg['status'] = $oSla->status;
		return $reg;		   
	}

	static function objToRsInsert($oSla){
		$reg['descricao'] = $oSla->descricao;
		$reg['status'] = $oSla->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oSla = new Sla();
		$oSla->idSla = $reg['Sla_idSla'];
		$oSla->descricao = $reg['Sla_descricao'];
		$oSla->status = $reg['Sla_status'];
		return $oSla;		   
	}
}
