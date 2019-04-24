<?php
class TELAPERMISSAOMAP {
	static function getMetaData() {
		return ['TELA_PERMISSAO' => ['TELA_id', 
						'PERMISSAO_id', 
						'PERFIL_id'], 
				'TELA' => [						'id', 
						'nome'], 
				'PERMISSAO' => [						'id', 
						'alteracao', 
						'insercao', 
						'exclusao', 
						'visualizacao'], 
				'PERFIL' => [						'id', 
						'nome']];
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

	static function objToRs($oTELAPERMISSAO){
		$oTELA = $oTELAPERMISSAO->oTELA;
		$reg['TELA_id'] = $oTELA->id;
		$oPERMISSAO = $oTELAPERMISSAO->oPERMISSAO;
		$reg['PERMISSAO_id'] = $oPERMISSAO->id;
		$oPERFIL = $oTELAPERMISSAO->oPERFIL;
		$reg['PERFIL_id'] = $oPERFIL->id;
		return $reg;		   
	}

	static function objToRsInsert($oTELAPERMISSAO){
		$oTELA = $oTELAPERMISSAO->oTELA;
		$reg['TELA_id'] = $oTELA->id;
		$oPERMISSAO = $oTELAPERMISSAO->oPERMISSAO;
		$reg['PERMISSAO_id'] = $oPERMISSAO->id;
		$oPERFIL = $oTELAPERMISSAO->oPERFIL;
		$reg['PERFIL_id'] = $oPERFIL->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oTELAPERMISSAO = new TELAPERMISSAO();

		$oTELA = new TELA();
		$oTELA->id = $reg['TELA_id'];
		$oTELA->nome = $reg['TELA_nome'];
		$oTELAPERMISSAO->oTELA = $oTELA;

		$oPERMISSAO = new PERMISSAO();
		$oPERMISSAO->id = $reg['PERMISSAO_id'];
		$oPERMISSAO->alteracao = $reg['PERMISSAO_alteracao'];
		$oPERMISSAO->insercao = $reg['PERMISSAO_insercao'];
		$oPERMISSAO->exclusao = $reg['PERMISSAO_exclusao'];
		$oPERMISSAO->visualizacao = $reg['PERMISSAO_visualizacao'];
		$oTELAPERMISSAO->oPERMISSAO = $oPERMISSAO;

		$oPERFIL = new PERFIL();
		$oPERFIL->id = $reg['PERFIL_id'];
		$oPERFIL->nome = $reg['PERFIL_nome'];
		$oTELAPERMISSAO->oPERFIL = $oPERFIL;
		return $oTELAPERMISSAO;		   
	}
}
