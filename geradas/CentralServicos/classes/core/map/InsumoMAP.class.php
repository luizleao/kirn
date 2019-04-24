<?php
class InsumoMAP {
	static function getMetaData() {
		return ['Insumo' => ['idInsumo', 
						'idNaturezaContratual', 
						'descricao', 
						'estoque', 
						'valor', 
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

	static function objToRs($oInsumo){
		$reg['idInsumo'] = $oInsumo->idInsumo;
		$oNaturezaContratual = $oInsumo->oNaturezaContratual;
		$reg['idNaturezaContratual'] = $oNaturezaContratual->idNaturezaContratual;
		$reg['descricao'] = $oInsumo->descricao;
		$reg['estoque'] = $oInsumo->estoque;
		$reg['valor'] = $oInsumo->valor;
		$reg['status'] = $oInsumo->status;
		return $reg;		   
	}

	static function objToRsInsert($oInsumo){
		$oNaturezaContratual = $oInsumo->oNaturezaContratual;
		$reg['idNaturezaContratual'] = $oNaturezaContratual->idNaturezaContratual;
		$reg['descricao'] = $oInsumo->descricao;
		$reg['estoque'] = $oInsumo->estoque;
		$reg['valor'] = $oInsumo->valor;
		$reg['status'] = $oInsumo->status;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oInsumo = new Insumo();
		$oInsumo->idInsumo = $reg['Insumo_idInsumo'];

		$oNaturezaContratual = new NaturezaContratual();
		$oNaturezaContratual->idNaturezaContratual = $reg['NaturezaContratual_idNaturezaContratual'];
		$oNaturezaContratual->descricao = $reg['NaturezaContratual_descricao'];
		$oNaturezaContratual->status = $reg['NaturezaContratual_status'];
		$oInsumo->oNaturezaContratual = $oNaturezaContratual;
		$oInsumo->descricao = $reg['Insumo_descricao'];
		$oInsumo->estoque = $reg['Insumo_estoque'];
		$oInsumo->valor = $reg['Insumo_valor'];
		$oInsumo->status = $reg['Insumo_status'];
		return $oInsumo;		   
	}
}
