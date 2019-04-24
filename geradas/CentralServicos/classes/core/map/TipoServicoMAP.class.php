<?php
class TipoServicoMAP {
	static function getMetaData() {
		return ['TipoServico' => ['idTipoServico', 
						'idNaturezaContratual', 
						'descricao', 
						'status'], 
				'NaturezaContratual' => [						'idNaturezaContratual', 
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

	static function objToRs($oTipoServico){
		$reg['idTipoServico'] = $oTipoServico->idTipoServico;
		$oNaturezaContratual = $oTipoServico->oNaturezaContratual;
		$reg['idNaturezaContratual'] = $oNaturezaContratual->idNaturezaContratual;
		$reg['descricao'] = $oTipoServico->descricao;
		$reg['status'] = $oTipoServico->status;
		return $reg;		   
	}

	static function objToRsInsert($oTipoServico){
		$oNaturezaContratual = $oTipoServico->oNaturezaContratual;
		$reg['idNaturezaContratual'] = $oNaturezaContratual->idNaturezaContratual;
		$reg['descricao'] = $oTipoServico->descricao;
		$reg['status'] = $oTipoServico->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oTipoServico = new TipoServico();
		$oTipoServico->idTipoServico = $reg['TipoServico_idTipoServico'];

		$oNaturezaContratual = new NaturezaContratual();
		$oNaturezaContratual->idNaturezaContratual = $reg['NaturezaContratual_idNaturezaContratual'];
		$oNaturezaContratual->descricao = $reg['NaturezaContratual_descricao'];
		$oNaturezaContratual->status = $reg['NaturezaContratual_status'];
		$oTipoServico->oNaturezaContratual = $oNaturezaContratual;
		$oTipoServico->descricao = $reg['TipoServico_descricao'];
		$oTipoServico->status = $reg['TipoServico_status'];
		return $oTipoServico;		   
	}
}
