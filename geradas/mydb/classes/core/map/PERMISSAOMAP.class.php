<?php
class PERMISSAOMAP {
	static function getMetaData() {
		return ['PERMISSAO' => ['id', 
						'alteracao', 
						'insercao', 
						'exclusao', 
						'visualizacao']];
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

	static function objToRs($oPERMISSAO){
		$reg['id'] = $oPERMISSAO->id;
		$reg['alteracao'] = $oPERMISSAO->alteracao;
		$reg['insercao'] = $oPERMISSAO->insercao;
		$reg['exclusao'] = $oPERMISSAO->exclusao;
		$reg['visualizacao'] = $oPERMISSAO->visualizacao;
		return $reg;		   
	}

	static function objToRsInsert($oPERMISSAO){
		$reg['alteracao'] = $oPERMISSAO->alteracao;
		$reg['insercao'] = $oPERMISSAO->insercao;
		$reg['exclusao'] = $oPERMISSAO->exclusao;
		$reg['visualizacao'] = $oPERMISSAO->visualizacao;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPERMISSAO = new PERMISSAO();
		$oPERMISSAO->id = $reg['PERMISSAO_id'];
		$oPERMISSAO->alteracao = $reg['PERMISSAO_alteracao'];
		$oPERMISSAO->insercao = $reg['PERMISSAO_insercao'];
		$oPERMISSAO->exclusao = $reg['PERMISSAO_exclusao'];
		$oPERMISSAO->visualizacao = $reg['PERMISSAO_visualizacao'];
		return $oPERMISSAO;		   
	}
}
