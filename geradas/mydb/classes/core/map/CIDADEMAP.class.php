<?php
class CIDADEMAP {
	static function getMetaData() {
		return ['CIDADE' => ['id', 
						'nome', 
						'ESTADO_id'], 
				'ESTADO' => [						'id', 
						'nome', 
						'PAIS_id', 
						'uf']];
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

	static function objToRs($oCIDADE){
		$reg['id'] = $oCIDADE->id;
		$reg['nome'] = $oCIDADE->nome;
		$oESTADO = $oCIDADE->oESTADO;
		$reg['ESTADO_id'] = $oESTADO->id;
		return $reg;		   
	}

	static function objToRsInsert($oCIDADE){
		$reg['nome'] = $oCIDADE->nome;
		$oESTADO = $oCIDADE->oESTADO;
		$reg['ESTADO_id'] = $oESTADO->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oCIDADE = new CIDADE();
		$oCIDADE->id = $reg['CIDADE_id'];
		$oCIDADE->nome = $reg['CIDADE_nome'];

		$oESTADO = new ESTADO();
		$oESTADO->id = $reg['ESTADO_id'];
		$oESTADO->nome = $reg['ESTADO_nome'];
		$oESTADO->uf = $reg['ESTADO_uf'];
		$oCIDADE->oESTADO = $oESTADO;
		return $oCIDADE;		   
	}
}
