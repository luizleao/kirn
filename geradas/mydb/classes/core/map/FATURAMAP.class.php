<?php
class FATURAMAP {
	static function getMetaData() {
		return ['FATURA' => ['valor', 
						'vencimento', 
						'pagamento', 
						'CLIENTE_id'], 
				'CLIENTE' => [						'id', 
						'status', 
						'PESSOA_id', 
						'ENDERECO_id']];
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

	static function objToRs($oFATURA){
		$reg['valor'] = $oFATURA->valor;
		$reg['vencimento'] = $oFATURA->vencimento;
		$reg['pagamento'] = $oFATURA->pagamento;
		$oCLIENTE = $oFATURA->oCLIENTE;
		$reg['CLIENTE_id'] = $oCLIENTE->id;
		return $reg;		   
	}

	static function objToRsInsert($oFATURA){
		$reg['valor'] = $oFATURA->valor;
		$reg['vencimento'] = $oFATURA->vencimento;
		$reg['pagamento'] = $oFATURA->pagamento;
		$oCLIENTE = $oFATURA->oCLIENTE;
		$reg['CLIENTE_id'] = $oCLIENTE->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oFATURA = new FATURA();
		$oFATURA->valor = $reg['FATURA_valor'];
		$oFATURA->vencimento = $reg['FATURA_vencimento'];
		$oFATURA->pagamento = $reg['FATURA_pagamento'];

		$oCLIENTE = new CLIENTE();
		$oCLIENTE->id = $reg['CLIENTE_id'];
		$oCLIENTE->status = $reg['CLIENTE_status'];
		$oFATURA->oCLIENTE = $oCLIENTE;
		return $oFATURA;		   
	}
}
